//文字サイズ変更ボタン（大中小）

window.addEventListener('load', function(){
  document.getElementById('big').addEventListener('click',function(){
    changeFont('120%', '35px');
  });

  document.getElementById('midium').addEventListener('click', function(){
    changeFont('100%', '30px');
  });

  this.document.getElementById('small').addEventListener('click', function(){
    changeFont('80%', '25px');
  });

});


function changeFont(fsize, bsize) {
  // ページ全体の文字サイズを変更
  var obj = document.querySelector('.home');
  obj.style.fontSize = fsize;

  // 大中小ボタンのサイズを変更
  var boxes = document.querySelectorAll('.font-box');
  for(var i = 0; i < boxes.length; i++) {
    boxes[i].style.width = bsize;
    boxes[i].style.height = bsize;
  }
}