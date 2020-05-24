<?php
// ini_set('display_errors',1); 


$mode = !empty($_POST['mode']) ? $_POST['mode'] : '';
session_start();


# 送信完了画面へのリンク
$completion_page = "./thanks.html";

# 確認画面から「送信」もしくは「戻る」をクリックした際の移動先
$index = "./index.php";

# 送信後画面からの戻り先
$top_page = "../../index.php";


foreach($_POST as $key => $value) {
  # 文字コードをUTF-8に統一
  if(!is_array($value)) {
    $enc = mb_detect_encoding($value);
    $value = mb_convert_encoding($value, "UTF-8", $enc);

    # 特殊文字を無効化
    $value = htmlentities($value , ENT_QUOTES , "UTF-8");
  }

  $_POST[$key] = $value;
}

# 入力情報の受け取り
$name1 = $_POST['name1'];
$name2 = $_POST['name2'];
$kana1 = $_POST['kana1'];
$kana2 = $_POST['kana2'];
$zip1 = $_POST['zip1'];
$zip2 = $_POST['zip2'];
$pref = $_POST['pref'];
$addr1 = $_POST['addr1'];
$addr2 = $_POST['addr2'];
$phone = $_POST['phone'];
$mail1 = $_POST['mail1'];
$mail2 = $_POST['mail2'];
$gender = $_POST['gender'];
$grade1 = $_POST['grade1'];
$grade2 = ''; // value値を、日本語に変換した値を格納
$school_name = $_POST['school-name'];

# 選択された希望資料を配列として受け取り
$documents[] = '';
$documents_text = '';
if(!empty($_POST['documents']) && is_array($_POST['documents'])) {
  $documents = $_POST['documents'];
  foreach($documents as $key => $value) {
    if($value == 0 ) {
      $documents[$key] = '大学案内パンフレット';
    }
    if($value == 1 ) {
      $documents[$key] = '大学院案内';
    }
    if($value == 2 ) {
      $documents[$key] = ' 入試要項';
    }
    if($value == 3 ) {
      $documents[$key] = '過去問題集';
    }
  }
  $documents_text = implode('<br>', $documents);
}

# エラーメッセージ
$error_documents = '';
$error_name1 = '';
$error_name2 = '';
$error_kana1 = '';
$error_kana2 = '';
$error_zip = '';
$error_pref = '';
$error_addr = '';
$error_phone = '';
$error_mail1 = '';
$error_mail2 = '';
$error_gender = '';
$error_grade = '';
$error_school_name = '';

