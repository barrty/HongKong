<!DOCTYPE html>
<html>
    <head>
        <link rel="SHORTCUT ICON" href="img/favicon.ico" type="image/x-icon">
        <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Gallery</title>
        <script src="js/jquery-2.1.1.min.js"></script>
        <script src="js/lightbox.min.js"></script>
        <link href="css/lightbox.css" rel="stylesheet" />
        <link href="css/style.css" rel="stylesheet" />
        <style type="text/css"></style>
        <script type="text/javascript"></script>
    </head>
    <body>
        <?php
        $dir = opendir('!hk');
        $count = 0;
        while ($file = readdir($dir)) {
            if ($file == '.' || $file == '..' || is_dir('!hk' . $file)) {
                continue;
            }
            if (strpos($file, '.jpg', 1)) {
                $count++;
            }
        }
        ?>
        <div class="header">
            <?php
            if ($_GET['list'] > 1) {
                $list = $_GET['list'] - 30;
                if ($list < 0) {
                    $list = 0;
                }
                echo '<a class="listing" href="?list=' . $list . '">Предыдущие 30 снимков</a>&nbsp;&nbsp;';
            } else {
                echo '<a class="listing_disabled">Предыдущие 30 снимков</a>&nbsp;&nbsp;';
            }
            if ($_GET['list'] > 0) {
                echo '<a class="listing" href="/hk/">В начало</a>&nbsp;&nbsp;';
            } else {
                echo '<a class="listing_disabled">В начало</a>&nbsp;&nbsp;';
            }
            if ($list < $count) {
                $list = $_GET['list'] + 30;
            }
            $count_check = $count - $list + 30;
            if ($count_check >= 30) {
                echo '<a class="listing" href="?list=' . $list . '"> Следующие 30 снимков</a>';
            } else {
                echo '<a class="listing_disabled"> Следующие 30 снимков</a>';
            }
            ?>
            <a class='upload' href="upload.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
        </div>
        <div class="main">
            <?php
            ini_set('display_errors', 'On');
            error_reporting(E_ALL | E_NOTICE | E_STRICT);

            include "preview.php";

            $count_calc = 0;

            for ($count_reverse = $count; $count_reverse > 0; $count_reverse--) {
                $count_calc++;
                if (strlen($count_reverse) == 1) {
                    $count_res = '000000' . $count_reverse;
                }
                if (strlen($count_reverse) == 2) {
                    $count_res = '00000' . $count_reverse;
                }
                if (strlen($count_reverse) == 3) {
                    $count_res = '0000' . $count_reverse;
                }
                if (strlen($count_reverse) == 4) {
                    $count_res = '000' . $count_reverse;
                }
                if (strlen($count_reverse) == 5) {
                    $count_res = '00' . $count_reverse;
                }
                if (strlen($count_reverse) == 6) {
                    $count_res = '0' . $count_reverse;
                }
                if (strlen($count_reverse) == 7) {
                    $count_res = $count_reverse;
                } else {
                    if (!file_exists("!hk/hk" . $count_res . "._jpg") && file_exists("!hk/hk" . $count_res . ".jpg")) {
                        $file2 = '!hk/hk' . $count_res . '.jpg';
                        square_preview($file2, $count_res, '300', '169');
                    }
                    if (!isset($_GET['list'])) {
                        if ($count_calc > 0 && $count_calc < 31) {
                            echo '<a href="!hk/hk' . $count_res . '.jpg" title="' . $time_file = date('F d Y H:i', filemtime('./!hk/hk' . $count_res . '.jpg')) . '" data-lightbox="roadtrip"><img class = "preview" width="300px" src="!hk/hk' . $count_res . '._jpg"></a>';
                        }
                    }
                    if (isset($_GET['list'])) {
                        $from = $_GET['list'];
                        $upto = $from + 31;
                        if ($count_calc > $from && $count_calc < $upto) {
                            echo '<a href="!hk/hk' . $count_res . '.jpg" title="' . $time_file = date('F d Y H:i', filemtime('./!hk/hk' . $count_res . '.jpg')) . '" data-lightbox="roadtrip"><img class = "preview" width="300px" src="!hk/hk' . $count_res . '._jpg"></a>';
                        }
                    }
                }
            }
            ?>
            <br>
        </div>
        <div class='footer'>
            <?php
            $total = $count - $list;
            echo '<br><br>Всего снимков в базе: ' . $count.'<br><br>';
            ?>
        </div>
    </body>
</html>
