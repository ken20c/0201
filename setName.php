<?php
// セッションを開始
session_start();

if (isset($_POST['name']) && $_POST['name'] != "") {
    // フォームに名前が入力されていたら，セッション変数に格納
    $_SESSION['name'] = $_POST['name'];

    // showName.php へ移動
    header("Location: showName.php");
}
?>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>セッションの使用例</title>
</head>

<body>
    <h3>セッション変数への値の設定</h3>

    <?php
    if (isset($_SESSION['name'])) {
        // セッション変数に名前が登録済みの時
        $name = $_SESSION['name'];
    } else {
        // セッション変数に名前が格納されていなかった場合
        $name = "";
        echo "<p>名前を入力してください。</p>";
    }
    ?>

    <form method='post' action='<?php echo $_SERVER['SCRIPT_NAME']; ?>'>
        名前：
        <input type="text" name="name" value="<?php echo $name; ?>">
        <input type="submit" value="送信">
    </form>

</body>

</html>