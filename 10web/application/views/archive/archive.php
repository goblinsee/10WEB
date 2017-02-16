<!DOCTYPE html>
<html class="js cssanimations">

<head lang="en">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="UTF-8">
  <title>亿灵软件开发联盟</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="format-detection" content="telephone=no">
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp">
  <link rel="alternate icon" type="image/png" href="assets/i/favicon.png">
  <link rel="stylesheet" href="/assets/css/amazeui.min.css">
  <link rel="stylesheet" href="/assets/css/article-index.css">
  <link rel="stylesheet" href="/assets/css/app.css">
</head>

<body class="am-with-topbar-fixed-top">

<?php 
  require('./application/views/template/header-article.php');
?>
<div class="am-mainpart">
 <!--用户设置栏-->
 <div class="am-container"> 
  <div class="user">
    <div class="user-pic">
      <img src="/assets/i/user-icon.jpg" style="height:100px;width:100px;float:left;">
    </div>
    <div class="user-text" >
      <a class="am-dropdown-toggle" data-am-dropdown-toggle="" href="javascript:;">
      <div class="user-icon">
        <img src="/assets/i/text.png" class="user-icon-pic" >   
      </div>
      <p class="user-op">文字</p>  
      </a>     
    </div>
    <div class="user-setting">
      <a class="am-dropdown-toggle" data-am-dropdown-toggle="" href="javascript:;">
      <div class="user-icon">
        <img src="/assets/i/settings.png" class="user-icon-pic" >   
      </div>
      <p class="user-op">设置</p>  
      </a>
    </div>
    <div class="user-letter">
      <a class="am-dropdown-toggle" data-am-dropdown-toggle="" href="javascript:;">
      <div class="user-icon">
        <img src="/assets/i/envelope.png" class="user-icon-pic" >   
      </div>
      <p class="user-op">私信</p>  
      </a>
    </div>
    <div class="user-follow"  >
      <a class="am-dropdown-toggle" data-am-dropdown-toggle="" href="javascript:;">
      <div class="user-icon">
        <img class="user-icon-pic" id="user-follow-icon" onclick="FollowAuthor()" src="/assets/i/heart-big.png" >   
      </div>
      <p class="user-op" id="user-op-follow">关注</p>  
      </a>
    </div>
  </div>

  <div class="name">
    <p class="name-text">TreeNewBee</p>
  </div>
  
  <!--单条文章-->
  <div class="article-part">
    <div class="author-pic">
      <img src="/assets/i/user-icon.jpg" class="author-pic-size">
    </div>
    <div class="article-wrapper">

    <div class="article-board">
    <div class="author-name">
      <p class="author-name-pos">一只大牛</p>
    </div>

    <div class="article-content">
      <div class="article-pic">
        <img src="/assets/i/JSPic.png">
      </div>

      <div class="article-text">
        <a class="am-dropdown-toggle" data-am-dropdown-toggle="" href="javascript:;">
        <h1>Javascript的历史</h1>
        </a>
        <p>title: JavaScript的历史layout: pagecategory: introductiondate: 2013-01-10modifiedOn: 2013-12-05声明，这是阮一峰老师的文章，附上链接：http://javascript.ruanyifeng.com/introduction/history.html 理解现在的最好方法之一，就是了解历史，本节将全面介绍……JavaScript的历史。
        </p>
      </div>
    </div>

    <div class="article-below-wrapper">
      <div class="article-topic">
        <a class="am-dropdown-toggle" data-am-dropdown-toggle="" href="javascript:;" >
        <span class="am-icon-tag "></span> 前端javascript开发
        </a>
      </div>

      <div class="article-follows">
        <a class="am-dropdown-toggle" data-am-dropdown-toggle="" href="javascript:;" >
        <span  >
          <img id="am-heart-active" onclick="FollowArticle()" src="/assets/i/heart-small.png" >
        </span>
        </a>
        <span id="article-follow-users">100</span>
      </div>
      <div class="article-publish-date">
        <span id="article-user-publish-date" >2017年1月26日 17:30:32</span>
      </div>
    </div>
    </div>
  </div>
  </div>
 </div> 
</div>






<!--底部动画-->
<div class="hope">
  <div class="am-g am-container">
    <div class="am-leftpart">
        <div><h1 class="hope-title hope-font ">与亿灵一起</h1></div>
        <div><p class="hope-font hope-content">永远不成为技术的过客，永远在路上</p></div>
    </div>
    <div class="am-rightpart">
        <div><h1 class="hope-title hope-font">友情链接</h1></div>
        <div >
          <p class="hope-font ">
            <a class="am-dropdown-toggle hope-font hope-content" data-am-dropdown-toggle="" href="javascript:;">南开大学</a>
          </p>
          <p class="hope-font ">
            <a class="am-dropdown-toggle hope-font hope-content" data-am-dropdown-toggle="" href="javascript:;">南开大学软件学院</a>
          </p>
          <p class="hope-font ">
            <a class="am-dropdown-toggle hope-font hope-content" data-am-dropdown-toggle="" href="javascript:;">CI框架</a>
          </p>
          <p class="hope-font ">
            <a class="am-dropdown-toggle hope-font hope-content" data-am-dropdown-toggle="" href="javascript:;">南开腾讯俱乐部</a>
          </p>
    </div>
  </div>
</div>



<!--[if lt IE 9]>
<script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="assets/js/amazeui.ie8polyfill.min.js"></script>
<![endif]-->


<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/js/jquery-3.1.1.min.js"></script>
<script src="/assets/js/amazeui.min.js"></script>
<script src="/assets/js/article-index.js"></script>
</body>
</html>