(function($) {
  'use strict';

  $(function() {
    var $fullText = $('.admin-fullText');
    $('#admin-fullscreen').on('click', function() {
      $.AMUI.fullscreen.toggle();
    });

    $(document).on($.AMUI.fullscreen.raw.fullscreenchange, function() {
      $fullText.text($.AMUI.fullscreen.isFullscreen ? '退出全屏' : '开启全屏');
    });
  });
})(jQuery);

function FollowArticle(){
  var element=document.getElementById("am-heart-active");
  element.src="/assets/i/heart-small-active.png";
  document.getElementById("article-follow-users").innerHTML='101';
}

function FollowAuthor(){
  var element=document.getElementById("user-follow-icon");
  element.src="/assets/i/heart-big-active.png";
  var element1=document.getElementById("user-op-follow");
  element1.innerHTML='已关注';
}


$("#am-search-button").click(function(){
  $.ajax({
    url:'/index.php/api/Archive/find',
    type:'post',
    dataType:'JSONP',
    data:{
      Title:document.getElementById("am-searchbox").value
    },
    success:function(){
      alert("!!!");
    }
  });
});

