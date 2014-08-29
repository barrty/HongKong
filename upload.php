<!DOCTYPE html>
<html>
    <head>
        <link rel="SHORTCUT ICON" href="img/favicon.ico" type="image/x-icon">
        <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Gallery</title>
        <script src="js/jquery-2.1.1.min.js"></script>
        <link href="css/style.css" rel="stylesheet" />
        <style type="text/css"></style>
        <script type="text/javascript"></script>
    </head>
    <body>
        <div class="header">
            <?php
            ini_set('display_errors', 'On');
            error_reporting(E_ALL | E_NOTICE | E_STRICT);

            $dir = opendir('!hk');
            $count = 1;                 // Равен 1 для того, чтобы при записи файла к имени не прибавлять единицу
            while ($file = readdir($dir)) {
                if ($file == '.' || $file == '..' || is_dir('!hk' . $file)) {
                    continue;
                }
                if (strpos($file, '.jpg', 1)) {
                    $count++;
                    if (strlen($count) == 1) {
                        $count_res = '000000' . $count;
                    }
                    if (strlen($count) == 2) {
                        $count_res = '00000' . $count;
                    }
                    if (strlen($count) == 3) {
                        $count_res = '0000' . $count;
                    }
                    if (strlen($count) == 4) {
                        $count_res = '000' . $count;
                    }
                    if (strlen($count) == 5) {
                        $count_res = '00' . $count;
                    }
                    if (strlen($count) == 6) {
                        $count_res = '0' . $count;
                    }
                    if (strlen($count) == 7) {
                        $count_res = $count;
                    }
                }
            }

            if (isset($_POST['submit_btn'])) {
                $target_dir = './!hk/';                 // целевая директория
                if ($_FILES['myfile']['size'] > '1048576') {
                    echo 'Файл слишком большого размера. Максимальный размер = 1 мб.<br>';
                    echo '<a href="/hk/">Посмотреть все картинки</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="upload.php">Загрузить ещё один файл</a>';
                    die();
                }
                if ($_FILES['myfile']['type'] !== 'image/jpeg') {
                    echo 'Не верный формат файла. Ожидался файл jpeg.<br>';
                    echo '<a href="/hk/">Посмотреть все картинки</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="upload.php">Загрузить ещё один файл</a>';
                    die();
                }
                if (move_uploaded_file($_FILES['myfile']['tmp_name'], $target_dir . 'hk' . $count_res . '.jpg')) {
                    echo 'Файл был загружен, порядковый номер - <b>' . $count . '<b><br>';
                    echo '<a href="/hk/">Посмотреть все картинки</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="upload.php">Загрузить ещё один файл</a>';
                } else {
                    echo 'Ошибка при загрузке файла.<br>';
                    echo '<a href="/hk/">Посмотреть все картинки</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="upload.php">Загрузить ещё один файл</a>';
                }
            } else {
                ?>
                <form action="" method="POST" enctype="multipart/form-data">
                    <input type="submit" name="submit_btn" value="Загрузить"/> <input type="file" name="myfile" accept="image/jpeg"/>
                </form> 
                <a href="/hk/">Перейти в галерею</a>
                <?php
            }
            ?>
        </div>
        <div class="footer">
        </div>
    </body>
</html>
