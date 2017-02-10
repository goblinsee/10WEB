<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    public function __construct(){
      parent::__construct();
      $this->load->model('sign_model');
      $this->load->helper('url');
      $this->load->library('session');
    }

    public function index()
    {
       $this->load->view('welcome');
    }

    /**
     * 激活某一个用户的账号
     * 
     * @param String $account 用户的账号
     */
    public function activeUser( $account = null ){
    	
    	if(!$account||$account == ""){
    		echo "发生错误";
        return ;
    	}  
      
      $account = base64_decode(urldecode($account));
    	$active = $this->sign_model->CheckActivate($account);
      
      if($active == 0){
         $userinfomation = $this->sign_model->GetUserInfo($account);
         //$this->session->set_userdata($userinfomation);
         $this->session->userdata['info'] = $userinfomation;
      }

    	//加载
      $data = array(
        "active" => $active
      );
      //渲染
    	$this->load->view('user/active',$data);
    }
}

?>
