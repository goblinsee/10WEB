<?php  
   //html 开始通用头部
   require('./application/views/template/html_begin.php');
?>
<!-- 通用宽屏头部 -->
<?php 
  require('./application/views/template/header.php');
?>
<!-- 活动头部背景模块样式-->
  <link rel="stylesheet" type="text/css" href="/assets/css/normalize.css">
  <link rel="stylesheet" type="text/css" href="/assets/css/team_detail.css">
  <link rel="stylesheet" type="text/css" href="/assets/css/animate.css">
  <link rel="stylesheet" type="text/css" href="/assets/css/activity.css">
<!-- 活动头部背景模块样式-->
<div class="act_headers" id="act_headers_1"> 
<div class="act_headers" id="act_headers_2">
<div class="act_headers" id="act_headers_3">   
<div class="act_headers_4">   
<div  class="act_headcontent">
  <div class="act-span">
    <a class="act-recent"  href="/">
      <span class="dis">最近</span>
    </a>
  </div>
  <div class="act-span">
    <a class="act-future"  href="javascript:;">
     <span class="dis">将来</span>
    </a>
  </div> 
  <div class="act-span">
    <a class="act-intrest"  href="/">
      <span class="dis">有点意思</span>
    </a>
  </div>
  <div class="act-span">
    <a class="act-useful"  href="javascript:;">
     <span class="dis">干货</span>
    </a>
   </div> 
  </div>
</div>    
</div> 
</div>
</div>
<!-- 活动body模块样式-->
<body class="the_content_of_act">
<div class="the_act_body">
 </div>  
<div class=""  id="nav">
</div>

 </div>
  
</body>

<?php  
  //html 结束通用底部
  require('./application/views/template/html_end.php');
?>