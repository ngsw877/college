$(function(){

  var $btn = $('.nav-button');
  // console.log($btn);
  $btn.on('click', function() {
    $(this).toggleClass('active');
    return false;
  });
});