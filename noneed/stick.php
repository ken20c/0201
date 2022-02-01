<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>棒グラフ（縦）</title>
</head>

<body>
    <?php
    // データ
    $values = "t:90,70,130";

    // 軸ラベルの設定
    $xLabel = "0:|あ|い|う";
    $yLabel = "1:|0|50|100|150";
    $label = rawurlencode($xLabel . "|" . $yLabel);
    // 日本語の文字列を，URLに指定できる形式にエンコード

    // グラフタイトル
    $title = rawurlencode("棒グラフ（縦）");

    // 棒の太さ，棒の間隔，グラフ領域内の棒の両外側の合計（単位：ピクセル）
    $bar = "32,48,70";

    // グラフ要素のデータをセット
    $parts = array(
        "cht" => "bvs",        // グラフのタイプ（棒b,縦v,スタックs）
        "chs" => "300x200",    // グラフサイズ
        "chd" => $values,      // 値
        "chds" => "0,150",     // Y軸スケール
        "chco" => "add8e6",    // 棒の色
        "chxt" => "x,y",       // 軸ラベル表示位置
        "chxl" => $label,      // 軸ラベル
        "chtt" => $title,      // グラフタイトル
        "chts" => "333333,18", // タイトル文字色，サイズ
        "chbh" => $bar,        // 棒の太さ，棒の間隔
    );

    // グラフのURLを生成する
    $graph = assembleURL($parts);

    // グラフを出力する
    echo "<img src='" . $graph . "' alt='棒グラフ' >";

    // グラフのURLを生成するユーザ定義関数
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
</body>

</html>