$(function(){
  // start
  $('.pickup-slider').slick({
    appendArrows: $(".pickup"),
    slidesToShow: 3,
    slidesToScroll: 1, // 1枚ずつ
    autoplay: true,
    adaptiveHeight: true,
    responsive:[
      {
          breakpoint: 960,
          settings:{
              slidesToShow:2,
          }
      },
      {
          breakpoint: 600,
          settings:{
              slidesToShow:1,
          }
      }
    ]
  });
  // end
});