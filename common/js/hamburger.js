// ハンバーガーメニュー

$(function(){

  var $btn = $('.nav-button');
  var $menu = $('.menu-area');
  // console.log($btn);
  // console.log($menu);

  // クリック時のアニメーションとモーダルメニュー表示
  $btn.on('click', function() {
    if($(this).hasClass('active')){
      $(this).removeClass('active');
      $('.menu-area').slideUp();
    } else {
      $(this).addClass('active');
      $('.menu-area').slideDown();
    }
    return false;
  });

  // 重なりを避けるため、固定ヘッダー部の高さ分body要素を下に下げる
  var winW = $(window).width();
  var divW = 900; //900px以下になると、ハンバーガーメニュー付ヘッダーに切り替わるため
  if(winW <= divW){
    var height = $('.header-top').height();
    $('main').css('margin-top', height);
  }

});