if($mode) {
  if (empty($_SESSION['token']) || $_SESSION['token'] != $_POST['token']) {
    die('不正な遷移です');
  }

  if(empty($documents)) {
    $error_documents = '希望資料が選択されていません';
  }

    if(empty($name1)) {
      $error_name1 = '姓が未入力です';
    }

    if(empty($name2)) {
      $error_name2 = '名が未入力です';
    } 
    
    if(empty($kana1)) {
      $error_kana1 = 'カナ姓が未入力です';
    } else if(!preg_match("/^[ァ-ヶー]+$/u", $_POST['kana1'])) {
      $error_kana1 = 'カタカナで入力してください';
    } 

    if(empty($kana2)) {
      $error_kana2 = 'カナ名が未入力です';
    } else if(!preg_match("/^[ァ-ヶー]+$/u", $_POST['kana2'])) {
      $error_kana2 = 'カタカナで入力してください';
    } 

    if(empty($zip1) || empty($zip2)) {
      $error_zip = '郵便番号が未入力です';
    } else if
        (!preg_match("/^[0-9]{3}/", $zip1) || 
        !preg_match("/^[0-9]{4}/", $zip2)) {
      $error_zip = '郵便番号を正しく入力してください';
    } 

    if(empty($pref)) {
      $error_pref = '都道府県が未入力です';
    } 

    if(empty($addr1)) {
      $error_addr = '市区町村番地が未入力です';
    } 

    if(empty($phone)) {
      $error_phone = '電話番号が未入力です';
    } else if(!preg_match("/^(0{1}[0-9]{9,10})$/", $phone)) {
      $error_phone = '電話番号を正しく入力してください';
    }

    if(empty($mail1)) {
      $error_mail1 = 'メールアドレスが未入力です';
    } else if(!preg_match("/^[A-Za-z0-9]{1}[A-Za-z0-9_.-]*@{1}[A-Za-z0-9_.-]{1,}\.[A-Za-z0-9]{1,}$/", $mail1)) {
      $error_mail1 = 'メールアドレスをを正しく入力してください';
    }

    if(empty($mail2)) {
      $error_mail2 = 'メールアドレスが未入力です';
    } else if($mail1 != $mail2) {
      $error_mail2 = 'メールアドレスが一致していません';
    } else if(!preg_match("/^[A-Za-z0-9]{1}[A-Za-z0-9_.-]*@{1}[A-Za-z0-9_.-]{1,}\.[A-Za-z0-9]{1,}$/", $mail2)) {
      $error_mail2 = 'メールアドレスをを正しく入力してください';
    }

  if(isset($gender)) {
    if($gender == 'male') {
      $gender = '男性';
    } else {
      $gender = '女性';
    }
  }

  if(empty($grade1) || $grade1 == 0) {
    $error_grade = '学年が未入力です';
  } else {
      switch ($grade1) {
        case 1:
          $grade2 = '高校生3年生';
        break;
        case 2:
          $grade2 = '高校生2年生';
        break;
        case 3:
          $grade2 = '高校生1年生';
        break;
        case 4:
          $grade2 = '高専生';
        break;
        case 5:
          $grade2 = '予備校生・浪人生';
        break;
        case 6:
          $grade2 = '大学生';
        break;
        case 7:
          $grade2 = '短大生';
        break;
        case 8:
          $grade2 = '大学院生';
        break;
        case 9:
          $grade2 = '専門学校生';
        break;
        case 10:
          $grade2 = '中学生';
        break;
        case 11:
          $grade2 = '外国人留学生';
        break;
        case 12:
          $grade2 = '社会人';
        break;
        case 13:
          $grade2 = '教育関係';
        break;
        case 14:
          $grade2 = '保護者';
        break;
        case 15:
          $grade2 = 'その他';
        break;
    }
  }

  # 入力内容にエラーがあれば、再度inputモードへ #
  if (
      $error_documents ||
      $error_name1 ||
      $error_name2 ||
      $error_kana1 ||
      $error_kana2 ||
      $error_zip ||
      $error_pref ||
      $error_addr ||
      $error_phone ||
      $error_mail1 ||
      $error_mail2 ||
      $error_gender ||
      $error_grade ||
      $error_school_name 
      ) {
          $mode = 'input';
        }

  # 確認画面から、送信完了画面に移動 #
  if($mode == 'submit') {
    session_destroy();
    ## ※ここにメール送信処理を実装予定 ##
    header('Location:' . $completion_page);
    exit;
  }

} else {
  $mode = 'input';
  $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(16));
}

?>

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
        <li><a href="../../index.html">トップページ</a></li>
        <li>資料請求</li>
      </ul>
    </section>


