<?php
    class Signup extends CI_Controller{
        public function index(){
            $this->load->view('user/signup');
        }

        public function auth($uid = null){
            $this->load->view('user/auth');
        }
    }
?>