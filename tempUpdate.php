<?php
// フォームデータを取得する
for ($mon = 1; $mon <= 12; $mon++) {
    if (isset($_POST[$mon])) {
        $temp[$mon] = $_POST[$mon];
    }
}

if (isset($temp[12])) {
    // フォームから入手したデータでデータベースを更新する

    // データベースに接続する
    $dbh = new PDO("sqlite:temp.db");

    // 現在のデータを削除する
    $sql = "DELETE FROM temp";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    // テーブルにデータを挿入する
    for ($mon = 1; $mon <= 12; $mon++) {
        $sql = "INSERT INTO temp (month, temp) VALUES(:month, :temp)";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(":month", $mon);
        $stmt->bindValue(":temp", $temp[$mon]);
        $stmt->execute();
    }

    $dbh = null;
}

// メニューに戻る
header("Location: tempMenu.html");
