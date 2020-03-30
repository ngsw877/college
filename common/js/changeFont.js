window.addEventListener('load', function(){
  document.getElementById('big').addEventListener('click',function(){
    changeFont('120%');
  });

  document.getElementById('midium').addEventListener('click', function(){
    changeFont('100%');
  });

  this.document.getElementById('small').addEventListener('click', function(){
    changeFont('80%');
  });

});


function changeFont(size) {
  var obj = document.querySelector('.home');
  obj.style.fontSize = size;
}