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
            $account = $_POST['Account'];
            $password = $_POST['Password'];
            $user_info = array(
                'Account' =>  $account,
                'Password' => $password
            );
            echo json_encode($user_info);
        }

        public function test(){
            echo "hello world";
        }
    }
?>