<?php

include('../library/wideimage/lib/WideImage.inc.php');

if (isset($_FILES["foto"])) {
    $foto = $_FILES["foto"];
    $tipos = array('image/jpg');
    $pasta_dir = "img/profile/";
    if (!in_array($foto['type'], $tipos)) {
        $foto_nome = $pasta_dir . "teste1" . ".jpg"; // teste1 será a id_usuario
        move_uploaded_file($foto["tmp_name"], $foto_nome);
        $foto_arquivo = "img/profile/teste1.jpg";// img/profile/usuario->getId_usuario().jpg;
        $foto_arquivo_pic = "img/profile/pic/teste1.jpg";// img/profile/pic/usuario->getId_usuario().jpg;
        list($altura, $largura) = getimagesize($foto_arquivo);
        if ($altura > 120 && $largura > 100) {
            $img = wiImage::load($foto_arquivo);
            $img = $img->resize(150, 170, 'outside');
            $img = $img->crop('50% - 50', '50% - 40', 100, 120);
            $img->saveToFile($foto_arquivo);
        }
        copy($foto_arquivo, $foto_arquivo_pic);
        $img = wiImage::load($foto_arquivo_pic);
        $img = $img->resize(35, 42, 'outside');
        $img->saveToFile($foto_arquivo_pic);
    }
}
?>
