<?php

//return model


class Activity extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('Activities_model');
        $this->load->helper('url_helper');
        $this->load->library('session');
    }

    public function index()
    {
       echo "api/activity";
    }

    /**
     * use to make a info
     *
     * @param int $Flag - the flag
     * @param string $Content -the content
     * @param string $Extra -the extra info
     * @return array
     */
    private function getInfo($Flag = 101,$Content = "",$Extra = ""){
      return array("Flag" => $Flag,"Content" => $Content,"Extra" => $Extra);
    }

    /**
     * use to add activity
     */
    public function add(){
      $error_code = $this->addActivity();
      if ($error_code) {
        $info = $this->getInfo(100,"add activity success","");
      } else {
        $info = $this->getInfo(-101,"fail","");
      }
      echo json_encode($info) ;
    }

    /**
     * use to delete activity
     */
    public function del(){
      $error_code = $this->delActivity();
      if ($error_code) {
        $info = $this->getInfo(100,"delete activity success","");
      } else {
        $info = $this->getInfo(-101,"fail","");
      }
      echo json_encode($info) ;
    }

    /**
     * use to update activity
     */
    public function edit(){
      $error_code = $this->editActivity();
      if ($error_code) {
        $info = $this->getInfo(100,"update activity success","");
      } else {
        $info = $this->getInfo(-101,"fail","");
      }
      echo json_encode($info) ;
    }

    /**
     * use to find activity
     */
    public function find(){
      $row = $this->findActivity();
      if ($row) {
        $info = $this->getInfo(100,json_encode($row),"");
      } else {
        $info = $this->getInfo(-101,"fail","");
      }
      echo json_encode($info) ;
    }

    //--------------------------->2017年3月1日添加
    public function addActivity() {
		$Title = $_POST['Title'];
		$Source = $_POST['Source'];
		$Writer = null;
		$UserID = null;
		if($this->session->userdata['info'][0]['ID']){
          $UserID = $this->session->userdata['info'][0]['ID'];
          $Writer = $this->session->userdata['info'][0]['Account'];
        }
        else{
          $info = array(
              "Flag" => -101,
              "Content" => urldecode("你没登陆"),
              "Extra" => ""
          );
          echo urldecode(json_encode($info));
          return;
        }
		$RedirectUrl = "";
		$LitPic = "";
		if(isset($_POST['RedirectUrl']))
			$RedirectUrl = $_POST['RedirectUrl'];
		if(isset($_POST['LitPic']))
			$LitPic = $_POST['LitPic'];
		$PubDate = date("Y-m-d H:i:s");
		$id = md5($PubDate.$Title);
		$error_code = $this->Activities_model->addAct($id, $Title, $UserID, $Writer, $Source, $RedirectUrl, $LitPic, $PubDate);
		return $error_code;
	}

  public function delActivity() {
		$Title = $_POST['Title'];
		$ID = $_POST['ID'];
		$error_code = $this->Activities_model->delAct($ID,$Title);
		return $error_code;
	}

  public function editActivity() {
		$OldTitle = $_POST['OldTitle'];
		$ID = $_POST['ID'];
		$UserID = null;
		if($this->session->userdata['info'][0]['ID']){
          $UserID = $this->session->userdata['info'][0]['ID'];
        }
        else{
          $info = array(
              "Flag" => -101,
              "Content" => urldecode("你没登陆"),
              "Extra" => ""
          );
          echo urldecode(json_encode($info));
          return;
        }
		$NewTitle = $OldTitle;
		$Source = $_POST['OldSource'];
		$RedirectUrl = $_POST['OldRedirectUrl'];
		$LitPic = $_POST['OldLitPic'];

		$Release = null;//修改文章发布状态的：1 -> 发布，2 -> 取消发布
		if(isset($_POST['NewSource']))
			$Source = $_POST['NewSource'];
		if(isset($_POST['NewTitle']))
			$NewTitle = $_POST['NewTitle'];
		if(isset($_POST['NewRedirectUrl']))
			$RedirectUrl = $_POST['NewRedirectUrl'];
		if(isset($_POST['NewLitPic']))
			$LitPic = $_POST['NewLitPic'];

		if(isset($_POST['Release']))
			$Release = $_POST['Release'];
		$error_code = $this->Activities_model->editAct($ID,$UserID,$OldTitle,$NewTitle,$Source,$RedirectUrl,$LitPic,$Release);
		return $error_code;
	}
  //Type: 0 -> 查找用户收藏的类型   1 ->  查找用户已发布的文章	2 -> 查找用户没有发布的文章	3 -> 查找用户所有的文章
	public function findActivity() {
		$Title = null;
		if(isset($_POST['Title']))
			$Title = $_POST['Title'];
		$ID = $_POST['ID'];
		$row = $this->Activities_model->findAct($ID,$Title);
		return $row;
	}

  public function findUserActivity() {
		$Type = $_POST['Type'];
		$UserID = $_POST['UserID'];
		$row = $this->Activities_model->findUserAct($UserID, $Type);
		return $row;
	}
  
}

?>
