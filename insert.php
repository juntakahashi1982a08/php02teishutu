<?php
//1. POSTデータ取得
var_dump($_POST);
$title = $_POST['title'];
$author = $_POST['author'];
$link = $_POST['link'];
$comment = $_POST['comment'];


//2. DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  // $pdo = new PDO('mysql:dbname=gs_bm;charset=utf8;host=localhost','root','');
  $pdo = new PDO('*;*;*','*','*');
} catch (PDOException $e) {
  exit('DBConnection Error:'.$e->getMessage());
}

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_bm_table ( title, author, link, comment, indate ) VALUES( :title, :author, :link, :comment, sysdate())");
$stmt->bindValue(':title', $title, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':author', $author, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':link', $link, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("SQL_ERROR:".$error[2]);
}else{
  //５．index.phpへリダイレクト
  header("Location: index.php");
  exit();
}
?>