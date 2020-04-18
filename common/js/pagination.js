// キャンパスライフ一覧

$(function(){

  var $items = $(".cl-inner .item");
      // console.log($items.length);

  var num = Math.ceil($items.length / 6);
      // console.log(num);

  // ページネーション作成
  var $pn = $(".cl-pages");
  for(var i = 1, l = num; i <= l; i++ ) {
    var li = "<li><a>" + i +  "</a></li>";
    $pn.append(li);
  };

  // 各記事の一つひとつのリンクが、何ページ目の記事か区別できるようにする
  for(var i = 0, l = $items.length; i < l; i++) {
    var page = Math.ceil((i + 1) / 6);
    $items.eq(i).addClass("page-" + page);
      // console.log(page);
  }

  var firstClick = false; 

  // 上記で作成したボタンにクリックイベントを登録
  $(".cl-pages li").on("click", function(){

    // 開いているページのボタンの見た目を変える
    $(".cl-pages li.active").removeClass("active");
    $(this).addClass("active");

    // ボタンをクリックすると、そのページの記事リンクのみが表示されるようにする
    var page = $(".cl-pages li").index(this);
    page += 1;
    $items.removeClass("active");
    $(".cl-inner").find(".page-" + page).addClass("active");
    
    // ボタンをクリックすると記事一覧の上部にスクロールして戻る
    if(firstClick === true) {
      var pos = $(".cl-inner").offset().top - $("header").innerHeight();
      $("html, body").animate({scrollTop: pos}, 300, "swing");
    }
    
    firstClick = true;
    
  });

  // ページを開いた時に1ページ目の記事リンクのみ表示されるようにする
  $(".cl-pages li:first-child").click();

});