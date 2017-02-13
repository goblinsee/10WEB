<?php  
    require('./application/views/template/html_begin.php');
    require('./application/views/template/header.php');
?>
<link rel="stylesheet" type="text/css" href="/assets/css/message.css">
<body class="am-with-topbar-fixed-top">
    <div class="e0-msg-box">
        <!-- 聊天框标题 -->
        <div class="e0-msg-box-title">
            <div class="back" id="back-btn"><i class="am-icon am-icon-mail-reply"></i>返回</div>
            <div class="title">与克莱汤普森的对话</div>
        </div>
        <!-- 聊天框内容 -->
        <div class="e0-msg-box-content">
            加载中...
        </div>
        <!-- 输入框 -->
        <div class="msg-input">
            <input id="msg-content" type="text" placeholder="请输入内容...."></input>
            <button id="msg-send">发送</button>
        </div>
    </div>
</body>

<script type="text/javascript" src="/assets/js/ejs.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    setTimeout(function(){
        main();
    },0);

    //获取正在和我对话的用户id
    var re_id = window.location.href.match(/detail.*/)[0];
    re_id = re_id.replace('detail/','');

    //初始化jquery dom变量
    var $msg_content = $("#msg-content");

    //读取对话消息
    var getInitData = function(cb){
        //知道和我对话的人是谁
        $.ajax({
            url:'/index.php/api/message/GetMessage',
            type:'post',
            data:{
                MesUserID:re_id
            },
            success:function(data){
                data = JSON.parse(data);
                cb(null,data.Content);
            }
        });
    };

    //发送消息
    var sendMsg = function(cb){
        $.ajax({
            url:'/index.php/api/message/SendMessageToUser',
            type:'post',
            data:{
                Content:$msg_content.val(),
                TargetUserID:re_id
            },
            success:function(data){
                try{
                    data = JSON.parse(data);
                    if(data.Flag < 0){
                        alert(data.Content);
                        // return ;
                    }
                    cb(null,data);
                }catch(e){
                    cb(e);
                }
                
            }
        });
    }

    //初始化对话消息
    var initMsg = function(){
        getInitData(function(err,data){
            var msg_box_html = ejs.render(_msg_box_html,{messages:data});
            $('.e0-msg-box-content').html(msg_box_html);
        });
    };

    var main = function(){
        //加载对话用户信息，控制标题
        //加载对话
        initMsg();
        //加载返回按钮功能
        initBtn();
    }

    var initBtn = function(){
        //返回按钮
        $("#back-btn").click(function(){
            history.go(-1);
        });
        //发送消息
        var _sendMsg_fn = function(){
            sendMsg(function(err,data){
                if(err){
                    alert("发生错误" + err);
                    return ;
                }
                if(data.Flag > 0){
                    initMsg();
                    $msg_content.val("");
                }
            });
        };
        //发送消息事件监听
        $("#msg-send").click(_sendMsg_fn);
        $msg_content.keydown(function(e){
            if(e.keyCode == 13){
                _sendMsg_fn();    
            }
        });
    }

    var _msg_box_html = `
        <%  
            var default_head = '/assets/i/default_head_icon.gif';
            for(var i in messages){
                var val = messages[i];
                val.SenderHeadIcon = val.SenderHeadIcon||default_head;
                val.ReceiverHeadIcon = val.ReceiverHeadIcon||default_head;
        %>

        <% 
            //如果是我自己发出的消息
            var dire_flag = 'r';
            if(val.Sender == val.Abouter){
                dire_flag = 'r';
            }else{
                dire_flag = 'l';
            }
        %>

        <div class="msg-item-<%- dire_flag %> clearfix">
            <div class="msg-item-head">
                <img src="<%- val.ReceiverHeadIcon %>">
            </div>
            <div class="msg-item-body">
                <%- val.Content %>
            </div>
        </div>
        <%}%>
    `;
});

</script>
<?php  
    require('./application/views/template/html_end.php');
?>
