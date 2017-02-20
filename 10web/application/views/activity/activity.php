<?php  
   //html 开始通用头部
   require('./application/views/template/html_begin.php');
?>

<!-- 通用宽屏头部 -->
<?php 
  require('./application/views/template/header.php');
?>

<!-- 活动头部背景模块样式-->
<style type="text/css">
   .act_headers{
    height: 196px;
    position: relative;
   }
  #act_headers_1{
    background: url(/assets/i/act_img/activity_head_bg.fw.png);
  }
  #act_headers_2{
    background: url(/assets/i/act_img/act_head_bg.fw.png);
  }
  #act_headers_3{
    background: url(/assets/i/act_img/activity_wenzi_logo.fw.png);
    background-position: center;
    background-repeat: no-repeat;

  }
  .act_headers_4{
    height: 40px;
    position: relative;
    background-color: #BDBDBD;
    opacity:0.8;
    top: 140px;
    text-align: center;
    width: 100%;
  }
.act-span{
  color: #000;
  height: 26px;
  width: 100px;
  display: inline-block;
   border-right:solid 3px black;
}
.dis{
  font-size: 20px;
  display: inline-block;
  padding:0 2%;
  height:95px;
  text-align: center;
}
.act_headcontent{
  padding-top: 5px;
  text-align: center;
  display: inline-block;
}

</style>

<!-- 活动body样式 -->

<style type="text/css">
  .the_act_body{

    width: 1000px;
    left: 300px;
    padding-top: 20px;
    background: #fff;
    position: relative;
  }
  .activitybody{
    width: 226px;
    height: 340px;
    background: #eee;
    position: relative;
  }
  .act_user{
    position: relative;
    display: inline-block; 
  }
  #act_user_name{
    font-size: 15px;
    height:20px;
  }

  .activity_poster
  {
       width: 226px;
       height: 168px;
  }
  .ativitytitle{
     width: 228px;
     height: 31px;
     font-size: 25px;
     top: 14px;
     padding:0 2%;;
  }
  .activity_detail_info{
       position: relative;
       width: 100%;
       padding-left: 10px;
      
  }
  .activity_info_time{
       height: 20px;
       position: relative;
       display: inline-block; 
       margin-top: 5px;
  }
   .activity_info_location{
       margin-top: 5px;
       height: 20px;
       position: relative;
       display: inline-block; 
  }
   .activity_info_operation{
       height: 20px;
       position: relative;
       display: inline-block; 
  }
  #activity_info_operation_looked{
       margin-top: 5px;
       margin-left: 20px;
       height: 20px;
       position: relative;
  }
  #nav {
      width:64px; 
      height: 63px; 
      position:fixed;
      right:20%;
      top:70%;
      background: url(/assets/i/act_img/activity_float_button.fw.png);
     }

</style>
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
<div class="the_act_body">
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
     <p  class="ativitytitle" id="ativitytitle">  超现实体验 </p>
  </div>
<div class="act_detail_info">
 <div class="#">
      <div class="activity_info_time">
        <img src="/assets/i/icon/activity_time_logo.fw.png" name="activity_time_logo">
      </div>
      <div class="activity_info_time">
        <p>2016-12-12</p>
      </div>
</div>
<div class="#">
      <div class="activity_info_location">
        <img src="/assets/i/icon/activity_location_logo.fw.png" name="activity_location_logo">
     </div>
      <div class="activity_info_location">
          <p> 西楼报告厅</p>
      </div>
</div>
<div class="activity_info_operation">
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
 </div>
  
<div id="nav"></div>
 </div>
  

<?php  
  //html 结束通用底部
  require('./application/views/template/html_end.php');
?>