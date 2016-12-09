<?php 
class UserMessage_model extends CI_MODEL{
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	/**
	*	获取与自己有过交流的用户列表
	*	@param userid varchar(20)
	*/
	public function GetCommunicatedUser($userid){
		$sql = "SELECT DISTINCT Receiver FROM e0_msg WHERE Sender = ".$this->db->escape($userid)." AND Type = ".$this->db->escape(2);
		$sql2 = "SELECT DISTINCT Sender FROM e0_msg WHERE Receiver = ".$this->db->escape($userid)." AND Type = ".$this->db->escape(2);
		$users1 = $this->db->query($sql);
		$users2 = $this->db->query($sql2);
		//先合并两个数组，然后删除重复的用户
		$users = array_unique(array_merge($users1,$users2));
		return $users;
	}

	/**
	*	传入当前用户id和目标用户id返回他们之间的所有消息
	*	@param userid varchar(20) 当前用户
	*	@param mesuserid varchar(20) 查找目标用户
	*/
	public function GetMessage($userid,$mesuserid){
		$sql = "SELECT * FROM e0_msg WHERE ( Sender = ".$this->db->escape($userid)." AND Receiver = ".$this->db->escape($mesuserid)."OR Sender = ".$this->db->escape($mesuserid)." AND Receiver = ".$this->db->escape($userid);
		$messages = $this->db->query($sql);
		return $messages;
	}

	/**
	*	传入消息id，删除id
	*	@param messageid varchar(20)
	*/
	public function DeleteMessage($messageid){
		$sql = "UPDATE e0_msg SET Type = ".$this->db->escape(3)." WHERE ID = ".$this->db->escape($messageid);
		return $this->db->query($sql);
	}

	/**
	*	传入消息id，在表中将状态State设置为已读:0->未读，1->已读
	*/
	public function SetMessageRead($messageid){
		$sql = "UPDATE e0_msg SET State = ".$this->db->escape(1)." WHERE ID = ".$this->db->escape($messageid);
		return $this->db->query($sql);
	}




	/*管理员部分*/

	/**
	*	获取所用用户的列表
	*/
	public function GetAllUsersID(){
		$sql = "SELECT ID FROM e0_user";
		$allusers = $this->db->query($sql);
		return $allusers;
	}

	/**
	*	获取所有用户的消息
	*/
	public function GetAllUsersMessages(){
		$sql = "SELECT * FROM e0_msg";
		$messages = $this->db->query($sql);
		return $messages;
	}

	/**
	*	发送消息给用户
	*	@param userid varchar(20) 发送消息对象用户，如果为空表示发送给所有用户
	*	@param content varchar(255)
	*/
	public function SendMessageToUser($userid = null,$content){
		if($userid === null){
			$allusers = GetAllUsersID();
			foreach ($allusers as $row) {
				$userid = $row['ID'];
				$msgid = md5(uniqid());
				$sql = "INSERT INTO e0_msg (ID , Sender, Receiver , Content , Type ) VALUES (".$this->db->escape($msgid).", ".$this->db->escape("Administrator").", ".$this->db->escape($userid).", ".$this->db->escape($content).", ".$this->db->escape(1);
				return $this->db->query($sql);
			}
		}
		else{
			$sql = "INSERT INTO e0_msg (ID , Sender, Receiver , Content , Type ) VALUES (".$this->db->escape($msgid).", ".$this->db->escape("Administrator").", ".$this->db->escape($userid).", ".$this->db->escape($content).", ".$this->db->escape(1);
			return $this->db->query($sql);
		}
	}

	/**
	*	管理员删除消息
	*/
	public function DeleteMessageForAdmin($messageid){
		$sql = "UPDATE e0_msg SET STATE = ".$this->db->escape(3)." WHERE ID = ".$this->db->escape($messageid);
		return $this->db->query($sql);
	}


}


 ?>