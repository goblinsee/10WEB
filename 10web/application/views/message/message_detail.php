<?php  
    require('./application/views/template/html_begin.php');
    require('./application/views/template/header.php');
?>
<link rel="stylesheet" type="text/css" href="/assets/css/message_detail.css">
<body class="am-with-topbar-fixed-top">
    <div class="e0-msg-box">
        <!-- 聊天框标题 -->
        <div class="e0-msg-box-title">
            <div class="back"><i class="am-icon am-icon-mail-reply"></i>返回</div>
            <div class="title">与克莱汤普森的对话</div>
        </div>
        <!-- 聊天框内容 -->
        <div class="e0-msg-box-content">
            <div class="msg-item-l clearfix">
                <div class="msg-item-head">
                    <img src="/assets/i/test_user_head_1.png">
                </div>
                <div class="msg-item-body">
                    你好，我是克莱汤普森，地表投篮最准的人，你是想和我投篮吗？或者只是单纯的关注我而已？
                </div>
            </div>

            <div class="msg-item-r clearfix">
                <div class="msg-item-head">
                    <img src="/assets/i/test_user_head_2.png">
                </div>
                <div class="msg-item-body">
                    额，这只是系统推荐的而已啦，其实...没啥
                </div>
            </div>
        </div>
        <!-- 输入框 -->
        <div class="msg-input">
            <input type="text" placeholder="请输入内容...."></input>
            <button id="msg-send">发送</button>
        </div>
    </div>
</body>

<?php  
    require('./application/views/template/html_end.php');
?>
