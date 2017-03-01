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
		select * ,User as Abouter from 
		e0_view_user_msg
		where User = '%s' AND State <> -1
		group by Relater
		order by SendTime desc
STR;
		$sql = sprintf($sql_format,$userid);
		return $this->db->query($sql)->result_array();
	}

	/**
	*	传入当前用户id和目标用户id返回他们之间的所有消息
	*	@param userid varchar(20) 当前用户
	*	@param targetuserid varchar(20) 查找目标用户
	*/
	public function GetMessage($userid,$targetuserid){
		$sql_format = <<<STR
			SELECT 
			*,'%s' as Abouter
			FROM e0_view_user_msg
			WHERE 
			User = '%s' AND Relater = '%s'
			AND State <> -1
			Order By SendTime
STR;
		$sql = sprintf($sql_format,$userid,$userid,$targetuserid);
		$messages = $this->db->query($sql);
		$this->SetUserMsgRead($userid,$targetuserid);
		return $messages->result_array();
	}

	/**
	*	传入消息id，删除id
	*	@param messageid varchar(20)
	*/
	public function DeleteMessage($messageid,$userid){
		$sql = "UPDATE e0_msg SET Type = ".$this->db->escape(-1)." WHERE ID = ".$this->db->escape($messageid)." AND User = ".$this->db->escape($userid);
		$this->db->query($sql);
		return $this->db->affected_rows();
	}

	/**
	*	传入消息id，在表中将状态State设置为已读:0->未读，1->已读, -1->已删除
	*/
	// public function SetMessageRead($messageid){
	// 	$sql = "UPDATE e0_msg SET State = ".$this->db->escape(1)." WHERE ID = ".$this->db->escape($messageid);
	// 	$sql2 = "SELECT * FROM e0_msg WHERE ID = ".$this->db->escape($messageid);
	// 	$this->db->query($sql);
	// 	return $this->db->query($sql2)->result_array();
	// }


	public function SetUserMsgRead($userid,$targetuserid){
		$sql_format = <<<STR
		UPDATE e0_msg
		SET State = 1
		Where 
		User = '%s' AND Relater = '%s'
		AND State = 0
STR;
		$sql = sprintf($sql_format,$userid,$targetuserid);
		$this->db->query($sql);
	}

	/**
	 * 获取当前用户的未读消息的数目 
	 *
	 * @param string $user_id 当前用户的id
	 * @return array 数据库返回的结果
	 */
	public function GetUnreadCount($user_id){
		$sql_format = <<<STR
		SELECT count(*) AS UnreadCount
		FROM e0_view_user_msg
		WHERE User = '%s'AND State = 0 
STR;
		$sql = sprintf($sql_format,$user_id);
		$result = $this->db->query($sql);
		return $result->result_array()[0];
	}


	/**
	 * 标记与某一个用户的私信删除
	 *
	 * @param string $user_id 当前用户的id
	 * @param string $relater_id 相关用户的id
	 * @return boolean 返回是否成功
	 */
	public function DelRelMsg($user_id,$relater_id){
		$sql_format = <<<STR
		UPDATE e0_msg
		SET State = -1
		WHERE 
		User = '%s' AND Relater = '%s'
STR;
		$sql = sprintf($sql_format,$user_id,$relater_id);
		try{
			$result = $this->db->query($sql);	
		}catch(Exception $e){
			return false;
		}
		return true;
	}

	/*管理员部分*/

	/**
	*	获取所有用户的列表
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
	*	Type: 0->系统消息，1->管理员发给用户的消息，2->普通用户的消息, -1->已经删除的消息
	*	@param userid varchar(20) 发送消息对象用户，如果为空表示发送给所有用户
	*	@param content varchar(255)
	*	@return 改变数据库行数：可用来判断发送消息是否成功
	*/
	public function SendMessageToUser($userid,$targetuserid,$content){
		$send_time=date("Y-m-d H:i:s");
		$msgid = uniqid();
		$sql_format = <<<STR
			INSERT INTO e0_msg 
			(ID,User,Relater,Sender,Receiver,Content,SendTime,Type,State)
			VALUES 
			('%s','%s','%s','%s','%s','%s','%s',%s,%s)
STR;
		if($targetuserid === null){
			$allusers = GetAllUsersID();
			foreach ($allusers->result() as $row) {
				$userid = $row->ID;

				$sql_main = sprintf($sql_format,$msgid,$userid,$targetuserid,$userid,$targetuserid,$content,$send_time,2,0);
				$sql_re = sprintf($sql_format,$msgid,$targetuserid,$userid,$userid,$targetuserid,$content,$send_time,2,0);
				$this->db->query($sql_main);
				$this->db->query($sql_re);
				// $sql = "INSERT INTO e0_msg (ID , Sender, Receiver , Content , Type ) VALUES (".$this->db->escape($msgid).", ".$this->db->escape($userid).", ".$this->db->escape($targetuserid).", ".$this->db->escape($content).", ".$this->db->escape(1)." )";
				// $this->db->query($sql);
			}
		}
		else{
			$sql_main = sprintf($sql_format,$msgid,$userid,$targetuserid,$userid,$targetuserid,$content,$send_time,1,0);
			$sql_re = sprintf($sql_format,$msgid,$targetuserid,$userid,$userid,$targetuserid,$content,$send_time,1,0);
			$this->db->query($sql_main);
			$this->db->query($sql_re);
		}
		return $this->db->affected_rows();
	}

	/**
	*	管理员删除消息
	*/
	public function DeleteMessageForAdmin($messageid){
		$sql = "UPDATE e0_msg SET STATE = ".$this->db->escape(-1)." WHERE ID = ".$this->db->escape($messageid);
		$this->db->query($sql);
		return $this->db->affected_rows();
	}
}

?>