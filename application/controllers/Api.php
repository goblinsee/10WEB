<?php


function sendMail($account,$email_info){
    require("phpmailer/class.phpmailer.php"); 
    $email_host = $email_info['email_host'];
    $email_username = $email_info['email_username'];
    $email_password = $email_info['email_password'];

    $mail = new PHPMailer(); //建立邮件发送类
    $address = $account;
    $mail->IsSMTP(); // 使用SMTP方式发送
    $mail->Host = $email_host; // 您的企业邮局域名
    $mail->SMTPAuth = true; // 启用SMTP验证功能
    $mail->Username = $email_username; // 邮局用户名(请填写完整的email地址)
    $mail->Password = $email_password; // 邮局密码
    $mail->From = $email_username; //邮件发送者email地址
    $mail->FromName = "亿灵";
    $mail->AddAddress("$address", "$address");//收件人地址，可以替换成任何想要接收邮件的email信箱,格式是AddAddress("收件人email","收件人姓名")
    $mail->Subject = "eling验证"; //邮件标题：要以英文开头
    $uuid = urlencode(base64_encode($account));
    $msg = '测试,<a href="http://www.jyonline.cc:6070/index.php/signup/auth/'.$uuid.'">点我验证</a>';
    $mail->Body = $msg; //邮件内容
    $mail->Send();
}


    class Api extends CI_Controller {

        public function __construct(){
            parent::__construct();
            $this->load->model('sign_model');
            $this->load->model('archives_model');
            $this->load->model('usermessage_model');
            $this->load->helper('url_helper');
            
        }

        public function index(){
			
			// 添加文章
			// $title = "tzcnvt";
			// $source = "soucxzvce";
			// $redirectUrl = "";
			// $littlePicture = "";
			// $pubDate = date("Y-m-d H:i:s");
			// $id = md5(date("Y-m-d H:i:s",time()).$title);
			// $this->Archives_model->addArc($id, $title, $source, $redirectUrl, $littlePicture, $pubDate);
	
	
			// 删除文章
			// $id = "1d711f9dabc75a3f0fc2";
			// $title ="tzcnvt";
			// $this->Archives_model->delArc($id, $title);
			
			// 修改文章
			// 查询文章
		    echo "api接口入口";
        }

        /*注册登陆api*/

        /**
        *   注册文档
        *   @param account varchar(40)
        *   @param password varchar(20)
        *   
        */
        public function SignUp(){
            //$this->sign_model->test();
            $account = $_POST['UserAccount'];    
            //先检查账号是否存在       
            if($this->sign_model->AccountExist($account)){
                $info = array(
                    'Flag' => -101,//验证失败
                    'Content' => urlencode("该账号已经存在"),//验证结果
                    'Extra' => ""//暂且设为空
                );
                echo urldecode(json_encode($info));
            }
            //账号没有在数据库中
            else{
                $password = $_POST['password'];
                //在数据库中插入一条记录，状态设置为未激活，同时发送邮件给用户
                $this->sign_model->InsertAccount($account,$password);
                $info = array(
                    'Flag' => 100,//成功
                    'Content' => urlencode("用户创建成功"),
                    'Extra' => ""
                );          
                $email_info =$this->config->item('email');//获取email配置信息
                //发送邮件给用户
                sendMail($account,$email_info);
                echo urldecode(json_encode($info));
            }
        }


        /**
        *   登陆文档:登陆之前先检查账号密码信息：
        *   1.未激活 3.账号被封 4.密码错误 5.账号不存在 -------不登陆
        *   2.账号密码正确且已经激活 --------登陆
        *   @param account varchar(40)
        *   @param password varchar(20)
        */
        public function SignIn(){
            $account = $_POST['UserAccount'];
            $password = $_POST['password'];
            //在数据库中查找是否有该账号以及检查该账号是否可用
            $state = $this->sign_model->CheckAccount($account,$password);
            $info=[
                "Flag" => -100,
                "Content" => urlencode("该账号未激活，请激活后登陆"),
                "Extra" => ""
            ];
            //未激活状态
            if($state === 1){
                $info["Content"] = urlencode("账号未激活，请激活后登陆");
            }
            //已经激活，可以登陆
            else if($state === 2){
               $info["Content"] = urlencode("账号密码正确，可以登陆");
            }
            //账号被封
            else if($state === 3){
                $info["Content"] = urlencode("该账号已经被封");
            }
            //密码不正确
            else if($state === 4){
                $info["Content"] = urlencode("密码错误");
            }
            //没有该账号
            else if($state === 5){
                $info["Content"] = urlencode("账号不存在");
            }
            echo urldecode(json_encode($info));
        }

        /*用户api*/

        /**
        *   管理与自己相关的文章
        *   用户文章关系 type：0->收藏，1->自己已经发布的文章，2->    自己尚未发布的文章
        *如果要获取以上三种中的某种直接传入参数0，1，2即可，但是如果要获取所有自己写的文章，即要获取类型1和类型2的文章，传入参数3(但是3不是用户和文章的关系)
        */
        public function GetUserArchives(){
            $type = $this->input->post('type');
            $archives = $this->archives_model->findArchive($type);//传入
            echo $archives;
        }

        /**
        *   用户编辑文章
        */
        public function EditArchive(){
            $type = 'edit';
            archive($type);
        }

        /**
        *   查看和自己发过消息的用户
        *   @return users array()
        */
        public function GetCommunicatedUsers(){
            $userid = $this->input->post('userid');
            $users = $this->usermessage_model->GetCommunicatedUser($userid);
            echo $users;
        }

        /**
        *   查看与某一用户的消息内容
        */
        public function GetMessage(){
            $userid = $this->input->post('userid');
            $mesuserid = $this->input->post('mesuserid');
            $messages = $this->usermessage_model->GetMessage($userid,$mesuserid);
            echo $messages;
        }

        /**
        *   用户删除消息
        */
        public function DeleteMessage(){
            $messageid = $this->input->post('messageid');
            $info = array(
                "Flag" => 100,
                "Content" => urlencode("消息删除成功"),
                "Extra" => ""
            );
            if($this->usermessage_model->DeleteMessage($messageid) === FALSE){
                $info['Flag'] = -101;
                $info['Content'] = urlencode("消息删除失败");
            }
            echo urldecode(json_encode($info));
        }

        /**
        *   用户读取消息，在表中将State设为1,0->未读，1->已读
        */
        public function ReadMessage(){
            $userid = $this->input->post('userid');
            $messageid = $this->input->post('messageid');
            $this->usermessage_model->SetMessageRead($userid,$messageid);
        }


        /*管理员api*/

        /**
        *   查看所有用户的消息
        */
        public function GetAllUsersMessages(){
            $messages = $this->usermessage_model->GetAllUsersMessages();
            echo $messages;
        }

        /**
        *   给用户发消息,如果有用户id传入就给该用户发送消息，否则给所有用户发送消息
        */
        public function SendMessageToUser(){
            $userid = $this->input->post('userid');
            $content = $this->input->post('content');
            $info = array(
                "Flag" => -101,
                "Content" => "",
                "Extra" => ""
            );
                echo urldecode(json_encode($info));
            if($content === null){
                $info['Content'] = urlencode("请输入内容");
            }
            else{
                if($this->usermessage_model->SendMessageToUser($userid,$content)){
                    $info['Flag'] = 100;
                    $info['Content'] = urlencode("消息发送成功");
                }
                else{
                    $info['Content'] = urlencode("消息发送失败");
                }
            }
            echo urldecode(json_encode($info));
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

		public function archive($opname){
			switch($opname){
				case 'add': {
					$error_code = $this->Archives_model->addArchive();
					if ($error_code) {
						$info = array(
							"Flag" => 101,
							"Content" => "Add Archive Success!",
							"Extra" => ""
						);
					} else {
						$info = array(
							"Flag" => -100,
							"Content" => "",
							"Extra" => ""
						);
					}
					echo json_encode($info) ;
					break;
				}
				case 'del' : {
					$error_code = $this->Archives_model->delArchive();
					if ($error_code) {
						$info = array(
							"Flag" => 101,
							"Content" => "Delete Archive Success!",
							"Extra" => ""
						);
					} else {
						$info = array(
							"Flag" => -100,
							"Content" => "",
							"Extra" => ""
						);
					}
					echo json_encode($info) ;
					break;
				}
				case 'edit' : {
					$error_code = $this->Archives_model->editArchive();
					if ($error_code) {
						$info = array(
							"Flag" => 101,
							"Content" => "Edit Archive Success!",
							"Extra" => ""
						);
					} else {
						$info = array(
							"Flag" => -100,
							"Content" => "",
							"Extra" => ""
						);
					}
					echo json_encode($info);
					break;
				}
				case 'find' : {
					$row = $this->Archives_model->findArchive();
					if ($row) {
						$info = array(
							"Flag" => 101,
							"Content" => "Find Archive Success!",
							"Extra" => ""
						);
					} else {
						$info = array(
							"Flag" => -100,
							"Content" => "Find Archive Fail!",
							"Extra" => ""
						);
					}
					echo json_encode($info);
					break;
				}
			}
		}
    }
?>