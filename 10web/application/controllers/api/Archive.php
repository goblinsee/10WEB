<?php

//return model


class Archive extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('Archives_model');
        $this->load->helper('url_helper');
        $this->load->library('session');
    }

    public function index()
    {
       echo "api/archive";
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
     * use to add archive
     */
    public function add(){
      $error_code = $this->addArchive();
      if ($error_code) {
        $info = $this->getInfo(100,"add success","");
      } else {
        $info = $this->getInfo(-101,"fail","");
      }
      echo json_encode($info) ;
    }

    /**
     * use to delete archive
     */
    public function del(){
      $error_code = $this->delArchive();
      if ($error_code) {
        $info = $this->getInfo(100,"delete success","");
      } else {
        $info = $this->getInfo(-101,"fail","");
      }
      echo json_encode($info) ;
    }

    /**
     * use to update archive
     */
    public function edit(){
      $error_code = $this->editArchive();
      if ($error_code) {
        $info = $this->getInfo(100,"update success","");
      } else {
        $info = $this->getInfo(-101,"fail","");
      }
      echo json_encode($info) ;
    }

    /**
     * use to find archive
     */
    public function find(){
      $row = $this->findArchive();
      if ($row) {
        $info = $this->getInfo(100,json_encode($row),"");
      } else {
        $info = $this->getInfo(-101,"fail","");
      }
      echo json_encode($info) ;
    }
//--------------------------->2017年3月1日增加
public function addArchive() {
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
		$error_code = $this->Archives_model->addArc($id, $Title, $UserID, $Writer, $Source, $RedirectUrl, $LitPic, $PubDate);
		return $error_code;
	}

public function delArchive() {
		$Title = $_POST['Title'];
		$ID = $_POST['ID'];
		$error_code = $this->Archives_model->delArc($ID,$Title);
		return $error_code;
	}

	public function editArchive() {
		$OldTitle = $_POST['OldTitle'];
		$ID = $_POST['ID'];
		$UserID = null;
		if($this->session->userdata['info'][0]['ID']){
          $UserID = $this->session->userdata['info'][0]['ID'];
          print_r($this->session->userdata['info'][0]);//api test
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
		$error_code = $this->Archives_model->editArc($ID,$UserID,$OldTitle,$NewTitle,$Source,$RedirectUrl,$LitPic,$Release);
		return $error_code;
	}
	
	//Type: 0 -> 查找用户收藏的类型   1 ->  查找用户已发布的文章	2 -> 查找用户没有发布的文章	3 -> 查找用户所有的文章
	public function findArchive() {
		if(!isset($_POST['ID'])){
			return null;
		}
		$ID = $_POST['ID'];
		$row = $this->Archives_model->findArcByID($ID);
		return $row;
	}
	
	public function findUserArchive() {
		$Type = $_POST['Type'];
		$UserID = $_POST['UserID'];
		$row = $this->Archives_model->findArcByUserID($UserID, $Type);
		return $row;
	}
//--------------------------->2017年2月15日增加
    /**
     * 根据用户ID获取用户发布的文章
     */
    public function findUserPubArc(){
      //参数检测
      if(!isset($_POST['UserID'])){
        $info = $this->getInfo(-1,"缺少参数","");
        echo json_encode($info);
        return ;
      }
      $user_id = $_POST['UserID'];
      $result = $this->Archives_model->findArcByUserID($user_id,1);
      $info = $this->getInfo(100,$result,"");
      echo json_encode($info);
    }

    /**
     * 根据session获取当前用户的所有文章(除了删除的)
     */
    public function findMyArc(){
        if(!isset($this->session->userdata['info'][0]['ID'])){
           $info = $this->getInfo(-8,"未登录","");
           echo json_encode($info);
           return ;
        }

        $user_id = $this->session->userdata['info'][0]['ID'];
        $result = $this->Archives_model->findAllArc($user_id);
        $info = $this->getInfo(100,$result,"");
        echo json_encode($info);
    }

    /**
     * 获取推荐的文章,以10篇为一组
     */
    public function getComArc($range = 0){
      $result = $this->Archives_model->getComArc($range);
      $info = $this->getInfo(100,$result,"");
      echo json_encode($info);
    }

    public function search(){
      echo "还未开放";
    }
}

?>
