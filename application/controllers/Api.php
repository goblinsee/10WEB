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

        public function activity($id = 0){
            $activity = array(
                array(
                    "name" => "测试活动1",
                    "date" => "2016年11月28日19:42:09"
                ),
                array(
                    "name" => "测试活动2",
                    "date" => "2016年11月28日19:42:09"
                ),
            );

            echo json_encode($activity);
        }
    }
?>