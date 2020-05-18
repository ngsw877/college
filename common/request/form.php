<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>資料請求フォーム</title>
  <link rel="stylesheet" href="../css/nomalize.css">
  <link rel="stylesheet" href="../css/style.css">
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
</head>
<body>
    <header>
      <div class="request-header">
          <p class="request-logo">
            <img class="logo" src="../images/header-logo.png" alt="令和国際大学ロゴ">
          </p>
      </div>
  </header>
  <main>
    <section class="subvisual request-sv">
      <div class="page-title">
        <h1>資料請求</h1>
      </div>
    </section>
    <section class="breadcrumb">
      <ul>
        <li><a href="../..z/index.html">トップページ</a></li>
        <li>資料請求</li>
      </ul>
    </section>
    <section class="form-wrapper content-wrapper">
      <section class="step-nav">
        <ul>
          <li class="step high-light">情報の入力</li>
          <li class="arrow"></li>
          <li class="step">内容のご確認</li>
          <li class="arrow"></li>
          <li class="step">お申し込み完了</li>
        </ul>
      </section>
      <form action="" method="POST" class="form">
        <div class="check-request">
          <dl>
            <dt class="required">希望資料</dt>
            <dd>
              <ul>
                <li>
                  <label><input type="checkbox" name="documents[]" value="1">大学案内パンフレット</label>
                </li>
                <li>
                  <label><input type="checkbox" name="documents[]" value="2">大学院案内</label>
                </li>
                <li>
                  <label><input type="checkbox" name="documents[]" value="3">入試要項</label>
                </li>
                <li>
                  <label><input type="checkbox" name="documents[]" value="4">過去問題集</label>
                </li>
              </ul>
            </dd>
          </dl>
        </div>
        <div class="input-contents">
          <dl class="name">
            <dt class="required">お名前</dt>
            <dd>
              <p>
                <label>
                  <span>姓</span>
                  <input type="text" name="name1">
                </label>
              </p>
              <p>
                <label>
                  <span>名</span>
                  <input type="text" name="name2">
                </label>
              </p>
            </dd>
          </dl>
          <dl class="kana">
            <dt class="required">フリガナ</dt>
            <dd>
              <p>
                <label>
                  <span>姓</span>
                  <input type="text" name="kana1" placeholder="セイ">
                </label>
              </p>
              <p>
                <label>
                  <span>名</span>
                  <input type="text" name="kana2" placeholder="メイ">
                </label>
              </p>
            </dd>
          </dl>
          <dl class="address">
            <dt  class="required"><span>ご住所</span></dt>
            <dd>
              <p class="zip">
                <label>
                <span>郵便番号</span>
                <input type="text" name="zip1" size="4" maxlength="3">
                <span class="hyphen">-</span>
                <input type="text" name="zip2" size="5" maxlength="4" onKeyUp="AjaxZip3.zip2addr('zip1','zip2','pref','addr1');">
                </label>
              </p>
              <div>
                <p class="pref">
                  <label>
                    <span>都道府県</span>
                    <input type="text" name="pref">
                  </label>
                </p>
                <p class="addr1">
                  <label>
                    <span>市区町村番地</span>
                    <input type="text" name="addr1">
                  </label>
                </p>
                <p class="addr2">
                  <label>
                    <span>マンション／アパート名</span>
                    <input type="text" name="addr2">
                  </label>
                </p>
              </div>
            </dd>
          </dl>
          <dl class="phone">
            <dt class="required">お電話番号</dt>
            <dd>
              <input type="tel" name="phone">
            </dd>
          </dl>
          <dl class="mail">
            <dt class="required">メールアドレス</dt>
            <dd>
              <div>
              <p> <input type="email" name="mail1"></p>
              <p> <input type="email" name="mail2" placeholder="(確認のため再入力)"></p>
              </div>
            </dd>
          </dl>
          <dl class="gender">
            <dt>性別</dt>
            <dd>
              <p>
                <label>
                  <input type="radio" name="gender" value="male">男性
                </label>
              </p>
              <p>
                <label>
                  <input type="radio" name="gender" value="female">女性
                </label>
              </p>
            </dd>
          </dl>
          <dl class="grade">
            <dt class="required">学年</dt>
            <dd>
              <select name="grade">
                <option value="" selected>選択してください</option>
                <option value="1">高校生3年生</option>
                <option value="2">高校生2年生</option>
                <option value="3">高校生1年生</option>
                <option value="4">高専生</option>
                <option value="5">予備校生・浪人生</option>
                <option value="6">大学生</option>
                <option value="7">短大生</option>
                <option value="8">大学院生</option>
                <option value="9">専門学校生</option>
                <option value="10">中学生</option>
                <option value="11">外国人留学生</option>
                <option value="12">社会人</option>
                <option value="13">教育関係</option>
                <option value="14">保護者</option>
                <option value="15">その他</option>
              </select>
            </dd>
          </dl>
          <dl class="school-name">
            <dt><span>高校名</span></dt>
            <dd><input type="text" name="school-name"></dd>
          </dl>
        </div>
        <div class="form-button">
          <button type="submit">入力内容の確認</button>
          <button type="reset">クリア</button>
        </div>
      
      </form>
    </section>
  </main>
  <footer>
    <div class="request-footer">
      <div class="rq-footer-high">
        <p class="request-logo">
          <img class="logo" src="../images/header-logo.png" alt="令和国際大学ロゴ">
        </p>
      </div>
      <div class="rq-footer-low">
        <p>&copy;Reiwa International University. All Rights Reserved.</p>
      </div>
    </div>
    <!-- トップへ戻るボタン -->
    <a href="#" class="button-top"><i class="fas fa-chevron-circle-up"></i></a>
  </footer>

  <!-- jQuery -->
  <script src="../js/jquery-3.4.1.min.js"></script>
  <!-- トップにスクロールで戻るボタン -->
  <script src="../js/toTop.js"></script>

  <!-- 郵便番号から住所検索機能 -->
  <script src="../js/ajaxzip3.js"></script>
</body>
</html>