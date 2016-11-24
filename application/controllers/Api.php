<?php
    class Api extends CI_Controller {
        public function index(){
            echo "这里是api 界面";
        }

        /**
        * 注册用api
        *
        */
        public function signup(){
            $account = $_POST['UserAccount'];
            echo $account;
        }
    }
?>