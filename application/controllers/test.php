<?php 
require("phpmailer/class.phpmailer.php"); //下载的文件必须放在该文件所在目录
$mail = new PHPMailer(); //建立邮件发送类
$address ="1304272317@qq.com";
$mail->IsSMTP(); // 使用SMTP方式发送
$mail->Host = "smtp.163.com"; // 您的企业邮局域名
$mail->SMTPAuth = true; // 启用SMTP验证功能
$mail->Username = "nkuhjp@163.com"; // 邮局用户名(请填写完整的email地址)
$mail->Password = "hjp19970215"; // 邮局密码
//$mail->Port=25;
$mail->From = "nkuhjp@163.com"; //邮件发送者email地址
$mail->FromName = "hehe";
$mail->AddAddress("$address", "a");//收件人地址，可以替换成任何想要接收邮件的email信箱,格式是AddAddress("收件人email","收件人姓名")
//$mail->AddReplyTo("", "");

//$mail->AddAttachment("/var/tmp/file.tar.gz"); // 添加附件
//$mail->IsHTML(true); // set email format to HTML //是否使用HTML格式

$mail->Subject = "PHPMailer测试邮件"; //邮件标题
//$mail->Subject = "=?UTF-8?B?" . base64_encode("我的邮件") . "?=";//这可以解决标题编码问2q题
$uuid = '1304272317@qq.com';
$msg = '测试,<a href="http://localhost/e0web/10WEB/index.php/signup/auth/'.$uuid.'"">点我验证</a>';
$mail->Body = $msg; //邮件内容
$mail->AltBody = "This is the body in plain text for non-HTML mail clients"; //附加信息，可以省略

if(!$mail->Send())
{
 echo "邮件发送失败. <p>";
 echo "错误原因: " . $mail->ErrorInfo;
 exit;
}

echo "邮件发送成功";
?>


 ?>