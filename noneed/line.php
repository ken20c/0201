<!DOCYPTE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <title>折れ線グラフ</title>
    </head>

    <body>
        <?php
        // データ
        $val1 = "3.9,4.5,10.2,13.7,19.4,23.9,28.0,29.3,24.9,20.2,11.3,6.3";
        $val2 = "65,61,53,56,57,70,68,64,68,68,68,68";
        $values = "t:" . $val1 . "|" . $val2;

        // 軸ラベルの設定
        $x = "0:|1月|2月|3月|4月|5月|6月|7月|8月|9月|10月|11月|12月";
        $y1 = "1:|0|5|10|15|20|25|30";
        $y2 = "2:|52|54|56|58|60|62|64|66|68|70";
        $y1Text = "3:||気温|";
        $y2Text = "4:||湿度|";

        $label = $x . "|" . $y1 . "|" . $y2 . "|" . $y1Text . "|" . $y2Text;
        $label = rawurlencode($label);

        // Y軸スケール
        // 0,30(Y1軸:左側), 52,70(Y2軸:右側)
        $scale = "0,30,52,70";

        // グラフタイトル
        $title = rawurlencode("岐阜市の平均気温と平均湿度（2013年）");

        // 凡例
        $legend = rawurlencode("平均気温（℃）|平均湿度（％）");

        // グラフ要素のデータをセット
        $parts = array(
            "cht" => "lc",             // グラフタイプ： 折れ線(line chart)
            "chs" => "700x400",        // グラフサイズ
            "chd" => $values,          // 値
            "chds" => $scale,          // Y軸スケール
            "chxl" => $label,          // 軸ラベル
            "chxt" => "x,y,r,y,r",      // 軸ラベル表示位置
            "chco" => "0000ff,ff0000", // 線の色
            "chtt" => $title,          // グラフタイトル
            "chts" => "333333,18",     // タイトル文字色，サイズ
            "chdl" => $legend,         // 凡例
            "chdlp" => "r",            // 凡例位置
        );

        // グラフのURLを生成する
        $graph = assembleURL($parts);

        // グラフを出力する
        echo "<img src='" . $graph . "' alt='折れ線グラフ' >";

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
    </body>

    </html>