<!--
#===========================================================
#  フォーム'入力画面'モード
#=========================================================== 
-->

    <?php if($mode == 'input'):  ?>

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

        <form action="index.php"  method="POST" class="form">
          <input type="hidden" name="mode" value="confirm">
          <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
          
          <div class="check-request">
            <dl>
              <dt class="required">希望資料</dt>
              <dd>
                <!-- エラーメッセージ -->
                <?php if($error_documents): ?>
                  <span class="error-message">
                    <?php echo $error_documents; ?>
                  </span>
                <?php endif; ?>
                <!-- ---------------- -->
                <ul>
                  <li>
                    <label>
                      <input type="checkbox" name="documents[0]" value="0" 
                      <?php if(!empty($documents[0])) {echo 'checked';} ?> >
                      大学案内パンフレット
                    </label>
                  </li>
                  <li>
                    <label>
                      <input type="checkbox" name="documents[1]" value="1" 
                      <?php if(!empty($documents[1])) {echo 'checked';} ?> >
                      入試要項
                    </label>
                  </li>
                  <li>
                    <label>
                      <input type="checkbox" name="documents[2]" value="2" 
                      <?php if(!empty($documents[2])) {echo 'checked';} ?> >
                      入試要項
                    </label>
                  </li>
                  <li>
                    <label>
                      <input type="checkbox" name="documents[3]" value="3" 
                      <?php if(!empty($documents[3])) {echo 'checked';} ?> >
                      過去問題集
                    </label>
                  </li>
                </ul>
              </dd>
            </dl>
          </div>
          <div class="input-contents">
            <dl class="name">
              <dt class="required">お名前</dt>
              <dd>
                <div class="content">
                  <!-- エラーメッセージ -->
                  <?php if($error_name1): ?>
                    <span class="error-message">
                      <?php echo $error_name1; ?>
                    </span>
                  <?php endif; ?>
                  <!-- ---------------- -->
                  <p>
                    <label>
                      <span>姓</span>
                      <input type="text" name="name1" value="<?php echo $name1; ?>">
                    </label>
                  </p>
                </div>

                <div class="content">
                  <!-- エラーメッセージ -->
                  <?php if($error_name2): ?>
                    <span class="error-message">
                      <?php echo $error_name2; ?>
                    </span>
                  <?php endif; ?>
                  <!-- ---------------- -->
                  <p>
                    <label>
                      <span>名</span>
                      <input  class="name2" type="text" name="name2" value="<?php echo $name2; ?>">
                    </label>
                  </p>
                </dd>
              </dl>
              <dl class="kana">
                <dt class="required">フリガナ</dt>
                <dd>
                  <div class="content">
                    <!-- エラーメッセージ -->
                    <?php if($error_kana1): ?>
                      <span class="error-message">
                        <?php echo $error_kana1; ?>
                      </span>
                    <?php endif; ?>
                    <!-- ---------------- -->
                    <p>
                      <label>
                        <span>姓</span>
                        <input type="text" name="kana1" placeholder="セイ" value="<?php echo $kana1; ?>">
                      </label>
                    </p>
                  </div>
                  <div class="content">
                    <!-- エラーメッセージ -->
                    <?php if($error_kana2): ?>
                      <span class="error-message">
                        <?php echo $error_kana2; ?>
                      </span>
                    <?php endif; ?>
                    <!-- ---------------- -->
                    <p>
                      <label>
                        <span>名</span>
                        <input type="text" name="kana2" placeholder="メイ" value="<?php echo $kana2; ?>">
                      </label>
                    </p>
                  </div>
                </dd>
              </dl>
            <dl class="address">
              <dt  class="required"><span>ご住所</span></dt>
              <dd>
                <div class="zip">
                    <!-- エラーメッセージ -->
                    <?php if($error_zip): ?>
                      <span class="error-message">
                        <?php echo $error_zip; ?>
                      </span>
                    <?php endif; ?>
                    <!-- ---------------- -->
                  <label for="zip1">
                    <span>郵便番号</span>
                  </label>
                    <input type="text" id="zip1" name="zip1" size="4" maxlength="3" value="<?php echo $zip1; ?>">
                    <span class="hyphen">-</span>
                    <input type="text" name="zip2" size="5" maxlength="4" onKeyUp="AjaxZip3.zip2addr('zip1','zip2','pref','addr1');" value="<?php echo $zip2; ?>">
                </div>
                <div>
                  <div class="pref">
                    <!-- エラーメッセージ -->
                    <?php if($error_pref): ?>
                      <span class="error-message">
                        <?php echo $error_pref; ?>
                      </span>
                    <?php endif; ?>
                    <!-- ---------------- -->
                    <label>
                      <span>都道府県</span>
                      <input type="text" name="pref" value="<?php echo $pref; ?>">
                    </label>
                  </div>
                  <div class="addr1">
                    <!-- エラーメッセージ -->
                    <?php if($error_addr): ?>
                      <span class="error-message">
                        <?php echo $error_addr; ?>
                      </span>
                    <?php endif; ?>
                    <!-- ---------------- -->
                    <label>
                      <span>市区町村番地</span>
                      <input type="text" name="addr1" value="<?php echo $addr1; ?>">
                    </label>
                  </div>
                  <div class="addr2">
                    <label>
                      <span>マンション／アパート名</span>
                      <input type="text" name="addr2" value="<?php echo $addr2; ?>">
                    </label>
                  </div>
                </div>
              </dd>
            </dl>
            <dl class="phone">
              <dt class="required">お電話番号</dt>
              <dd>
                <!-- エラーメッセージ -->
                <?php if($error_phone): ?>
                  <span class="error-message">
                    <?php echo $error_phone; ?>
                  </span>
                <?php endif; ?>
                <!-- ---------------- -->
                <input type="tel" name="phone" value="<?php echo $phone; ?>">
              </dd>
            </dl>
            <dl class="mail">
              <dt class="required">メールアドレス</dt>
              <dd>
                <div>
                <p> 
                  <!-- エラーメッセージ -->
                  <?php if($error_mail1): ?>
                    <span class="error-message">
                      <?php echo $error_mail1; ?>
                    </span>
                  <?php endif; ?>
                  <!-- ---------------- -->
                  <input type="text" name="mail1" value="<?php echo $mail1; ?>">
                </p>
                <p>
                  <!-- エラーメッセージ -->
                  <?php if($error_mail2): ?>
                    <span class="error-message">
                      <?php echo $error_mail2; ?>
                    </span>
                  <?php endif; ?>
                  <!-- ---------------- -->
                  <input type="text" name="mail2" placeholder="(確認のため再入力)" value="<?php echo $mail2; ?>">
                </p>
                </div>
              </dd>
            </dl>
            <dl class="gender">
              <dt>性別</dt>
              <dd>
                <p>
                  <label>
                    <input type="radio" name="gender" value="male" 
                    <?php if($gender == '男性') {echo "checked";} ?> >男性
                  </label>
                </p>
                <p>
                  <label>
                    <input type="radio" name="gender" value="female" 
                    <?php if($gender == '女性') {echo "checked";} ?> >女性
                  </label>
                </p>
              </dd>
            </dl>
            <dl class="grade">
              <dt class="required">学年</dt>
              <dd>
                <!-- エラーメッセージ -->
                <?php if($error_grade): ?>
                  <span class="error-message">
                    <?php echo $error_grade; ?>
                  </span>
                <?php endif; ?>
                <!-- ---------------- -->
                <select name="grade1">
                  <option value="0" selected>選択してください</option>
                  <option value="1" 
                  <?php if($grade2 == '高校生3年生') {echo 'selected';} ?>>
                  高校生3年生
                  </option>
                  <option value="2" 
                  <?php if($grade2 == '高校生2年生') {echo 'selected';} ?>>
                  高校生2年生
                  </option>
                  <option value="3" 
                  <?php if($grade2 == '高校生1年生') {echo 'selected';} ?>>
                  高校生1年生
                  </option>
                  <option value="4" 
                  <?php if($grade2 == '高専生') {echo 'selected';} ?>>
                  高専生
                  </option>
                  <option value="5" 
                  <?php if($grade2 == '予備校生・浪人生') {echo 'selected';} ?>>
                  予備校生・浪人生
                  </option>
                  <option value="6" 
                  <?php if($grade2 == '大学生') {echo 'selected';} ?>>
                  大学生
                  </option>
                  <option value="7" 
                  <?php if($grade2 == '短大生') {echo 'selected';} ?>>
                  短大生
                  </option>
                  <option value="8" 
                  <?php if($grade2 == '大学院生') {echo 'selected';} ?>>
                  大学院生
                  </option>
                  <option value="9" 
                  <?php if($grade2 == '専門学校生') {echo 'selected';} ?>>
                  専門学校生
                  </option>
                  <option value="10" 
                  <?php if($grade2 == '中学生') {echo 'selected';} ?>>
                  中学生
                  </option>
                  <option value="11" 
                  <?php if($grade2 == '外国人留学生') {echo 'selected';} ?>>
                  外国人留学生
                  </option>
                  <option value="12" 
                  <?php if($grade2 == '社会人') {echo 'selected';} ?>>
                  社会人
                  </option>
                  <option value="13" 
                  <?php if($grade2 == '教育関係') {echo 'selected';} ?>>
                  教育関係
                  </option>
                  <option value="14" 
                  <?php if($grade2 == '保護者') {echo 'selected';} ?>>
                  保護者
                  </option>
                  <option value="15" 
                  <?php if($grade2 == 'その他') {echo 'selected';} ?>>
                  その他
                  </option>
                </select>
              </dd>
            </dl>
            <dl class="school-name">
              <dt><span>高校名</span></dt>
              <dd><input type="text" name="school-name" value="<?php echo $school_name; ?>"></dd>
            </dl>
          </div>
          <div class="form-button">
            <button type="submit" class="green">入力内容の確認</button>
            <button type="button" class="blue" id="reset-button">クリア</button>
          </div>
        </form>
      </section>

