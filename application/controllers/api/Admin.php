<?php
class Admin extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('userMessage_model');
        $this->load->helper('url_helper');
    }

    public function index()
    {
       echo "api/admin";
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
