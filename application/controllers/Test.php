<?php
    class Test extends CI_Controller{
        public function index(){
            $this->load->view('user/signup');
        }

        public function archive_add($uid = null){
            $this->load->view('test');
        }
    }
?>