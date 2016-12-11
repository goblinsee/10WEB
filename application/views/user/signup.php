
    <label>输入注册邮箱</label><input type="text" id="username"></input>
    <label>密码</label><input type="password" id="password"></input>
    <label>重复密码</label><input type="password"></input>
    <label>拖动滑块完成验证</label>
    <button id="signup">点我注册</button>

<script src="http://cdn.bootcss.com/jquery/3.1.1/jquery.min.js"></script>

<script type="text/javascript">

    function signUp(){
      var data = {
          Account:$("#username").val(),
          Password:$("#password").val()
      };
      $.ajax({
        url:'api/user/signup',
        type:'post',
        data:data,
        success:function(data){
          alert(data);
        }
      });
    }

    $("#signup").click(function(e){
      signUp();
    });

</script>
