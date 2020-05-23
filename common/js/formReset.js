// 入力情報のリセット(クリア)ボタン

$(function(){
  $('#reset-button').on('click', function(){
    $('input[type="text"]').val('');
    
    $('input[type="tel"]').val('');
    
    $('input[type="checkbox"]').prop('checked', false);

    $('input[type="radio"]').prop('checked', false);

    $('select').find('option:selected').prop('selected', false);
  }); 
});