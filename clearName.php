<?php
echo "消去中....";
// セッションを開始
session_start();
// セッション破棄
$_SESSION = array();
// セッション終了
session_destroy();
// showName.php へ移動
header("Location: showName.php");
