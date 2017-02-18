<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model{
	public function __construct(){
		$this->load->database();
	}
	
	/**
     *　根据传入的用户id返回用户的个人信息(不包括密码)
     *
     * @param $user_id
	 */
	public function get_by_id($user_id = null){
		if(!$user_id)
			throw new Exception("函数缺少参数：用户id");
		$sql_format = <<<STR
		SELECT
		ID,Account,Profile,Permission,TokenID,LoginTime,LoginIP,HeadIcon,NickName,SignupTime
		FROM e0_user
		WHERE ID = '%s'
STR;
		$sql = sprintf($sql_format,$user_id);
		return $this->db->query($sql)->result_array();
	}
}
?>

