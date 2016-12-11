<?php
class Archives_model extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->database();
	}


	public function addArchive() {
		$Title = $_POST['Title'];
		$Source = $_POST['Source'];
		$Writer = $_POST['Writer'];
		$RedirectUrl = "";
		$LitPic = "";
		if(isset($_POST['RedirectUrl']))
			$RedirectUrl = $_POST['RedirectUrl'];
		if(isset($_POST['LitPic']))
			$LitPic = $_POST['LitPic'];
		$PubDate = date("Y-m-d H:i:s");
		$id = md5($PubDate.$Title);
		$error_code = $this->addArc($id, $Title,$Writer, $Source, $RedirectUrl, $LitPic, $PubDate);
		return $error_code;
	}

	public function delArchive($ID, $Title) {
		$Title = $_POST['Title'];
		$ID = $_POST['ID'];
		$error_code = $this->delArc($ID,$Title);
		return $error_code;
	}

	public function editArchive() {
		$OldTitle = $_POST['OldTitle'];
		$ID = $_POST['ID'];
		$UserID = $_POST['UserID'];
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
	public function findArchive($Type = 0) {
		$Title = null;
		if(isset($_POST['Title']))
			$Title = $_POST['Title'];
		$ID = $_POST['ID'];
		$row = $this->findArc($ID,$Title,$Type);
		return $row;
	}

	public function addArc($ID, $Title, $Writer,$Source, $RedirectUrl, $LitPic, $PubDate) {
		$sql = "INSERT INTO e0_archives (ID, Title, Writer, Source, RedirectUrl, LitPic, PubDate) VALUES (".$this->db->escape($ID).",".$this->db->escape($Title).",".$this->db->escape($Writer).",".$this->db->escape($Source).",".$this->db->escape($RedirectUrl).",".$this->db->escape($LitPic).",".$this->db->escape($PubDate).")";
		$sql2 = "INSERT INTO e0_userarchives (UserID , ArchiveID , OpType) VALUES (".$this->db->escape($UserId).",".$this->db->escape($ID).",".$this->db->escape(1);
		$this->db->query($sql2);

		return $this->db->query($sql);
	}

	public function delArc($ID, $Title) {
		$sql = "DELETE FROM e0_archives WHERE ID = ".$this->db->escape($ID)."AND Title = ".$this->db->escape($Title);
		//echo "delArc() affected ".$this->db->affected_rows()." row.";
		return $this->db->query($sql);

	}


	public function editArc($ID, $UserID, $OldTitle, $NewTitle, $Source, $RedirectUrl, $LitPic,$Release = null) {
		if($Release === null){
			$sql = "UPDATE e0_archives SET Title = ".$this->db->escape($NewTitle).", Source = ".$this->db->escape($Source).", RedirectUrl = ".$this->db->escape($RedirectUrl).", LitPic = ".$this->db->escape($RedirectUrl)." WHERE ID = ".$this->db->escape($ID)." AND Title = ".$this->db->escape($OldTitle);
			$this->db->query($sql);
			//echo "edit() affected ".$this->db->affected_rows()." row.";
			return $this->db->affected_rows();
		}
		else{
			$sql = "UPDATE e0_archives SET Title = ".$this->db->escape($NewTitle).", Source = ".$this->db->escape($Source).", RedirectUrl = ".$this->db->escape($RedirectUrl).", LitPic = ".$this->db->escape($RedirectUrl).", State = ".$this->db->escape($Release)." WHERE ID = ".$this->db->escape($ID)." AND Title = ".$this->db->escape($OldTitle);
			$sql2 = "UPDATE e0_userarchives SET OpType = ".$this->db->escape($Release)." WHERE UserID = ".$this->db->escape($UserID)." AND ArchiveID = ".$this->db->escape($ID);
			$this->db->query($sql2);
			$this->db->query($sql);
			return $this->db->affected_rows();
		}

	}

	//Type: 0 -> 查找用户收藏的类型   1 ->  查找用户已发布的文章	2 -> 查找用户尚未发布的文章	3 -> 查找用户的所有文章
	public function findArc($ID,$Title = null,$Type = 0) {
		if($Title === null){
			$sql = "SELECT ArchiveID FROM e0_userarchives WHERE UserID = ".$this->db->escape($ID)." AND OpType = ".$this->db->escape($Type);
			if($Type == 3){
				$sql = "SELECT ArchiveID FROM e0_userarchives WHERE UserID = ".$this->db->escape($ID)." AND OpType = ".$this->db->escape(1)." OR OpType = ".$this->db->escape(2);
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
		else{
			$sql = "SELECT * FROM e0_archives WHERE ID = ".$this->db->escape($ID)." AND Title = ".$this->db->escape($Title);
			$query =  $this->db->query($sql);
			$row = $query->row_array();
			return $row;
		}

	}
}
?>
