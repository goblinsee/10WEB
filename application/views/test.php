<script src="http://cdn.bootcss.com/jquery/3.1.1/jquery.min.js"></script>

<button id="signup">xin jian wen zhang </button>

<script type="text/javascript">
    $("#signup").click(function(event) {
        /* Act on the event */
        $.ajax({
            url:'../api/archive/add',
            type:'post',
            data:{
                Title:"hello",
                Source:"asdasdasdsadweqwe"
            },
            success:function(data){
                alert(data);
                alert("tianjia wen zhang cheng gong");
            }
        });
    });
</script>
