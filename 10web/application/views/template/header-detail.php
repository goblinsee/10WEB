<style type="text/css">
#am-searchbox{
  line-height: 100px;
  font-size:16px;
  height: 32px;
  position: absolute;
    top: 50px;
    right: 25%;
    border-radius: 20px;
    outline: none;
    border-color: #333333;
    padding-left: 10px;
}
.am-search-icon{
  position: absolute;
  top: 55px;
  right: 25.5%
}
.am-topbar-height{
  height:51px !important;
  margin-left: 0 !important;
  float:left;
}
.am-topbar-white{
  background-color: #ffffff !important;
  height:51px;
}

.am-topbar-wrapper{
  width:1460px !important;
  float:right;
  height:51px;
}
.am-right-wrapper{
  width:460px;
}
.am-right-container{
  margin-left: auto;
  margin-right: auto;
  padding-left: 1rem;
  padding-right: 1rem;
  width: 100%;
  max-width: 460px;
}
.am-container:before,
.am-container:after {
  content: " ";
  display: table;
}
.am-container:after {
  clear: both;
}
.am-font{
  color:#ffffff !important;
}

.am-hover{
  color:#999999 !important;
}

.am-banner{
  width:100%;
  /*height:461px;*/
}
.am-header-border{
  height:10px;
  background-color:#000000;
  width:100%;
}

.am-navbarr{
  float: right;
  display: inline;
}

.dis{
  font-size: 16px;
  display: inline-block;
  padding:0 2%;
  height:95px;
  text-align: center;
}
.am-span{
  height:49px;
  float:left;
  width:6%;
  text-align:center;
}
.am-span:hover{
  background-color: #f8f8f8;
}
.am-navvv{
  width:100% !important;
  text-align: center;
}

.am-content{
    opacity: 0.8 !important;
    background-color: #f8f8f8 !important;
    margin:2px 0 0 !important;
}
.am-brand{
    height:51px !important;
    width:100%;
    line-height: 49px !important;
    float: left;
}
.am-topright{
  line-height: 51px !important;
  height:51px !important;
  font-size:16px;
  padding: 0 20px 0 20px;
  margin:0 !important;
}
.am-topright:hover{
  background-color: #f8f8f8 !important;
}

.am-wrap1{
  margin:30px 0;
}
.am-wrap2{
  margin:0 0 10% 0;
}
.am-span-rt{
  float:right;
}

.am-user-menu,.am-author-icon{
  width:39px;
  border-radius:39px;
}
.am-user-menu:hover{

  -webkit-box-shadow: 2px 2px 5px rgba(0,0,0,0.3);  
    -moz-box-shadow: 2px 2px 5px rgba(0,0,0,0.3);  
    box-shadow: 2px 2px 2px  rgba(0,0,0,0.3); 
}

.am-user-dropdown{
  top:41px;
}
/*底栏动画*/
.hope {
    background: #333333;
    padding: 50px 0;
    height: 340px;
}

.hope-title {
    font-size: 200%;
}
.hope-content{
  font-size:20px;
}
.hope-font{
  color:#ffffff !important;

}
.am-leftpart,.am-rightpart{
  width:500px;
}
.am-leftpart{
  float:left;
}
.am-rightpart{
  margin:0 0 0 500px;
}
.clear{
  overflow: hidden;
}
</style>

<header class="am-topbar am-topbar-fixed-top am-topbar-white">
 <div class="am-topbar-wrapper">
  <div class="am-container am-topbar-height">
    <div class="am-topbar-brand am-brand">
      <div style="float:left;">
      <img src="/assets/i/web_logo.png" style="height:48px; margin:0 2%;" >
      </div>
      <div class="am-span">
      <a class="am-dropdown-toggle" data-am-dropdown-toggle="" href="javascript:;">

      <li class="am-dropdown am-navvv" data-am-dropdown="">
      <span class="am-icon-navicon am-icon-md am-marked"></span></a>
     
          <ul class="am-dropdown-content am-content">
            <li class=""></li>
            <li><a href="">社团简介</a></li>
            <li><a href="">技术文章</a></li>
            <li><a href="">社团活动</a></li>
            <li><a href="">生活服务</a></li>
          </ul>
      </li>
      </a>
      </div>
      <a class="am-dropdown-toggle" data-am-dropdown-toggle="" href="javascript:;">      
      <div class="am-span am-span-rt">
        <img id="am-mark" src="/assets/i/unmark.png">
      </div>
      </a>
      </div>          
   </div>
   <div class="am-right-wrapper am-topbar-height">
      <a class="am-dropdown-toggle" data-am-dropdown-toggle="" href="javascript:;"> 
      <div class="am-dropdown">
        <li class="am-dropdown " data-am-dropdown="">
        <span style="line-height:39px">
        <img src="/assets/i/user-icon.jpg" class="am-user-menu">
        </span>
          <ul class="am-dropdown-content am-content am-user-dropdown">
            <li><a href="">我的主页</a></li>
            <li><a href="">我的文章</a></li>
            <li><a href="">收藏的文章</a></li>
            <li><a href="">喜欢的文章</a></li>
            <li><a href="">设置</a></li>
          </ul>
        </li>          
      </div>
      </a>
   </div>
 </div>
</header>