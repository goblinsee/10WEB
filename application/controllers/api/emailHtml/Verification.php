<?php  
	/**
	 * 用于生成验证邮件的函数
	 *
	 * @param {string} $auth_url -验证用的url
	 * @param {string} $web_url -我们自己的url
	 * @return {string} -返回的验证邮件的html
	 */
	function getVerifi($auth_url = "#",$web_url = "#"){
		 $id = fopen('emailHtml/Verification.html','r');
		 $Verification =  file_get_contents('emailHtml/Verification.html');
		return sprintf($Verification,$auth_url,$web_url);
	}
?>