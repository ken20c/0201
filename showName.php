<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>セッションの使用例</title>
</head>

<body>
    <h3>セッション変数の表示</h3>

    <?php
    session_start(); // セッションを開始する

    if (isset($_SESSION['name'])) {
        // セッション変数 name に名前が登録されている場合
        echo "<p>" . $_SESSION['name'] . "さん、こんにちは。</p>";
    } else {
        // セッション変数 name に名前が登録されていない場合
        echo "<p>名前が登録されていません。</p>";
    }
    ?>

    <p>
        <!-- 別の PHP プログラムへのリンク -->
        <a href="setName.php">名前を設定する</a>
    </p>
    <p>
        <!-- 名前消去のリンク -->
        <a href="clearName.php">名前を消去する</a>
    </p>
</body>

</html>