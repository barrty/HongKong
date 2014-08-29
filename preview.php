<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL | E_NOTICE | E_STRICT);

function square_preview($file2, $count_res, $size1, $size2) {
    $filename = "./!hk/hk".$count_res."._jpg";
    //header("Content-Type: image/jpg");
    $source = imagecreatefromjpeg($file2);               // Открываем оригинальное изображение
    list($width, $height) = getimagesize($file2);         // Получаем размеры оригинального изображения
    $thumbs = imagecreatetruecolor($size1, $size2);         // Превью
    imagecopyresampled($thumbs, $source, 0, 0, 0, 0, $size1, $size2, $width, $height);
    imagejpeg($thumbs, $filename, 30);   // Пишем изображение в файл
    //imagejpeg($thumbs, null, 30);     // Выводим изображение
}