<!--
#===========================================================
#  フォーム'確認画面'モード
#=========================================================== 
-->
    <?php elseif($mode == 'confirm'): ?>

      <section class="form-wrapper content-wrapper">
        <section class="step-nav">
          <ul>
            <li class="step">情報の入力</li>
            <li class="arrow"></li>
            <li class="step high-light">内容のご確認</li>
            <li class="arrow"></li>
            <li class="step">お申し込み完了</li>
          </ul>
        </section>

        <section class="form">
          <div class="check-request">
            <dl>
              <dt class="required">希望資料</dt>
              <dd>
                <?php echo  $documents_text; ?>
              </dd>
            </dl>
          </div>
          <div class="input-contents">
            <dl class="name">
              <dt class="required">お名前</dt>
              <dd>
                <div class="content">
                  <p>
                    <?php echo $name1; ?>
                  </p>
                </div>
                <div class="content">
                  <p>
                    <?php echo $name2; ?>
                  </p>
                </div>
              </dd>
            </dl>
            <dl class="kana">
              <dt class="required">フリガナ</dt>
              <dd>
                <div class="content">
                  <p>
                    <?php echo $kana1; ?>
                  </p>
                </div>
                <div class="content">
                  <p>
                      <?php echo $kana2; ?>
                  </p>
                </div>
              </dd>
            </dl>
            <dl class="address">
              <dt  class="required"><span>ご住所</span></dt>
              <dd>
                <div class="zip">
                  <label for="zip1">
                    <span>郵便番号：</span>
                  </label>
                    <?php echo $zip1; ?>-<?php echo $zip2; ?>
                </div>
                <div>
                  <div class="pref">
                    <label>
                      <span>都道府県：</span>
                      <?php echo $pref; ?>
                    </label>
                  </div>
                  <div class="addr1">
                    <label>
                      <span>市区町村番地：</span>
                      <?php echo $addr1; ?>
                    </label>
                  </div>
                  <div class="addr2">
                    <label>
                      <?php if($addr2): ?>
                      <span>マンション／アパート名：</span>
                      <?php echo $addr2; endif; ?>
                    </label>
                  </div>
                </div>
              </dd>
            </dl>
            <dl class="phone">
              <dt class="required">お電話番号</dt>
              <dd>
                <?php echo $phone; ?>
              </dd>
            </dl>
            <dl class="mail">
              <dt class="required">メールアドレス</dt>
              <dd>
                <div>
                  <p> 
                    <?php echo $mail1; ?>
                  </p>
                </div>
              </dd>
            </dl>
            <?php if($gender): ?>
              <dl class="gender">
                <dt>性別</dt>
                <dd>
                  <p>
                    <?php echo $gender; ?>
                  </p>
                </dd>
              </dl>
            <?php endif; ?>
              <dl class="grade">
                <dt class="required">学年</dt>
                <dd>
                  <?php echo $grade2; ?>
                </dd>
              </dl>
            <?php if($school_name): ?>
              <dl class="school-name">
                <dt><span>高校名</span></dt>
                <dd><?php echo $school_name; ?></dd>
              </dl>
            <?php endif; ?>
          </section> 

          <div class="form-button">
            <form action="<?php echo $index; ?>" method="POST">
              <input type="hidden" name="mode" value="submit">
              <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">

              <?php 
              foreach( $documents as $key => $value) {
                printf( '<input type="hidden" name="documents[%s]" value="%s">', $key, $value );
              }
              ?>
                
              <input type="hidden" name="name1" value="<?php echo $name1; ?>">
              <input type="hidden" name="name2" value="<?php echo $name2; ?>">
              <input type="hidden" name="kana1" value="<?php echo $kana1; ?>">
              <input type="hidden" name="kana2" value="<?php echo $kana2; ?>">
              <input type="hidden" name="zip1" value="<?php echo $zip1; ?>">
              <input type="hidden" name="zip2" value="<?php echo $zip2; ?>">
              <input type="hidden" name="pref" value="<?php echo $pref; ?>">
              <input type="hidden" name="addr1" value="<?php echo $addr1; ?>">
              <input type="hidden" name="addr2" value="<?php echo $addr2; ?>">
              <input type="hidden" name="phone" value="<?php echo $phone; ?>">
              <input type="hidden" name="mail1" value="<?php echo $mail1; ?>">
              <input type="hidden" name="mail2" value="<?php echo $mail2; ?>">
              <input type="hidden" name="gender" value="<?php echo $gender; ?>">
              <input type="hidden" name="grade1" value="<?php echo $grade1; ?>">
              <input type="hidden" name="school-name" value="<?php echo $school_name; ?>">



              <button type="submit" class="red">送信</button>
            </form>

            <form action="<?php echo $index; ?>" method="POST">
              <input type="hidden" name="mode" value="input">
              <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">

              <?php 
              foreach( $documents as $key => $value) {
                printf( '<input type="hidden" name="documents[%s]" value="%s">', $key, $value );
              }
              ?>
                
              <input type="hidden" name="name1" value="<?php echo $name1; ?>">
              <input type="hidden" name="name2" value="<?php echo $name2; ?>">
              <input type="hidden" name="kana1" value="<?php echo $kana1; ?>">
              <input type="hidden" name="kana2" value="<?php echo $kana2; ?>">
              <input type="hidden" name="zip1" value="<?php echo $zip1; ?>">
              <input type="hidden" name="zip2" value="<?php echo $zip2; ?>">
              <input type="hidden" name="pref" value="<?php echo $pref; ?>">
              <input type="hidden" name="addr1" value="<?php echo $addr1; ?>">
              <input type="hidden" name="addr2" value="<?php echo $addr2; ?>">
              <input type="hidden" name="phone" value="<?php echo $phone; ?>">
              <input type="hidden" name="mail1" value="<?php echo $mail1; ?>">
              <input type="hidden" name="mail2" value="<?php echo $mail2; ?>">
              <input type="hidden" name="gender" value="<?php echo $gender; ?>">
              <input type="hidden" name="grade1" value="<?php echo $grade1; ?>">
              <input type="hidden" name="school-name" value="<?php echo $school_name; ?>">

              <button type="submit" class="blue">戻る</button>
            </form>
          </div>

      </section>
    <?php endif; ?>
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

  <!-- 入力情報のリセット(クリア)ボタン -->
  <script src="../js/formReset.js"></script>
</body>
</html>