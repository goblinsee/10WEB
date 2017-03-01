<?php  
   //html 开始通用头部
   require('./application/views/template/html_begin.php');
?>

<link rel="stylesheet" href="/assets/css/app.css">
<body class="am-with-topbar-fixed-top">

<!-- 通用宽屏头部 -->
<?php 
  require('./application/views/template/header.php');
?>

<!-- banner -->
<div id="am-wrapper">
  <div id="am-banner">
    <div class="am-text-wrapper">
      <!-- 中间的文字 -->
      <div id="am-text">
        <h2>你是开发的艺术家</h2>
        <p class="am-text-style">南开亿灵软件联盟是一个软件艺术联盟。所有你做的，不过是往艺术的道路更进一步</p>
        <p class="am-text-footer">—今日语录—</p>
      </div>
      <!-- 两个指向按钮 -->
      <div class="director">
        <a class="am-icon-chevron-circle-right am-icon-lg" id="next" href="#"></a>
        <a class="am-icon-chevron-circle-left am-icon-lg" id="prev" href="#"></a>
      </div>

    </div>

    <ul id="am-imglist">
      <li><img src="/assets/i/banner.png" class="am-banner"></li>
    </ul>
  </div>
</div>

<!-- 四个导航模块 -->
<div class="detail am-container">
  <div class="detail-item">  
    <a href="/index.php/team">
      <div class="detail-item-icon">
          <div class="e0-icon-book e0-icon"></div>
      </div>
      <div class="intro">
        <span class="title">社团简介</span>
        <p class="am-fontsize">
          我们是一个什么样的社团呢？一群程序员？还是...
        </p>
      </div>
    </a>
  </div>

  <div class="detail-item">  
    <a href="/index.php/archive">
      <div class="detail-item-icon">
          <div class="e0-icon-gear e0-icon"></div>
      </div>
      <div class="intro">
        <span class="title">技术文章</span>
        <p class="am-fontsize">
          大牛的技术分享，总有你想象不到的地方，不妨来看看！
        </p>
      </div>
    </a>
  </div>

  <div class="detail-item">  
    <a href="/index.php/activity">
      <div class="detail-item-icon">
          <div class="e0-icon-bicycle e0-icon"></div>
      </div>
      <div class="intro">
        <span class="title">社团活动</span>
        <p class="am-fontsize">
          社团厉害的活动，和我们要举办的活动，参与进来吧。
        </p>
      </div>
    </a>
  </div>

  <div class="detail-item">  
    <a href="/index.php/webtools">
      <div class="detail-item-icon">
          <div class="e0-icon-tools e0-icon"></div>
      </div>
      <div class="intro">
        <span class="title">web工具</span>
        <p class="am-fontsize">
          查成绩，坐公交，申请投诉，统统都有，快来看看吧！
        </p>
      </div>
    </a>
  </div>
</div>

  <!-- 内容精选 -->
  <div class="am-divide am-container">
    <div>-内容精选-</div>
  </div>

  <!-- 内容精选的容器 -->
  <div class="am-summary am-container" id="am-summary-box">
  </div>
  
<div>
  
</div>

<hr class=" am-container am-article-divider">

<div class="am-drop">
  <!-- 获取更多的内容精选 -->
  <span class="am-icon-chevron-circle-down am-icon-lg am-drop" id="summary-more"></span>
</div>

<div class="hope">
  <div class="am-g am-container">
    <div class="am-leftpart">
        <div><h1 class="hope-title hope-font ">与亿灵一起</h1></div>
        <div><p class="hope-font hope-content">永远不成为技术的过客，永远在路上</p></div>
    </div>
    <div class="am-rightpart">
        <div><h1 class="hope-font">友情链接</h1></div>
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


<script type="text/javascript" src="/assets/js/ejs.min.js"></script>
<script type="text/javascript">
  setTimeout(function(){
    //类似执行主程序，只是为了找到一个入口而已.
    main();
  },0);

  //获取推荐的文章
  var _init_range = 0;
  //精选文章容器
  var $summary_box = $("#am-summary-box");

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

  //初始化内容精选
  var initComArc = function(){
    getComArc(_init_range,function(err,data){
      var _html = ejs.render(summary_box_html,{summary:data});
      $summary_box.append(_html);
    });
  }

  var initMoreBtn = function(){
      //监听获取更多内容精选的内容
      $('#summary-more').click(function(e){
        _init_range +=4;
        initComArc();
      });
  }

  var main = function(){
    //初始化推荐文章
    initComArc();
    //初始化获取更多内容精选的文章
    initMoreBtn();
  }

  var summary_box_html = `
    <% for(var i = 0;i < Math.min(4,summary.length);i++){%>

      <div class="am-summary1">
        <a class="am-dropdown-toggle" data-am-dropdown-toggle="" href="#">
          <div class="am-summary-pic">
            <img src="<%- summary[i].LitPic %>">
          </div>
          <h2 class="am-summary-title">
            <%- summary[i].Title %>
          </h2>
          <p class="am-summary-content">
            
          </p>
        </a>
      </div>

    <% } %>
  `;
</script>

<?php  
  //html 结束通用底部
  require('./application/views/template/html_end.php');
?>



