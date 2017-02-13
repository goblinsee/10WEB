<?php 
class Message extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
        $this->load->model('usermessage_model');
        $this->load->helper('url_helper');
        $this->load->library('session');
	}

	private function getInfo($Flag = 101,$Content = "",$Extra = ""){
      return array("Flag" => $Flag,"Content" => $Content,"Extra" => $Extra);
    }

	/**
    * 查看和自己发过消息的用户
    * @return users array()
    */
    public function GetCommunicatedUsers(){
        $userid = null;
        $info = null;
        if($this->session->userdata['info'][0]['ID']){
          $userid = $this->session->userdata['info'][0]['ID'];
        }
        else{
          $info = $this->getInfo(-8,"you have not logged in","");
          echo urldecode(json_encode($info));
          return;
        }
        $users = $this->usermessage_model->GetCommunicatedUser($userid);
        echo json_encode($this->getInfo(100,$users));
    }

    /**
    * 查看与某一用户的消息内容
    */
    public function GetMessage(){
        $userid = null;
        $info = null;
        if($this->session->userdata['info'][0]['ID']){
          $userid = $this->session->userdata['info'][0]['ID'];
        }
        else{
          //没有登陆
          $info = $this->getInfo(-8,"you have not logged in","");
          echo urldecode(json_encode($info));
          return;
        }
        $mesuserid = $this->input->post('MesUserID');
        $messages = $this->usermessage_model->GetMessage($userid,$mesuserid);
        echo json_encode($this->getInfo(100,$messages));
    }

    /**
    *   用户删除消息
    */
    public function DeleteMessage(){
        $messageid = $this->input->post('MessageID');
        $info = $this->getInfo(100,"delete message successful","");
        if($this->usermessage_model->DeleteMessage($messageid) === 0){
            //删除消息失败
            $info = $this->getInfo(-9,"delete message fail","");
        }
        echo urldecode(json_encode($info));
    }

    /**
    * 用户读取消息，在表中将State设为1,0->未读，1->已读
    */
    public function ReadMessage(){
        $messageid = $this->input->post('MessageID');
        $messagecontent = $this->usermessage_model->SetMessageRead($messageid);
        print_r($messagecontent);
    }

     public function SendMessageToUser(){
        $userid = null;
        $info = null;
        if($this->session->userdata['info'][0]['ID']){
          $userid = $this->session->userdata['info'][0]['ID'];
        }
        else{
          //没有登陆
          $info = $this->getInfo(-8,"you have not logged in","");
          echo urldecode(json_encode($info));
          return;
        }
        $content = $this->input->post('Content');

        $targetuserid = $this->input->post('TargetUserID');

        if($content === null){
          //未输入消息内容
          $info = $this->getInfo(-10,"please enter content","");
          echo urldecode(json_encode($info));
          return;
        }
        if($targetuserid === null and $this->session->userdata['info'][0]['Permission'] <> 3){
          //未选择发送对象g
          $info = $this->getInfo(-11,"please choose target user","");
        }
        else{
            if($this->usermessage_model->SendMessageToUser($userid,$targetuserid,$content) <> 0){
                //发送消息成功
                $info = $this->getInfo(100,"send message successful","");
            }
            else{
                //发送消息失败
                $info = $this->getInfo(-12,"send message fail","");
            }
        }
        echo urldecode(json_encode($info));
    }

    //管理员部分
    /**
    *   查看所有用户的消息
    */
    public function GetAllUsersMessages(){
        $messages = $this->usermessage_model->GetAllUsersMessages();
        print_r($messages);
    }

    /**
    *   管理员删除消息
    */
    public function DeleteMessageForAdmin(){
        $messageid = $this->input->post('MessageID');
        $info = null;
        if($this->usermessage_model->DeleteMessageForAdmin($messageid) <> 0){
            $info = $this->getInfo(100,"delete message successful","");
        }
        else{
            $info = $this->getInfo(-13,"delete message fail","");
        }
        echo urldecode(json_encode($info));
    }
}

 ?>
