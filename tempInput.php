<?php
// データベースに接続する
$dbh = new PDO("sqlite:temp.db");

// 気温を記憶するテーブルがなければ作成する
$sql = "CREATE TABLE IF NOT EXISTS temp (
          month INTEGER,
          temp FLOAT
        )";
$stmt = $dbh->prepare($sql);
$stmt->execute();

// 1月から12月までの気温データを取り出す
for ($mon = 1; $mon <= 12; $mon++) {
    $sql = "SELECT temp FROM temp WHERE month = :month";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(":month", $mon);
    $stmt->execute();

    // $mon 月の気温データを取得
    $temp[$mon] = $stmt->fetchColumn();
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Data input form</title>
</head>

<body>
    <h3>月別平均気温の入力</h3>

    <form method="post" action="tempUpdate.php">
        <table border="1">
            <tr>
                <th>1月</th>
                <th>2月</th>
                <th>3月</th>
                <th>4月</th>
                <th>5月</th>
                <th>6月</th>
                <th>7月</th>
                <th>8月</th>
                <th>9月</th>
                <th>10月</th>
                <th>11月</th>
                <th>12月</th>
            </tr>
            <tr>
                <?php
                for ($mon = 1; $mon <= 12; $mon++) {
                    echo "<td>";
                    echo "<input type='text' name='{$mon}' value='{$temp[$mon]}' size='3'>";
                    echo "</td>\n";
                }
                ?>
            </tr>
        </table>
        <br>
        <input type="submit" value="送信">
    </form>
</body>

</html>