s<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="keywords" content="南开亿灵－登陆">
    <meta name="viewport"
        content="width=device-width, initial-scale=1">
  <title>南开亿灵－登陆</title>
  <link rel="stylesheet" type="text/css" href="/assets/css/amazeui.min.css">
  <link rel="stylesheet" type="text/css" href="/assets/css/animate.css">
  <link rel="stylesheet" type="text/css" href="/assets/css/login.css">
</head>
<body>

<div id="login-bg">
  <div class="login-container">
    <div class="login-icon">
      <a href="/"><img src="/assets/i/web_logo.gif"></a>
    </div>

    <div class="login-body">
       <div data-am-widget="tabs" class="am-tabs am-tabs-login">
            
            <ul class="am-tabs-nav am-cf">
                <li class="am-active">
                  <a href="[data-tab-panel-0]">
                  <span>登陆</span>
                  </a>
                </li>
                <li class="">
                  <a href="[data-tab-panel-1]">
                    <span>注册</span>
                  </a>
                </li>
            </ul>
            <div class="am-tabs-bd">
                
                <!--登陆输入框组-->
                <div data-tab-panel-0 class="am-tab-panel am-active">
                  
                  <div class="login-input-box">
                    
                    <div class="login-input">
                      <input type="text" placeholder="请输入邮箱" id="login-username" maxlength="35" />  
                      <i class="am-icon-envelope am-icon-fw"></i>
                    </div>

                    <div class="login-input">
                      <input type="password" placeholder="请输入密码" id="login-password" maxlength="35"/> 
                      <i class="am-icon-lock am-icon-fw"></i>
                    </div>

                  </div>

                  <div class="check-btn">
                    <button id="login-btn">
                      登陆
                    </button>
                  </div>

                  <div class="login-info">
                    <a href="#" title="忘记密码?">忘记密码？</a>
                  </div>
                  <!--登陆输入框结束-->

                </div>
            
            <!--注册输入框组-->
                <div data-tab-panel-1 class="am-tab-panel ">
                  
                  <div class="login-input-box">
                    
                    <div class="login-input">
                      <input type="text" placeholder="请输入名字" id="sign-usernick" maxlength="35"/>  
                      <i class="am-icon-user am-icon-fw"></i>
                    </div>

              <div class="login-input">
                      <input type="text" placeholder="请输入邮箱" id="signup-username" maxlength="35"/>  
                      <i class="am-icon-envelope am-icon-fw"></i>
                    </div>

                    <div class="login-input">
                      <input type="password" placeholder="请输入密码" id="sign-password" maxlength="35"/>  
                      <i class="am-icon-lock am-icon-fw"></i>
                    </div>

                  </div>

                  <div class="check-btn ">
                    <button id="sign-btn">注册</button>
                  </div>

                  <div class="signup-info">
                    已有账号？<a href="＃" id="click2login">点我登陆</a>
                  </div>
                  <!--注册输入框结束-->

                </div>
            </div>
        </div>
    </div>
  </div>
</div>

  <script type="text/javascript" src="/assets/js/jquery.min.js"></script>
  <script type="text/javascript" src="/assets/js/amazeui.min.js"></script>
  <script type="text/javascript" src="/assets/js/particles.js"></script>
  <script type="text/javascript" src="/assets/js/login.js"></script>

</body>
</html>