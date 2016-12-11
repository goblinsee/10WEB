<?php
class Admin extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('usermessage_model');
        $this->load->helper('url_helper');
    }

    public function index()
    {
       echo "api/admin";
    }

    /**
    *   查看所有用户的消息
    */
    public function GetAllUsersMessages(){
        $messages = $this->usermessage_model->GetAllUsersMessages();
        print_r($messages);
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

    /**
    *   管理员删除消息
    */
    public function DeleteMessageForAdmin(){
        $messageid = $this->input->post('messageid');
        $info = array(
            "Flag" => -101,
            "Content" => "",
            "Extra" => ""
        );
        if($this->usermessage_model->DeleteMessageForAdmin($messageid)){
            $info['Flag'] = 100;
            $info['Content'] = urlencode("删除消息成功");
        }
        else{
            $info['Content'] = urlencode("删除消息失败");
        }
        echo urldecode(json_encode($info));
    }
}

?>
