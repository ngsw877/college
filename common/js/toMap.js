// アクセスマップへスクロール移動（スムーススクロール）

$(function(){
  $('a[href="#access"]').click(function(){
    var speed = 500;
    var target = $(this).attr("href");
    var position = $(target).offset().top;

    //~~ どこまでスクロールするのか、位置を調整 ~~//

      //ヘッダーからジャンプする場合
    if($(this).hasClass("to-map1")){
      position -= $(".header-top").innerHeight() + $(".menu-area").innerHeight();
      //ハンバーガーメニューもしくは、ヘッダーからジャンプする場合
    } else {
        var winW = $(window).width();
        var divW = 900; //900px以下になると、ハンバーガーメニュー付ヘッダーに切り替わるため
        if(winW <= divW){
          //900px以下の場合
          position -= $(".header-top").innerHeight();
        } else {
          //900pxより大きい場合
          position -= $(".sticky-header").innerHeight();
        }
    }

    // console.log(this);
    // console.log(position);
    $("html, body").animate({
      scrollTop: position
    }, speed);
    return false;
  });
});