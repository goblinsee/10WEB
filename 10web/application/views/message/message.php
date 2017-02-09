<?php  
    require('./application/views/template/html_begin.php');
    require('./application/views/template/header.php');
?>


<div id="messagebox" style="margin-top: 60px;">
</div>

<script type="text/javascript" src="/assets/js/ejs.min.js"></script>
<script type="text/javascript">
	$.ajax({
		url:'/index.php/api/user/getcommunicatedusers',
		type:'post',
		success:function(data){
			data = JSON.parse(data);
			var message_box = ejs.render(message_html,{messages:data});
			$("#messagebox").html(message_box);
		}
	});

	var message_html = `
	<% 
		for(var i in messages){
	   var val = messages[i];
	   //解决哪一个是我的问题
	   var {Sender,Receiver,Abouter,SenderNickName,ReceiverNickName} = val;
	   var _re_id = Sender == Abouter ? Receiver:Sender;
	   var _re_nickname = _re_id == Sender ? SenderNickName : ReceiverNickName;
	   if(!_re_nickname){
	   	_re_nickname = "用户" + _re_id.substr(0,3);
	   };
	%>
	<div>
		<a href="/index.php/message/detail/<%- _re_id %>">
		<%= _re_nickname %>
		</a>
	</div>
	<% } %>
	`;
</script>
<?php  
    require('./application/views/template/html_end.php');
?>
