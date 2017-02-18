<?php  
    require('./application/views/template/html_begin.php');
    require('./application/views/template/header.php');
?>

<link rel="stylesheet" type="text/css" href="/assets/css/message.css">
<body class="am-with-topbar-fixed-top">
    <div class="e0-msg-box" >
        <!-- 聊天框标题 -->
        <div class="e0-msg-box-title">
            <div class="back" id="back-btn"><i class="am-icon am-icon-mail-reply"></i>返回</div>
            <div class="title">全部私信</div>
        </div>
        <!-- 聊天框内容 -->
        <div class="e0-msg-box-content" id="messagebox">
            <?php 

            	foreach ($messages as $msg) {
            		//确认谁是联系人
            		$_self = $msg['Abouter'];
            		
            		if($_self != $msg['Sender']){
            			$_name = $msg['SenderNickName'];
            			$_icon = $msg['SenderHeadIcon'];
            		}else{
            			$_name = $msg['ReceiverNickName'];
            			$_icon = $msg['ReceiverHeadIcon'];
            		}

            		if(!$_icon)
            			$_icon = '/assets/i/default_head_icon.gif';
            ?>
            <!-- 与某个用户的最近的消息 -->
            <div class="e0-msg-com" data-relater-id="<?php echo $msg['Relater']; ?>" >
            	<a href="/index.php/message/detail/<?php echo $msg['Relater'] ?>">
	            	<div class="head-icon">
	            		<img src="<?php echo $_icon; ?>">
	            	</div>
	            	<div class="msg-info">
	            		<div class="info-t clearfix">
	            			<div class="user-name">
	            				<?php echo $_name ?>
	            			</div>
	            			<div class="msg-time">
	            				<?php echo substr($msg['SendTime'],0,19)?>
	            			</div>
	            		</div>

	            		<div class="info-d">
	            			<?php echo $msg['Content']?>
	            		</div>
	            	</div>
            	</a>
            	<div class="msg-setting msg-setting-hidden">
            		<div class="msg-setting-btn"><span class="am-icon-caret-down " ></span></div>
            		<div class="msg-setting-box">
            			<div class="setting-item setting-delete" data-relater-id="<?php echo $msg['Relater']; ?>">
            				<i class="am-icon-trash"></i>
            				<span class="word">删除消息</span>
            			</div>
            		</div>
            	</div>
            </div>
            <?php } ?>

        </div>
    </div>
</body>

<script type="text/javascript">
		$(".msg-setting-btn").click(function(e) {
			$(e.currentTarget).parent().toggleClass('msg-setting-hidden');
		});

		$(".setting-delete").click(function(e) {
			//获取相关用户的id
			var _re_id = $(e.currentTarget).attr('data-relater-id');
		});

		var delete_msg = function(re_id){
			$.ajax({
				url:'/index.php/api/message/'
			});
		}

        $("#back-btn").click(function(e){
            history.go(-1);
        });
</script>

<?php  
    require('./application/views/template/html_end.php');
?>
