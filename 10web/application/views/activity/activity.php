
<<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <?php  
   //html 开始通用头部
   require('./application/views/template/html_begin.php');
?>
<!-- 通用宽屏头部 -->
<?php 
  require('./application/views/template/header.php');
?>
  <link rel="stylesheet" type="text/css" href="/assets/css/animate.css">
  <link rel="stylesheet" type="text/css" href="/assets/css/activity.css">
</head>
<!-- 活动头部背景模块样式-->
 
<!-- 活动头部背景模块样式-->
<body class="act_all_body">



<div class="act_headers" id="act_headers_1"> 
<div class="act_headers" id="act_headers_2">
<div class="act_headers" id="act_headers_3">   
<div class="act_headers_4">   
<div  class="act_headcontent">
  <div class="act-span">
    <a class="act-recent"  href="#">
      <span class="dis"  id="act_span_recent">最近</span>
    </a>
  </div>
  <div class="act-span">
    <a class="act-future"  href="#">
     <span class="dis"   id="act_span_future">将来</span>
    </a>
  </div> 
  <div class="act-span">
    <a class="act-intrest"  href="#">
      <span class="dis"  id="act_span_interst">有点意思</span>
    </a>
  </div>
  <div class="act-span">
    <a class="act-useful"  href="javascript:;">
     <span class="dis"  id="act_span_ganhuo">干货</span>
    </a>
   </div> 
  </div>
</div>    
</div> 
</div>
</div>
<!-- 活动body模块样式-->
<div class="the_act_body"  id="the_act_body">

<?php for($i=1;$i<=8;$i++){ ?> 
 <div class="activitybody">
  <div class="act_user" id="act_photo_and_name">
     <div class="act_user" id="act_user_photo">
     <img src="/assets/i/act_img/activity_touicang_logo.fw.png" >
      </div>
     <div class="act_user" id="act_user_name"> 
     <p> Li Yang</p>
      </div>
  </div>

  <div class="activity_poster">  
      <img src="/assets/i/act_img/temp_picture.fw.png"> 
  </div>

  <div class="ativitytitle">
     <p  class="ativitytitle" id="ativitytitle"> 超现实体验 </p>
  </div>
<div class="act_detail_info">
 <div id="activity_info_time">
      <div class="activity_info_time">
        <img src="/assets/i/icon/activity_time_logo.fw.png" name="activity_time_logo">
      </div>
      <div class="activity_info_time">
        <p>2016-12-12</p>
      </div>
</div>
<div id="activity_info_location">
      <div class="activity_info_location">
        <img src="/assets/i/icon/activity_location_logo.fw.png" name="activity_location_logo">
     </div>
      <div class="activity_info_location">
          <p>   西楼报告厅   </p>
      </div>
</div>
<div id="activity_info_operation">
      <div class="activity_info_operation">
      <img src="/assets/i/icon/activity_zan_logo.fw.png" name="activity_operation_logo">
      </div>  
      <div class="activity_info_operation"> <p> 100</p></div>
      <div  class="activity_info_operation"  id="activity_info_operation_looked">
        <div class="activity_info_operation"> 
      <img src="/assets/i/icon/activity_looked_logo.fw.png" name="activity_operation_logo">
      </div>
      <div class="activity_info_operation">  <p> 1024</p></div>
      </div>
      
    </div>
</div>
</div>

<?php } ?>






    <div class="nav"    id="nav" >
    </div>
 
</body>
<?php  
  //html 结束通用底部
  require('./application/views/template/html_end.php');
?>
<script type="text/javascript" src="/assets/js/ejs.min.js"></script>
<script type="text/javascript" src="/assets/js/jquery.min.js"></script>
<script type="text/javascript">
//四个点击事件

 //获取推荐的文章
  var _init_range = 0;
  //精选文章容器
  var $summary_box = $("#the_act_body");

  var getComArc = function(range,cb){
    $.get('/index.php/api/archive/getComArc/' +range,function(data){
      data = JSON.parse(data);
      console.log(data);
      if(data.Flag > 0){
        cb(null,data.Content);
        return ;
      }
      cb(data.Content);
    });
  };

  $("#act_span_recent").click(function(){
    $("#act_span_recent").css("border-bottom","solid 3px black");
     $("#act_span_future").css("border-bottom","none");
      $("#act_span_interst").css("border-bottom","none");
       $("#act_span_ganhuo").css("border-bottom","none");

 getComArc(0,function(err,data){
 $.get('/assets/template/act_item_body.html',function(cat_body){

     var _html = ejs.render(cat_body,{summary:data});
      $summary_box.html(_html);
 });

   
    });
       
  });
  $("#act_span_future").click(function(){
    $("#act_span_recent").css("border-bottom","none");
     $("#act_span_future").css("border-bottom","solid 3px black");
      $("#act_span_interst").css("border-bottom","none");
       $("#act_span_ganhuo").css("border-bottom","none");
        getComArc(1,function(err,data){
 $.get('/assets/template/act_item_body.html',function(cat_body){

     var _html = ejs.render(cat_body,{summary:data});
      $summary_box.html(_html);
 });

   
    });
  });
  $("#act_span_interst").click(function(){
    $("#act_span_recent").css("border-bottom","none");
     $("#act_span_future").css("border-bottom","none");
      $("#act_span_interst").css("border-bottom","solid 3px black");
       $("#act_span_ganhuo").css("border-bottom","none");

 getComArc(2,function(err,data){
 $.get('/assets/template/act_item_body.html',function(cat_body){

     var _html = ejs.render(cat_body,{summary:data});
      $summary_box.html(_html);
 });

   
    });
  });

$("#act_span_ganhuo").click(function(){
    $("#act_span_recent").css("border-bottom","none");
     $("#act_span_future").css("border-bottom","none");
      $("#act_span_interst").css("border-bottom","none");
       $("#act_span_ganhuo").css("border-bottom","solid 3px black");

 getComArc(3,function(err,data){
 $.get('/assets/template/act_item_body.html',function(cat_body){

     var _html = ejs.render(cat_body,{summary:data});
      $summary_box.html(_html);
     });
   });
   });
//点击回到顶部
  //绑定页面滚动事件
$(function(){
 $("#nav").click(function() {
   $("html,body").animate({scrollTop:0}, 500);
 }); 


 });
$(document).ready(function(){  
        var range = 50;             //距下边界长度/单位px  
        var elemt = 500;           //插入元素高度/单位px  
        var maxnum = 60;            //设置加载最多次数  
        var num = 1;  
        var totalheight = 0;   
        var main = $("#the_act_body");                     //主体元素  
        $(window).scroll(function(){  
            var srollPos = $(window).scrollTop();    //滚动条距顶部距离(页面超出窗口的高度)  
              
            //console.log("滚动条到顶部的垂直高度: "+$(document).scrollTop());  
            //console.log("页面的文档高度 ："+$(document).height());  
            //console.log('浏览器的高度：'+$(window).height());  
              
            totalheight = parseFloat($(window).height()) + parseFloat(srollPos);  
            if(($(document).height()-range) <= totalheight  && num != maxnum) {  

         getComArc(3,function(err,data){
            $.get('/assets/template/act_item_body.html',function(cat_body){

            var _html = ejs.render(cat_body,{summary:data});
               $summary_box.append(_html);    
                  num++;  
     });
   });
               
                  
            }  
        });  
    });  


</script>
</html>