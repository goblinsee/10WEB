<?php
require("tools.php");

class User extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('sign_model');
        $this->load->model('usermessage_model');
        $this->load->model('archives_model');
        $this->load->helper('url_helper');
        $this->load->library('session');
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
      $account = $_POST['Account'];
      $password = $_POST['Password'];
      //在数据库中查找是否有该账号以及检查该账号是否可用
      $state = $this->sign_model->CheckAccount($account,$password);

      $info=[
          "Flag" => -101,
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
         $info['Flag'] = 100;
         $userinfomation = $this->sign_model->GetUserInfo($account);
         //$this->session->set_userdata($userinfomation);
         $this->session->userdata['info'] = $userinfomation;
         $info['Extra'] = json_encode($this->session->userdata['info'][0]);
         //print_r($this->session->userdata['info'][0]);
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

    /**
    * 返回session
    */
    public function GetSession(){
      $info = array(
          "Flag" => -101,
          "Content" => "fail",
          "Extra" => ""
      );
      if($this->session->userdata['info'][0]){
        $info['Flag'] = 100;
        $info['Content'] = "success";
        $info['Extra'] = json_encode($this->session->userdata['info'][0]);
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
        $archives = $this->Archives_model->findUserArchive();//传入
        print_r($archives);
    }


    /**
    *   查看和自己发过消息的用户
    *   @return users array()
    */
    public function GetCommunicatedUsers(){
        $userid = null;
        if($this->session->userdata['info'][0]['ID']){
          $userid = $this->session->userdata['info'][0]['ID'];
        }
        else{
          $info = array(
              "Flag" => -101,
              "Content" => urldecode("你没登陆"),
              "Extra" => ""
          );
          echo urldecode(json_encode($info));
          return;
        }
        $users = $this->usermessage_model->GetCommunicatedUser($userid);
        print_r($users);
    }

    /**
    *   查看与某一用户的消息内容
    */
    public function GetMessage(){
        $userid = null;
        if($this->session->userdata['info'][0]['ID']){
          $userid = $this->session->userdata['info'][0]['ID'];
        }
        else{
          $info = array(
              "Flag" => -101,
              "Content" => urldecode("你没登陆"),
              "Extra" => ""
          );
          echo urldecode(json_encode($info));
          return;
        }
        $mesuserid = $this->input->post('MesUserID');
        $messages = $this->usermessage_model->GetMessage($userid,$mesuserid);
        print_r($messages);
    }

    /**
    *   用户删除消息
    */
    public function DeleteMessage(){
        $messageid = $this->input->post('MessageID');
        $info = array(
            "Flag" => 100,
            "Content" => urlencode("消息删除成功"),
            "Extra" => ""
        );
        if($this->usermessage_model->DeleteMessage($messageid) === 0){
            $info['Flag'] = -101;
            $info['Content'] = urlencode("消息删除失败");
        }
        echo urldecode(json_encode($info));
    }

    /**
    *   用户读取消息，在表中将State设为1,0->未读，1->已读
    */
    public function ReadMessage(){
        $messageid = $this->input->post('MessageID');
        $messagecontent = $this->usermessage_model->SetMessageRead($messageid);
        print_r($messagecontent);
    }

     public function SendMessageToUser(){
        $userid = null;
        if($this->session->userdata['info'][0]['ID']){
          $userid = $this->session->userdata['info'][0]['ID'];
          print_r($this->session->userdata['info'][0]);//api test
        }
        else{
          $info = array(
              "Flag" => -101,
              "Content" => urldecode("你没登陆"),
              "Extra" => ""
          );
          echo urldecode(json_encode($info));
          return;
        }
        $content = $this->input->post('Content');
        $info = array(
            "Flag" => -101,
            "Content" => "",
            "Extra" => ""
        );

        $targetuserid = $this->input->post('TargetUserID');

        if($content === null){
          $info['Content'] = urlencode("请输入内容");
          echo urldecode(json_encode($info));
          return;
        }
        if($targetuserid === null and $this->session->userdata['info'][0]['Permission'] <> 3){
          $info['Content'] = urlencode("请选择发送消息对象");
        }
        else{
            if($this->usermessage_model->SendMessageToUser($userid,$targetuserid,$content) <> 0){
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
