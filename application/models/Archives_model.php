<?php
class Archives_model extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
	}


	public function addArchive() {
		$Title = $_POST['Title'];
		$Source = $_POST['Source'];
		$Writer = null;
		$UserID = null;
		if($this->session->has_userdata('ID')){
          $UserID = $this->session->userdata('ID');
          $Writer = $this->session->userdata('Account');
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
		$error_code = $this->addArc($id, $Title, $UserID, $Writer, $Source, $RedirectUrl, $LitPic, $PubDate);
		return $error_code;
	}

	public function delArchive() {
		$Title = $_POST['Title'];
		$ID = $_POST['ID'];
		$error_code = $this->delArc($ID,$Title);
		return $error_code;
	}

	public function editArchive() {
		$OldTitle = $_POST['OldTitle'];
		$ID = $_POST['ID'];
		$UserID = null;
		if($this->session->has_userdata('ID')){
          $UserID = $this->session->userdata('ID');
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
		$error_code = $this->editArc($ID,$UserID,$OldTitle,$NewTitle,$Source,$RedirectUrl,$LitPic,$Release);
		return $error_code;
	}
	//Type: 0 -> 查找用户收藏的类型   1 ->  查找用户已发布的文章	2 -> 查找用户没有发布的文章	3 -> 查找用户所有的文章
	public function findArchive() {
		$Title = null;
		if(isset($_POST['Title']))
			$Title = $_POST['Title'];
		$ID = $_POST['ID'];
		$row = $this->findArc($ID,$Title,$Type);
		return $row;
	}
	
	public function findUserArchive() {
		$Type = $_POST['Type'];
		$UserID = $_POST['UserID'];
		$row = $this->findUserArc($UserID, $Type);
		return $row;
	}


	public function addArc($ID, $Title, $UserID, $Writer, $Source,  $RedirectUrl, $LitPic, $PubDate) {
		$sql = "INSERT INTO e0_archives (ID, Title, Writer, Source, RedirectUrl, LitPic, PubDate,State) VALUES (".$this->db->escape($ID).",".$this->db->escape($Title).",".$this->db->escape($Writer).",".$this->db->escape($Source).",".$this->db->escape($RedirectUrl).",".$this->db->escape($LitPic).",".$this->db->escape($PubDate).",0)";
		$sql2 = "INSERT INTO e0_userarchives (UserID , ArchiveID , OpType) VALUES (".$this->db->escape($UserID).",".$this->db->escape($ID).", 1)";
		$this->db->query($sql2);

		return $this->db->query($sql);
	}
		
	// State: 0 -> 待审核	1 -> 审核通过	2 -> 已删除
	public function delArc($ID, $Title) {
		$sql = "UPDATE e0_archives SET State = 2 WHERE ID = ".$this->db->escape($ID)." AND Title = ".$this->db->escape($Title);
		return $this->db->query($sql);

	}


	public function editArc($ID, $UserID, $OldTitle, $NewTitle, $Source, $RedirectUrl, $LitPic,$Release = null) {
		if($Release === null){
			$sql = "UPDATE e0_archives SET Title = ".$this->db->escape($NewTitle).", Source = ".$this->db->escape($Source).", RedirectUrl = ".$this->db->escape($RedirectUrl).", LitPic = ".$this->db->escape($RedirectUrl).", State = 0 WHERE ID = ".$this->db->escape($ID)." AND Title = ".$this->db->escape($OldTitle);
			$this->db->query($sql);
			//echo "edit() affected ".$this->db->affected_rows()." row.";
			return $this->db->affected_rows();
		}
		else{
			$sql = "UPDATE e0_archives SET Title = ".$this->db->escape($NewTitle).", Source = ".$this->db->escape($Source).", RedirectUrl = ".$this->db->escape($RedirectUrl).", LitPic = ".$this->db->escape($RedirectUrl).", State = ".$this->db->escape($Release)." State = 0 WHERE ID = ".$this->db->escape($ID)." AND Title = ".$this->db->escape($OldTitle);
			$sql2 = "UPDATE e0_userarchives SET OpType = ".$this->db->escape($Release)." WHERE UserID = ".$this->db->escape($UserID)." AND ArchiveID = ".$this->db->escape($ID);
			$this->db->query($sql2);
			$this->db->query($sql);
			return $this->db->affected_rows();
		}

	}

	
	public function findArc($ID, $Title) {
		$sql = "SELECT * FROM e0_archives WHERE ID = ".$this->db->escape($ID)." AND Title = ".$this->db->escape($Title);
		$query =  $this->db->query($sql);
		$row = $query->row_array();
		return $row;
	}
	
	//Type: 0 -> 查找用户收藏的类型   1 ->  查找用户已发布的文章	2 -> 查找用户尚未发布的文章	3 -> 查找用户的所有文章
	public function findUserArc($UserID, $Type = 0) {
		$sql = "SELECT ArchiveID FROM e0_userarchives WHERE UserID = ".$this->db->escape($UserID)." AND OpType = ".$this->db->escape($Type);
		if($Type == 3){
			$sql = "SELECT ArchiveID FROM e0_userarchives WHERE UserID = ".$this->db->escape($UserID)." AND OpType = ".$this->db->escape(1)." OR OpType = ".$this->db->escape(2);
		}
		$ArchiveIDs = $this->db->query($sql);
		//根据文章id在文章表中查找
		$Archives = array();
		foreach ($ArchiveIDs->result() as $row) {
			$sql2 = "SELECT * FROM e0_archives WHERE ID = ".$this->db->escape($row->ArchiveID);
			array_push($Archives,$this->db->query($sql2)->row());
		}
		return $Archives;
	}
}
?>
