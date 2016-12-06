<?php
class Archives_model extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->database();
	}
	
	public function addArchive() {
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
		$error_code = $this->addArc($id, $Title, $Source, $RedirectUrl, $LitPic, $PubDate);
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
		$NewTitle = $OldTitle;
		$Source = $_POST['OldSource'];
		$RedirectUrl = $_POST['OldRedirectUrl'];
		$LitPic = $_POST['OldLitPic'];
		if(isset($_POST['NewSource']))
			$Source = $_POST['NewSource'];
		if(isset($_POST['NewTitle']))
			$NewTitle = $_POST['NewTitle'];
		if(isset($_POST['NewRedirectUrl']))
			$RedirectUrl = $_POST['NewRedirectUrl'];
		if(isset($_POST['NewLitPic']))
			$LitPic = $_POST['NewLitPic'];
		$error_code = $this->editArc($ID,$OldTitle,$NewTitle,$Source,$RedirectUrl,$LitPic);
		return $error_code;
	}
	public function findArchive($ID, $Title) {
		$Title = $_POST['Title'];
		$ID = $_POST['ID'];
		$row = $this->findArc($ID,$Title);
		return $row;
	}
	
	public function addArc($ID, $Title, $Source, $RedirectUrl, $LitPic, $PubDate) {
		$sql = "INSERT INTO e0_archives (ID, Title, Source, RedirectUrl, LitPic, PubDate) VALUES (".$this->db->escape($ID).",".$this->db->escape($Title).",".$this->db->escape($Source).",".$this->db->escape($RedirectUrl).",".$this->db->escape($LitPic).",".$this->db->escape($PubDate).")";
		return $this->db->query($sql);
	}
	
	public function delArc($ID, $Title) {
		$sql = "DELETE FROM e0_archives WHERE ID = ".$this->db->escape($ID)."AND Title = ".$this->db->escape($Title);
		//echo "delArc() affected ".$this->db->affected_rows()." row.";
		
		return $this->db->query($sql);
		
	}
	
	public function editArc($ID, $OldTitle, $NewTitle, $Source, $RedirectUrl, $LitPic) {
		$sql = "UPDATE e0_archives SET Title = ".$this->db->escape($NewTitle).", Source = ".$this->db->escape($Source).", RedirectUrl = ".$this->db->escape($RedirectUrl).", LitPic = ".$this->db->escape($RedirectUrl)." WHERE ID = ".$this->db->escape($ID)." AND Title = ".$this->db->escape($OldTitle);
		$this->db->query($sql);
		//echo "edit() affected ".$this->db->affected_rows()." row.";
		
		return $this->db->affected_rows();
	}
	
	public function findArc($ID,$Title) {
		$sql = "SELECT * FROM e0_archives WHERE ID = ".$this->db->escape($ID)." AND Title = ".$this->db->escape($Title);
		$query =  $this->db->query($sql);
		$row = $query->row_array();
		return $row;
	}
}
?>
