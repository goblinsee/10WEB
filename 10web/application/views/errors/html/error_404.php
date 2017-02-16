<?php  
    require('./application/views/template/html_begin.php');
    require('./application/views/template/header.php');
?>
<link rel="stylesheet" type="text/css" href="/assets/css/error_404_detail.css">
<div class="e0-error-block">
</div>
<div class="e0-error-background">
	<body onload="show()">
	<img id="showimg" width="100%" height="100%" alt="404">
</div>
<?php  
    require('./application/views/template/html_end.php');
?>

<script language="javascript">
function show()
{
	var NowFrame=parseInt(Math.floor(Math.random()*3) + 1);
	document.getElementById("showimg").src="/assets/i/error_"+NowFrame+".png";
	console.log(NowFrame);
}
</script>