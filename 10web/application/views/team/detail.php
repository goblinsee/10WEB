<!DOCTYPE html>
<html>
<head>
    <title>社团简介</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="/assets/css/normalize.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/team_detail.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/animate.css">
</head>
<body>
    <!-- 背景 -->
    <div class="team_detail_bg">

        <div class="team_detail_breif">
            
            <div class="breif_item">
                <img src="/assets/i/icon/l_2.png">
                亿灵
            </div>

            <div class="breif_item">
                <img src="/assets/i/icon/l_2.png">
                宣传部
            </div>

            <div class="breif_item">
                <img src="/assets/i/icon/l_2.png">
                设计部
            </div>

            <div class="breif_item">
                <img src="/assets/i/icon/l_2.png">
                web组
            </div>

            <div class="breif_item">
                <img src="/assets/i/icon/l_2.png">
                安卓部
            </div>

        </div>
    
        <!-- 部门的介绍 -->
        <div class="team_detail_body">
            <img src="/assets/i/icon/l_7.png" />
            <div class="body-content">
                <div class="title">
                    <h1>web组</h1>
                </div>
                
                <div class="body">
                </div>

            </div>
        </div>
        
        <!-- 右上角漂浮的tag -->
        <div class="team_detail_tag">
            <img src="/assets/i/icon/l_6.png">
        </div>

        <div class="team_detail_decorate">
            <div class="decorate_1 ">
                <img src="/assets/i/icon/l_1.png">
            </div>
            <div class="decorate_2">
                <img src="/assets/i/icon/l_2.png">
            </div>
            <div class="decorate_3">
                <img src="/assets/i/icon/l_3.png">
            </div>
            <div class="decorate_4">
                <img src="/assets/i/icon/l_4.png">
            </div>

            <div class="decorate_5">
                <img src="./assets/i/icon/l_5.png">
            </div>
        </div>
        
        <!--背景的遮罩-->
        <div class="team_detail_bg_mask">
        </div>
    </div>

<script type="text/javascript" src="/assets/js/jquery.min.js"></script>
<script type="text/javascript">

    var breif_data = [
        {
            title:"亿灵",
            data:``
        },
        {
            title:"宣传部",
            data:``
        },
        {
            title:"设计部",
            data:``
        },
        {
            title:"web组",
            data:`
                <div class="article">
        <h1 class="title">南开亿灵weeeeeeeeb组诚招两名php学徒</h1>

        <!-- 作者区域 -->
        <div class="author">
        <!-- 文章内容 -->
        <div class="show-content">
          <h3><b><i><br></i></b></h3><h3><b><i>我们是谁？</i></b></h3><hr><p>我们是南开软件开发联盟亿灵下属的web开发小组。目前在做的事情是做南开亿灵的官方网站，并把它发展为南开技术人自己的社区。当然以后会有更多更有意思的事情。</p><div class="image-package">
<img src="http://upload-images.jianshu.io/upload_images/1806609-66095bc2ad0a5999.jpg?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240" style="cursor: zoom-in;"><br><div class="image-caption">工作实景</div>
</div><br><h3><b><i>我们需要什么？</i></b></h3><h3><hr></h3><p>-php开发学徒两名，目前团队刚成立不久，主要成员有５名，目前在团队里面结构比较简单，也不希望做过大的扩充，目前由一名项目负责人带领若干开发。目前决定采用master-student的形式，每一名一线开发者带一名学徒。师傅全权负责指导自己的学徒进行对应职位的开发，学徒负责辅助师傅开发。目前只招收大一的学生作为学徒参与团队，也是为了以后长足的发展。</p><p>-我们希望你拥有的品质：</p><p>　　1,基本的编程技能，对编程的热爱</p><p>&nbsp; &nbsp; &nbsp; &nbsp; 2,足够参与开发的时间和热情</p><p>&nbsp; &nbsp; &nbsp; &nbsp; 3,不错的自学能力，能熟练运用搜索引擎查到你所需要的知识</p><p>　　4,不错的情商，与别人和谐相处的能力</p><p><br></p><h3><i>你能得到什么？</i></h3><hr><p>1,php技能的学习和其他的关于web的开发技能</p><p>2,丰富的社团资源。团队由南开腾讯创新俱乐部和亿灵软件开发联盟共同支持，加入小组将获得两个社团的资源支持。</p><p>3,愉悦的项目开发经历。</p><p><br></p><h3><b><i>如何加入我们？</i></b></h3><hr><p>发送自己的简历到 cctv1005s@gmail.com</p><p>我们将会尽快给你安排在线笔试和线下面试。</p><p>欢迎加入我们。</p>
        </div>
        <!--  -->

        <div class="show-foot">
          <a class="notebook" href="/nb/7626481">
            <i class="iconfont ic-search-notebook"></i> <span>xxx</span>
</a>          <div class="copyright" data-toggle="tooltip" data-html="true" data-original-title="转载请联系作者获得授权，并标注“简书作者”。">
            © 著作权归作者所有
          </div>
          
        </div>
    </div>  `
        },
        {
            title:"安卓部",
            data:``
        }
    ];

    var $body_title = $(".body-content .title h1");
    var $body_content = $(".body-content .body");

    $(".breif_item").hover(function(e){
        var text = $(e.currentTarget).text(); 
        var breif_item = {};

        for(var i in breif_data){
            if(breif_data[i].title == text.trim()){
                breif_item = breif_data[i]; 
            }
        }
        $body_title.html(breif_item.title);
        $body_content.html(breif_item.data);
    });
</script>


</body>
</html>