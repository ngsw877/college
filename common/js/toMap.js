$(function(){
  $('a[href="#access"]').click(function(){
    var speed = 500;
    var target = $(this).attr("href");
    var position = $(target).offset().top;
    $("html, body").animate({
      scrollTop: position
    }, speed);
    return false;
  });
});