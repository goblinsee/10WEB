<?php
    class Signup extends CI_Controller{
    	public function __construct(){
    		parent::__construct();
    		$this->load->model('sign_model');
    		$this->load->helper('url_helper');
    	}
        public function index(){
            $this->load->view('user/signup');
        }
        //激活账号
        public function auth($uid = null){
            $account = base64_decode(urldecode($uid));
            echo $account;
            $state = $this->sign_model->CheckActivate($account);
            //检查账号是否已经激活过
            if($state === 1){
            	$info = [
            		'Flag' => -101,
            		'Content' => urlencode("该链接已经过期"),
            		'Extra' => ""
            	];
            	echo urldecode(json_encode($info));
            }
            else{
            	header("Location: http://www.jyonline.cc:6070/index.php");
            }
        }
    }
?>