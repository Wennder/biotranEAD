<?php

$targ_w = 100;
$targ_h = 120;
$jpeg_quality = 90;

$src = $foto_nome;
$img_r = imagecreatefromjpeg($src);
$dst_r = ImageCreateTrueColor($targ_w, $targ_h);

imagecopyresampled($dst_r, $img_r, 0, 0, $_POST['x1'], $_POST['y1'], $targ_w, $targ_h, $_POST['w'], $_POST['h']);

header('Content-type: image/jpeg');
imagejpeg($dst_r, null, $jpeg_quality);

?>
