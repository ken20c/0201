<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>月別平均気温のグラフ表示</title>
</head>

<body>
    <?php
    // tempテーブルの有無を調べる
    $dbh = new PDO("sqlite:temp.db");
    $sql = "SELECT COUNT(*) FROM sqlite_master WHERE name='temp'";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    if ($stmt->fetchColumn() < 1) {
        // テーブル temp がなかったら終了
        echo "<p>気温データがありません<p>\n";
        $dbh = null;
    } else {
        // データベースから月別平均気温を取得する
        $dbh = new PDO("sqlite:temp.db");
        for ($mon = 1; $mon <= 12; $mon++) {
            $sql = "SELECT temp FROM temp WHERE month = :month";
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(":month", $mon);
            $stmt->execute();
            $temp[$mon] = $stmt->fetchColumn();
        }
        $dbh = null;

        // グラフ生成用にデータ列を作る
        $values = "t:";
        for ($mon = 1; $mon <= 12; $mon++) {
            $values .= $temp[$mon];
            if ($mon != 12) {
                $values .= ",";
            }
        }

        // 軸ラベルの設定
        $xLabel = "0:|1月|2月|3月|4月|5月|6月|7月|8月|9月|10月|11月|12月";
        $yLabel = "1:|-30|-20|-10|0|10|20|30";
        $label = rawurlencode($xLabel . "|" . $yLabel);

        // グラフタイトル
        $title = rawurlencode("月別平均気温");

        // 棒の太さ，棒の間隔，グラフ領域内の棒の両外側の合計（単位：ピクセル）
        $bar = "20,20,40";

        // 背景: bg(背景),s(塗りつぶし),色(rrggbb)|c(グラフ領域),s(塗りつぶし),色(rrggbb)
        $background = "bg,s,dbdbdb|c,s,ffffff";

        // グラフ要素のデータをセット
        $parts = array(
            "cht" => "bvs",        // グラフのタイプ（棒,縦,スタック）
            "chs" => "540x300",    // グラフ画像のサイズ
            "chd" => $values,      // 値
            "chds" => "-30,30",      // Y軸スケール
            "chco" => "add8e6",    // 棒の色(rrggbb)
            "chxt" => "x,y",       // 軸ラベル表示位置
            "chxl" => $label,      // 軸ラベル
            "chtt" => $title,      // グラフタイトル
            "chts" => "333333,18", // タイトル文字色(rrggbb)，サイズ
            "chbh" => $bar,        // 棒の太さ，棒の間隔
            "chf"  => $background, // 背景
        );

        // グラフのURLを生成する
        $graph = assembleURL($parts);

        // グラフを出力する
        echo "<img src='" . $graph . "' alt='棒グラフ' >";


        // グラフ要素のデータをセット
        $parts = array(
            "cht" => "lc",        // グラフのタイプ（棒,縦,スタック）
            "chs" => "540x300",    // グラフ画像のサイズ
            "chd" => $values,      // 値
            "chds" => "-30,30",      // Y軸スケール
            "chco" => "add8e6",    // 棒の色(rrggbb)
            "chxt" => "x,y",       // 軸ラベル表示位置
            "chxl" => $label,      // 軸ラベル
            "chtt" => $title,      // グラフタイトル
            "chts" => "333333,18", // タイトル文字色(rrggbb)，サイズ
            "chbh" => $bar,        // 棒の太さ，棒の間隔
            "chf"  => $background, // 背景
        );

        // グラフのURLを生成する
        $graph = assembleURL($parts);

        // グラフを出力する
        echo "<img src='" . $graph . "' alt='棒グラフ' >";
    }

    // グラフのURLを生成するユーザ関数
    function assembleURL($parts)
    {
        $url = "https://chart.googleapis.com/chart?";
        $query = "";
        foreach ($parts as $key => $val) {
            if ($query != "") {
                $query .= "&amp;";
            }
            $query .= "$key=$val";
        }
        $url .= $query;
        return $url;
    }
    ?>

    <p>
        <a href="tempMenu.html">メニューに戻る</a>
    </p>
</body>

</html>