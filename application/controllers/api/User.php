<?php
require("tools.php");

class User extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('sign_model');
        $this->load->model('userMessage_model');
        $this->load->helper('url_helper');
    }

    public function index()
    {
       echo "api/User";
    }

    /**
     *   used to signup and send a auth email to user
     */
    public function signUp(){
        $info = array(
            'Flag' => -101,//验证失败
            'Content' =>"",//验证结果
            'Extra' => ""//暂且设为空
        );

        //check the post argument
        if(!isset($_POST['Account'])&&!isset($_POST['Password'])){
          $info["Content"] = "to few arguments";
          echo urldecode(json_encode($info));
          return ;
        }

        //read the arguments
        $account = $_POST['Account'];
        $password = $_POST["Password"];

        //先检查账号是否存在
        if($this->sign_model->AccountExist($account)){
            $info["Content"] = "already exsit";
            echo urldecode(json_encode($info));
            return ;
        }

        //在数据库中插入一条记录，状态设置为未激活，同时发送邮件给用户
        $this->sign_model->InsertAccount($account,$password);
        $info['Flag'] = 100;
        $info['Content'] = 'signup success';

        $email_info =$this->config->item('email');//获取email配置信息
        //发送邮件给用户
        if(!sendMail($account,$email_info,$this->config->item('base_url'))){
          $info['Flag'] = -101;
          $info['Content'] = 'signup fail';
        }

        echo urldecode(json_encode($info));
    }


    /**
     * used to signIn
     */
    public function signIn(){
      $account = $_POST['UserAccount'];
      $password = $_POST['password'];
      //在数据库中查找是否有该账号以及检查该账号是否可用
      $state = $this->sign_model->CheckAccount($account,$password);
      $info=[
          "Flag" => -100,
          "Content" => urlencode("该账号未激活，请激活后登陆"),
          "Extra" => ""
      ];

      //未激活状态
      if($state === 1){
          $info["Content"] = urlencode("账号未激活，请激活后登陆");
      }
      //已经激活，可以登陆
      else if($state === 2){
         $info["Content"] = urlencode("账号密码正确，可以登陆");
      }
      //账号被封
      else if($state === 3){
          $info["Content"] = urlencode("该账号已经被封");
      }
      //密码不正确
      else if($state === 4){
          $info["Content"] = urlencode("密码错误");
      }
      //没有该账号
      else if($state === 5){
          $info["Content"] = urlencode("账号不存在");
      }
      echo urldecode(json_encode($info));
    }

    /*用户api*/
    /**
    *   管理与自己相关的文章
    *   用户文章关系 type：0->收藏，1->自己已经发布的文章，2->    自己尚未发布的文章
    *如果要获取以上三种中的某种直接传入参数0，1，2即可，但是如果要获取所有自己写的文章，即要获取类型1和类型2的文章，传入参数3(但是3不是用户和文章的关系)
    */
    public function GetUserArchives(){
        $type = $this->input->post('type');
        $archives = $this->archives_model->findArchive($type);//传入
        echo $archives;
    }

    /**
    *   用户编辑文章
    */
    public function EditArchive(){
        $type = 'edit';
        archive($type);
    }

    /**
    *   查看和自己发过消息的用户
    *   @return users array()
    */
    public function GetCommunicatedUsers(){
        $userid = $this->input->post('userid');
        $users = $this->usermessage_model->GetCommunicatedUser($userid);
        echo $users;
    }

    /**
    *   查看与某一用户的消息内容
    */
    public function GetMessage(){
        $userid = $this->input->post('userid');
        $mesuserid = $this->input->post('mesuserid');
        $messages = $this->usermessage_model->GetMessage($userid,$mesuserid);
        echo $messages;
    }

    /**
    *   用户删除消息
    */
    public function DeleteMessage(){
        $messageid = $this->input->post('messageid');
        $info = array(
            "Flag" => 100,
            "Content" => urlencode("消息删除成功"),
            "Extra" => ""
        );
        if($this->usermessage_model->DeleteMessage($messageid) === FALSE){
            $info['Flag'] = -101;
            $info['Content'] = urlencode("消息删除失败");
        }
        echo urldecode(json_encode($info));
    }

    /**
    *   用户读取消息，在表中将State设为1,0->未读，1->已读
    */
    public function ReadMessage(){
        $userid = $this->input->post('userid');
        $messageid = $this->input->post('messageid');
        $this->usermessage_model->SetMessageRead($userid,$messageid);
    }

    /*管理员api*/

    /**
    *   查看所有用户的消息
    */
    public function GetAllUsersMessages(){
        $messages = $this->usermessage_model->GetAllUsersMessages();
        echo $messages;
    }

    /**
    *   给用户发消息,如果有用户id传入就给该用户发送消息，否则给所有用户发送消息
    */
    public function SendMessageToUser(){
        $userid = $this->input->post('userid');
        $content = $this->input->post('content');
        $info = array(
            "Flag" => -101,
            "Content" => "",
            "Extra" => ""
        );
            echo urldecode(json_encode($info));
        if($content === null){
            $info['Content'] = urlencode("请输入内容");
        }
        else{
            if($this->usermessage_model->SendMessageToUser($userid,$content)){
                $info['Flag'] = 100;
                $info['Content'] = urlencode("消息发送成功");
            }
            else{
                $info['Content'] = urlencode("消息发送失败");
            }
        }
        echo urldecode(json_encode($info));
    }

}
?>
