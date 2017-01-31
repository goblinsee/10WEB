<?php  
	//激活某一个用户(完成验证)
	if($active == 0){
?>
	验证成功，将在3s之后跳到首页
	<script type="text/javascript">
		setTimeout(function(){
			window.location.href = '/index.php/archive';
		},3000);
	</script>
<?php }else{?>
	
	已经验证，无需再次验证

<?php } ?>

