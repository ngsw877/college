// 写真ギャラリーを無限ループ 

$(function(){

  var $set = $(".ca-carousel-set");
  var setW = $set.outerWidth();
  var winW = $(window).width();
  // 画面幅を埋めるのに必要なギャラリー(ul)の数を求める
  var num = Math.ceil(winW / setW);
      // console.log(num);

  var $carousel = $(".ca-carousel");

  // 写真ギャラリーの箱(div)を空にする
  $carousel.empty();

  // 画面幅を埋めるのに必要な数 * 2 個分、ギャラリー(ul)を複製する
  for(var i = 0; i < num * 2; i++) {
    $carousel.append($set.clone());
  }

  var stop = false; // フラグ

  var left = 0;
  var cW = setW * num;

  setInterval(function(){

    if(stop === true) return; // trueの場合、以下の処理をスキップ

    if(left + cW === 1) {
      left = 0;
    }else {
      left--;
    }
    $carousel.css("transform", `translateX(${left}px)`);
  }, 33);

  $carousel.on("mouseenter", function(){
    stop = true;
  });

  $carousel.on("mouseleave", function(){
    stop = false;
  });

});