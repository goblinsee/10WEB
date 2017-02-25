<?php  
    require('./application/views/template/html_begin.php');
    require('./application/views/template/header.php');
?>
<link rel="stylesheet" type="text/css" href="/assets/css/error_404_detail.css">
<div class="e0-error-block">
</div>
<div class="e0-error-background">
	<div id="bg-color">
		<body onload="show()">
		<img id="showimg" alt="404">
	</div>
</div>
<?php  
    require('./application/views/template/html_end.php');
?>

<script language="javascript">
function show()
{
	var NowFrame=parseInt(Math.floor(Math.random()*3) + 1);
	document.getElementById("showimg").src="/assets/i/error_"+NowFrame+".png?asd=asds";
	if (NowFrame == 2)
		document.getElementById("bg-color").style="background-color:#c3a067;height:611px";
	else if (NowFrame == 3)
		document.getElementById("bg-color").style="background-color:#f8e300;height:611px;";
	// console.log(NowFrame);
}
</script>
