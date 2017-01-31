<div class="edit-area">
  <input id="title" placeholder="input your title"></input>
  <div contenteditable="true" id="content">
  </div>
</div>

<style>
  #content{
    height: 300px;
    width: 300px;
    border: 1px solid #eee;
    box-shadow: 5px 5px 10px grey;
  }
</style>


<button id="update-btn">
  update
</button>

<script src="http://cdn.bootcss.com/jquery/3.1.1/jquery.min.js"></script>
<script>
  $("#update-btn").click(function(e){
      alert("还没有写提交功能");
  });
</script>
