<!DOCTYPE html>
<!-- saved from url=(0049)file:///C:/Users/fancunhao/Desktop/10/index.html# -->
<html class="js cssanimations"><head lang="en"><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="UTF-8">
  <title>亿灵软件开发联盟</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="format-detection" content="telephone=no">
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp">
  <link rel="alternate icon" type="image/png" href="/assets/i/favicon.png">
  <link rel="stylesheet" href="/assets/css/app.css">
  <link rel="stylesheet" href="/assets/css/amazeui.min.css">
  <link rel="stylesheet" href="/assets/css/header.css">
  <link rel="stylesheet" href="/assets/css/article-inside.css">
</head>
<body class="am-with-topbar-fixed-top">
<?php 
  require('./application/views/template/header-detail.php');
?>

<div class="am-article-detail">
  <div class="am-author-header">
    <div class="am-author-info">
      <div class="am-author-pic">
        <img src="/assets/i/user-icon.jpg" class="am-author-icon">
      </div>
      <span class="am-author-name">
        <p class="am-author-mark">作者</p>
        <p class="am-name-mark">麦克李</p>
      </span>
      <span class="am-author-publishdate">
        2016年12月12日17:30:32
      </span>
    </div>
    <div class="am-author-follow">
      <a class="am-dropdown-toggle" data-am-dropdown-toggle="" href="javascript:;">
      <img  id="am-follow-active" src="/assets/i/author-follow-inactive.png">
      <span id="am-author-follow-state">添加关注</span>
      </a>
    </div>
    <hr class="am-article-content-divider">
  </div>
  <div id="am-article-content" >
    <h1 id="am-article-title">从腾讯视频谈起——Javascript Canvas应用</h1>
    <div class="am-article-info">
      <span id="am-article-wordCount">字数:</span>
      <span id="am-article-followCount">喜欢:</span>
      <span id="am-article-readCount">阅读:</span>
      <div id="am-article-time">
        <span>阅读本文需要</span>
        <span id="am-article-timeAssess">3</span>
        <span>分钟</span>
      </div>
    </div>
    <div class="am-article-pic">
    <img id="am-article-attachPic" src="/assets/i/detail-example.jpg">
    </div>
    <div>
    <p id="am-article-text">Canvas是HTML5新增的组件，可以用来绘制各种图表、动画等。由于浏览器对HTML5标准支持不一致，通常在使用Canvas前，用canvas.getContext来测试浏览器是否支持。
    getContext('2d')方法让我们拿到一个CanvasRenderingContext2D对象，所有的绘图操作都需要通过这个对象完成。
    var ctx = canvas.getContext('2d');
    HTML5还有一个WebGL规范，允许在Canvas中绘制3D图形：
    gl = canvas.getContext("webgl");

    绘制图形

    在绘制前，我们先了解一下Canvas的坐标系统canvas-xy。Canvas的坐标以左上角为原点，水平向右为X轴，垂直向下为Y轴，以像素为单位，所以每个点都是非负整数。
    </p>
    </div>

    <div id="uyan_frame" class="am-article-comment"></div>
    <script type="text/javascript" src="http://v2.uyan.cc/code/uyan.js"></script>

  </div>
</div>
<div class="am-article-recommendContainer">
  <div class="am-recommend-article">
    <div class="am-recommend-nav">你还可能关注的文章:</div>
    <div class="am-recommend-list">
      <a class="am-dropdown-toggle" data-am-dropdown-toggle="" href="javascript:;">
      <ul class="am-recomend-list-ul">
      <li class="am-recommend-list-title">
        <h3 class="am-recommend-list-title-style">
          <img class="am-recommend-icon" src="/assets/i/user-icon.jpg">
          人浮于世，这个世界究竟怎么了？
        </h3>
      </li>
      <hr class="am-recommend-list-dash" >
      <li class="am-recommend-list-title">
        <h3 class="am-recommend-list-title-style">
          <img class="am-recommend-icon" src="/assets/i/user-icon.jpg">
          人浮于世，这个世界究竟怎么了？
        </h3>
      </li>
      <hr class="am-recommend-list-dash" >
      <li class="am-recommend-list-title">
        <h3 class="am-recommend-list-title-style">
          <img class="am-recommend-icon" src="/assets/i/user-icon.jpg">
          人浮于世，这个世界究竟怎么了？
        </h3>
      </li>
      <hr class="am-recommend-list-dash" >
      </ul>
      </a>
    </div>
  </div>
</div>







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

<!--[if (gte IE 9)|!(IE)]><!-->
<!--<![endif]-->
<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/js/amazeui.min.js"></script>
<script src="/assets/js/article-inside.js"></script>
</body>
</html>