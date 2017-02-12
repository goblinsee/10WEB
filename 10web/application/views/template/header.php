<style type="text/css">
 .am-topbar-height{
  height:100px !important;
  margin-left: 0 !important;
  float:left;
}
.am-topbar-white{
  background-color: #ffffff !important;
  height:110px;
  z-index:2000 !important;
}

.am-topbar-wrapper{
  width:1460px !important;
  float:right;

}
.am-right-wrapper{
  width:31.505%;
}
.am-font{
  color:#ffffff !important;
}

.am-hover{
  color:#999999 !important;
}

#am-wrapper{
  margin-top: 60px;
}

.am-banner{
  width:100%;
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
.am-topbar-white .am-span{
  font-weight: bold;
  height:99px;
  float:left;
  width:10%;
  text-align:center;
  font-size: 20px;
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
    margin:-10px 0 0 !important;
}
.am-brand{
    height:100px !important;
    width:100%;
    line-height: 110px !important;
    float: left;
}
.am-topright{
  line-height: 110px !important;
  height:100px !important;
  font-size:16px;
  padding: 0 20px 0 20px;
  margin:0 !important;
}

.am-topright:hover{
  background-color: #f8f8f8 !important;
} 
</style>

<header class="am-topbar am-topbar-fixed-top am-topbar-white">
 <div class="am-header-border ">                
 </div>
 <div class="am-topbar-wrapper">
  <div class="am-container am-topbar-height">
    <div class="am-topbar-brand am-brand">    
        <div style="float:left;">
          <img src="/assets/i/10_mian_logo.png" style="height:60px; margin:0 1%;" />
        </div>

        <div class="am-span">
          <a class="am-dropdown-toggle"  href="javascript:;">
            <span class="dis">首页</span>
          </a>
        </div>

        <div class="am-span">
          <a class="am-dropdown-toggle"  href="javascript:;">
            <span class="dis">项目</span>
          </a>
        </div>

        <div class="am-span ">
          <a class="am-dropdown-toggle" data-am-dropdown-toggle="" href="javascript:;">
            <li class="am-dropdown am-navvv" data-am-dropdown="">
              <span class="dis ">导航</span></a>
              <ul class="am-dropdown-content am-content">
                <li><a href="">社团简介</a></li>
                <li><a href="">技术文章</a></li>
                <li><a href="">社团活动</a></li>
                <li><a href="">生活服务</a></li>
              </ul>
            </li>
          </a>
        </div>

      </div>          
   </div>

   <div class="am-right-wrapper am-topbar-height" id="header-right">
      <div class="am-topright am-topbar-right " style="float:left;text-align:center;">
       <a class="am-dropdown-toggle" data-am-dropdown-toggle="" href="/index.php/signup">
        <span class="am-icon-user "></span> 登录</button>
      </a>
      </div>


      <div class="am-topright am-topbar-right am-topright" style="float:left;text-align:center;">
       <a class="am-dropdown-toggle" data-am-dropdown-toggle="" href="/index.php/signup">
        <span class="am-icon-pencil "></span> 注册</button>
       </a> 
      </div>
   </div>

   <script type="text/javascript">
     $.get('/index.php/api/User/GetUserInfoBySession',function(data){
        data = JSON.parse(data);
        if(data.Flag < 0){
          console.log(data.Content);
          return ;
        }
        var Content = data.Content;
        //已经登陆，显示其他的内容
        $("#header-right").html(
          Content.NickName||"用户xxx"
        );
     });
   </script>

 </div>
</header>

