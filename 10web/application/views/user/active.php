<html>
 <head>
  <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=yes" />
  <meta name="apple-mobile-web-app-capable" content="yes" /> 
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
  <meta name="format-detection" content="telephone=yes" />
  <meta name="msapplication-tap-highlight" content="no" />
  <style>
    a:link {
  color: white;
  text-decoration: none;
}

a:visited {
  color: white;
  text-decoration: none;
}

a:hover {
  color: #DDDDEE;
  text-decoration: none;
}

a:active {
  color: #CCCCDD;
  text-decoration: none;
}

.signup-suc-bk {
  background-size: cover;
  color: white;
  font-family: "幼圆","微软雅黑";
  background-image: url(bk.jpg);
  background-position: center
}

.signup-suc-text {
  border: solid;
  border-width: 1;
  width: 110;
  height: 15;
  margin: 1cm;
  text-align: center;
  font-size: 9pt;
  text-align: center;
  cursor: pointer;
}

@media screen and (min-width:600px) {
  .signup-suc-bk {
    margin: 4cm 0cm 1cm 5cm;
    font-size: 25px;
  }@  media screen and (max-width:600px) {
    .signup-suc-bk{margin: 4cm 0cm 1cm 2cm;
    font-size: 15px;
  }
  </style>
  <script type = "text/javascript" >
    var t = 3;
    var int = self.setInterval("clock()", 1000);
    function clock() {
      t--
      <?php //激活某一个用户(完成验证)  
      if($active == 0){  ?>  
        document.getElementById("clock").value="注册成功，将在"+t+"s后回到主页"  
        <?php 
      }
      else{?>  
        document.getElementById("clock").value="已验证成功，无需再次验证，将在"+t+"s后回到主页"<?php } ?>  
      }
      var int=window.setTimeout("jump()",3000);
      function jump(){window.location.href = '/index.php/archive';}
  </script>
    
 </head>
 <body class="signup-suc-bk">
  <output type="text" id="clock" style="border:none"> 
   <!--?phpif($active == 0){ ?--> 注册成功，将在3s后回到主页 
   <!--?php }else{?--> 已验证成功，无需再次验证，将在3s后回到主页 
   <!--?php } ?--> </output>
  <p class="signup-suc-text" onclick="jump()"><a href="/index.php/archive">立即返回</a></p> 
 </body>
</html>
