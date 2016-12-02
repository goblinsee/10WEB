<?php
    class Api extends CI_Controller {
		public function __construct() {
			parent::__construct();
			$this->load->model('Archives_model');
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
			
			
        }

        /**
        * 注册用api
        *
        */
        public function signup(){
            $account = $_POST['UserAccount'];
            echo $account;
        }
		
		public function archive($opname){
			switch($opname){
				case 'add': {
					$Title = $_POST['Title'];
					$Source = $_POST['Source'];
					$RedirectUrl = "";
					$LitPic = "";
					if(isset($_POST['RedirectUrl']))
						$RedirectUrl = $_POST['RedirectUrl'];
					if(isset($_POST['LitPic']))
						$LitPic = $_POST['LitPic'];
					$PubDate = date("Y-m-d H:i:s");
					$id = md5($PubDate.$Title);
					$error_code = $this->Archives_model->addArc($id, $Title, $Source, $RedirectUrl, $LitPic, $PubDate);
					if ($error_code) {
						$info = array(
							"Flag" => 101,
							"Content" => "asdasdasd",
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
					$Title = $_POST['Title'];
					$ID = $_POST['ID'];
					$error_code = $this->Archives_model->delArc($ID,$Title);
					if ($error_code) {
						$info = array(
							"Flag" => 101,
							"Content" => "asdasdasd",
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
			}
		}
    }
?>