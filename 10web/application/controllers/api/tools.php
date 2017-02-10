<?php
//this php file is used to center the tool function which will be used

/**
 * use to send email to user
 *
 * @param string $account -the email address
 * @param string $email_info -thie email info
 * @param string $base_url -the website base url
 */
function sendMail($account,$email_info,$base_url = "localhost:6070"){

    require("phpmailer/class.phpmailer.php");
    require("emailHtml/Verification.php");

    $email_host = $email_info['email_host'];
    $email_username = $email_info['email_username'];
    $email_password = $email_info['email_password'];

    $mail = new PHPMailer(); //建立邮件发送类
    $address = $account;
    $mail->IsSMTP(); // 使用SMTP方式发送
    $mail->Host = $email_host; // 您的企业邮局域名
    $mail->SMTPAuth = true; // 启用SMTP验证功能
    $mail->Username = $email_username; // 邮局用户名(请填写完整的email地址)
    $mail->Password = $email_password; // 邮局密码
    $mail->From = $email_username; //邮件发送者email地址
    $mail->FromName = "亿灵";
    $mail->AddAddress("$address", "$address");

    //收件人地址，可以替换成任何想要接收邮件的email信箱,格式是AddAddress("收件人email","收件人姓名")
    $mail->Subject = "eling验证"; //邮件标题：要以英文开头
    $_account = urlencode(base64_encode($account));

    //the url input
    $msg = sprintf("%s/index.php/user/activeUser/%s",$base_url,$_account);
    $web_url = $base_url;    
    //the function is used to format a html verifcation html email
    $msg = getVerifi($msg,$web_url);

    //set the content to be html ,not only the text
    $mail->IsHtml(true);
    $mail->Body = $msg; //邮件内容
    return $mail->Send();
}
?>
