<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class UserMessage_model extends CI_Model{
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	/**
	*	获取与自己有过交流的用户列表
	*	@param userid varchar(20)
	*/
	public function GetCommunicatedUser($userid){

		$sql_format=<<<STR
		SELECT 
		DISTINCT Receiver,Sender,SenderNickName,ReceiverNickName,SenderHeadIcon,ReceiverHeadIcon,Abouter
		FROM e0_view_user_msg
		WHERE Abouter='%s'
STR;

		$sql = sprintf($sql_format,$userid);
		return $this->db->query($sql)->result_array();
	}

	/**
	*	传入当前用户id和目标用户id返回他们之间的所有消息
	*	@param userid varchar(20) 当前用户
	*	@param mesuserid varchar(20) 查找目标用户
	*/
	public function GetMessage($userid,$mesuserid){
		$sql_format = <<<STR
			SELECT 
			*
			FROM e0_view_user_msg
			WHERE 
			Abouter = '%s' AND 
			(Sender = '%s' OR Receiver = '%s') 
STR;
		$sql = sprintf($sql_format,$userid,$mesuserid,$mesuserid);
		$messages = $this->db->query($sql);
		return $messages->result_array();
	}

	/**
	*	传入消息id，删除id
	*	@param messageid varchar(20)
	*/
	public function DeleteMessage($messageid){
		$sql = "UPDATE e0_msg SET Type = ".$this->db->escape(3)." WHERE ID = ".$this->db->escape($messageid);
		$this->db->query($sql);
		return $this->db->affected_rows();
	}

	/**
	*	传入消息id，在表中将状态State设置为已读:0->未读，1->已读
	*/
	public function SetMessageRead($messageid){
		$sql = "UPDATE e0_msg SET State = ".$this->db->escape(1)." WHERE ID = ".$this->db->escape($messageid);
		$sql2 = "SELECT * FROM e0_msg WHERE ID = ".$this->db->escape($messageid);
		$this->db->query($sql);
		return $this->db->query($sql2)->result_array();
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
		return $messages->result_array();
	}

	/**
	*	发送消息给用户
	*	@param userid varchar(20) 发送消息对象用户，如果为空表示发送给所有用户
	*	@param content varchar(255)
	*	@return 改变数据库行数：可用来判断发送消息是否成功
	*/
	public function SendMessageToUser($userid,$targetuserid,$content){
		if($targetuserid === null){
			$allusers = GetAllUsersID();
			foreach ($allusers->result() as $row) {
				$userid = $row->ID;
				$msgid = md5(uniqid());
				$sql = "INSERT INTO e0_msg (ID , Sender, Receiver , Content , Type ) VALUES (".$this->db->escape($msgid).", ".$this->db->escape($userid).", ".$this->db->escape($targetuserid).", ".$this->db->escape($content).", ".$this->db->escape(1)." )";
				$this->db->query($sql);
			}
		}
		else{
			$msgid = md5(uniqid());
			$sql = "INSERT INTO e0_msg (ID , Sender, Receiver , Content , Type ) VALUES (".$this->db->escape($msgid).", ".$this->db->escape($userid).", ".$this->db->escape($targetuserid).", ".$this->db->escape($content).", ".$this->db->escape(1)." )";
			$this->db->query($sql);
		}
		return $this->db->affected_rows();
	}

	/**
	*	管理员删除消息
	*/
	public function DeleteMessageForAdmin($messageid){
		$sql = "UPDATE e0_msg SET STATE = ".$this->db->escape(3)." WHERE ID = ".$this->db->escape($messageid);
		$this->db->query($sql);
		return $this->db->affected_rows();
	}
}


 ?>