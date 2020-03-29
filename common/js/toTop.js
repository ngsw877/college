$(function(){

  var height = $(window).height();
    // console.log(height);
  $(window).on("scroll", function(){
    // console.log("スクロール中...");
    var scroll = $(window).scrollTop();
    // console.log(scroll);
    if(height/2 < scroll) {
      // console.log("over");
      $(".button-top").addClass("active");
    }else {
      // console.log("under");
      $(".button-top").removeClass("active");
    }
  });

  $(".button-top").on("click", function(){
    $("html, body").animate({scrollTop: 0}, 500, "swing");
  });

});