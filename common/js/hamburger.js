//ハンバーガーメニュー

$(function(){

  var $btn = $('.nav-button');
  var $menu = $('.menu-area');
  // console.log($btn);
  // console.log($menu);

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
});