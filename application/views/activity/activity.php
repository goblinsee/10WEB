<!DOCTYPE html>
<html>
<head>
	<title>活动</title>
</head>
<body>

活动列表

活动主题：
	
活动列表：
<div id="activity_list">
</div>
<button id="more">更多</button>

<script src="http://cdn.bootcss.com/jquery/3.1.1/jquery.min.js"></script>

<script type="text/javascript">

	var alldata = [];

	$.ajax({
		url:'api/activity',
		type:'post',
		success:function(data){
			data = JSON.parse(data);
			console.log(data);
			alldata = alldata.concat(data);
			render(alldata);
		}
	});

	var render = function(data){
		var $block = $('#activity_list');
		var html = "";
		for(var i  = 0;i < data.length ;i++){
			html += ""+
			"<li>"+
				"<h1>标题："+data[i].name+"</h1>"+
				"<p>时间："+data[i].date+"</p>"+
			"</li>";			
		}
		$block.html(html);
	}

	$("#more").click(function(e){
	$.ajax({
		url:'api/activity',
		type:'post',
		success:function(data){
			data = JSON.parse(data);
			console.log(data);
			alldata = alldata.concat(data);
			render(alldata);
		}
	});
	});

</script>


</body>
</html>