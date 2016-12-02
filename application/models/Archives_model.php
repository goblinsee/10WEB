<?php
class Archives_model extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->database();
	}
	
	public function addArc($id, $title, $source, $redirectUrl, $littlePicture, $pubDate) {
		$sql = "INSERT INTO e0_archives (ID, Title, Source, RedirectUrl, LitPic, PubDate) VALUES (".$this->db->escape($id).",".$this->db->escape($title).",".$this->db->escape($source).",".$this->db->escape($redirectUrl).",".$this->db->escape($littlePicture).",".$this->db->escape($pubDate).")";
		return $this->db->query($sql);
	}
	
	public function delArc($id, $title) {
		$url = "DELETE FROM e0_archives WHERE ID = ".$this->db->escape($id)."AND Title = ".$this->db->escape($title);
		$this->db->query($url);
		echo "delArc() affected ".$this->db->affected_rows()." row.";
	}
	
	public function editArc() {
		
	}
	
	public function findArc() {
		
	}
}
?>
