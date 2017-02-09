<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends CI_Controller {

    public function __construct(){
      parent::__construct();
      $this->load->library('session');
      $this->load->model('usermessage_model');
      //如果没有登陆，那么就跳转首页
      if(!$this->_session_get_id()){
        redirect('/index.php/signup');
      }
    }

    public function index()
    {
       $this->load->view('message/message');
    }

    private function _session_get_id(){
        if($this->session->userdata['info'][0]['ID']){
          return $userid = $this->session->userdata['info'][0]['ID'];
        }
        return false;
    }

    public function detail($mes_user_id = null){
      if($mes_user_id == null){
        echo "网页错误，缺少参数";
        return ;
      };
      $this->load->view('message/message_detail');
    }
}

?>
