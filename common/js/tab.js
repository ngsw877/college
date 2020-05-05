// 「本学の３つの強み」タブ切り換え

$(function(){

  var $nav = $(".strength-nav li");
  // console.log($nav);

  $nav.on("click", function(){
    // console.log("clicked");
    // console.log(this);
    $nav.removeClass("active");
    $(this).addClass("active");

    var idx = $(".strength-nav li").index(this);
    // console.log(idx);

    var $items = $(".strength-content .item");
    
    $items.each(function(i, item){
      if(i === idx) {
        // `<div class="item">`に`active`というクラスを付ける
        $(item).addClass("active");
        // コンテンツの透明度をフワッと1にする
        $(item).animate({
          opacity: 1
        }, 500);

      }else{
        // `<div class="item">`から`active`というクラスを外す
        $(item).removeClass("active");
        // コンテンツの不透明度を0にする
        $(item).css("opacity", 0);
      }
    }); // $items.each
  });

  // ページにアクセスした時にJavaScriptが開かれているようにする
  $(".strength-nav li:first-child").click();
});