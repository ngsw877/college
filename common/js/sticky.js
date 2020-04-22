// スティッキーヘッダー

$(function(){
  $('#header').each(function(){
    var $window = $(window),
    $stickyHeader = $(this).find('.sticky-header'),//スティッキーヘッダー
    stickyHeaderHeight = $stickyHeader.outerHeight(),//スティッキーヘッダーの高さ
    headerHeight = $(this).outerHeight();//ヘッダー全体の高さ

    //スティッキーヘッダーを画面外へ出して見えなくする
    $stickyHeader.css({ top: '-' + stickyHeaderHeight + 'px' });

    //ページの一番上からヘッダーの高さ分下方向にスクロールしたらtopを0に、それ以外の場合はスティッキーヘッダーを画面外へ出す
    $window.on('scroll', function(){
        if($window.scrollTop() > headerHeight) {
            $stickyHeader.css({top:0});
        } else {
            $stickyHeader.css({ top: '-' + stickyHeaderHeight + 'px' });
       }
    });

    //任意のタイミングでイベントを発生させる
    $window.trigger('scroll');
  });
});