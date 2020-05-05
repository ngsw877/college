// よくある質問に対する回答をアコーディオン表示

$(function(){
  var dt = $(".qa-content dt");
  // console.log(dt);
  dt.on("click",  function(){
    // console.log("ボタンが押されました");
    var ele = this;
    // console.log(ele);
    $(ele).toggleClass("open");
    $(ele).next().slideToggle();
  });
});