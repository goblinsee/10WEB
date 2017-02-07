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
     * use to make a info
     *
     * @param int $Flag - the flag
     * @param string $Content -the content
     * @param string $Extra -the extra info
     * @return array
     */
    private function getInfo($Flag = 101,$Content = "",$Extra = ""){
      return array("Flag" => $Flag,"Content" => $Content,"Extra" => $Extra);
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
