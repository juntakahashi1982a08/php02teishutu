<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width">
  <title>ブックマーク登録</title>
  <link href="css/sample.css" rel="stylesheet">
  <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="js/jquery-2.1.3.min.js"></script>
  <style>
    div {
      padding: 10px;
      font-size: 16px;
    }
  </style>

</head>

<body>

  <!-- Head[Start] -->
  <header>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header"><a class="navbar-brand" href="select.php">ブックマーク登録</a></div>
      </div>
    </nav>
  </header>
  <!-- Head[End] -->

  <!-- Main[Start] -->

  <form method="post" action="insert.php">
    <div class="jumbotron">
      <fieldset>
        <legend>ブックマーク登録</legend>
        <label>書籍名　：<input type="text" name="title">

        </label><br>
        <label>著者名　：<input type="text" name="author">

        </label><br>
        <label>ＵＲＬ　：<input type="text" name="link">

        </label><br>
        <label>コメント：<textArea name="comment" rows="4" cols="40"></textArea></label><br><br>
        <!-- textarea -->
        <input type="submit" value="登録">
      </fieldset>
    </div>
  </form><br>
  <a href="select.php">ブックマーク表示</a>

  <p>
    <input type="text" id="keyword">
    <button id="readbook">検索</button>
  </p>

  <ul>
    <li>題名</li>
    <li>著者</li>
    <li>リンク</li>
  </ul>
  <p id="content"></p>

  <script>
    // 手順
    // 1. axios を使って 情報を取得する
    // 2. JSONデータ構造を基に本のタイトルを取得する
    // 3. 本のタイトル情報をHTMLに出力する
    // 4. クリックイベントで括る
    // 5. id="keyword"の入力値を取得 → URLの"?q=jquery"の"queryの文字を取得した入力値（変数）に変える"

    // axios を使う[開始]
    $("#readbook").on('click', function() {

      const url = "https://www.googleapis.com/books/v1/volumes?q=" + $("#keyword").val();
      axios.get(url).then(function(res) {
        console.log(res.data);
        const items = res.data.items
        // 配列の中身を一つずつ取り出してみて表示する
        items.forEach(function(item) {
          $("#content").append("<ul width='100px'><li>" +
            item.volumeInfo.title + "</li><li>" +
            item.volumeInfo.authors + "</li><li><a href=" +
            item.volumeInfo.canonicalVolumeLink + '>' + item.volumeInfo.canonicalVolumeLink + '</a></li></ul>');
        })
      })
    })

    // 10個を数個に
    // axios を使う[終了]
  </script>

  <!-- Main[End] -->


</body>

</html>