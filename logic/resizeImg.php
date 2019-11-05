<?php
function resizeImage($filename, $width, $height) // частично взято из примеров документации, доделано для себя
{
  header('Content-Type: image/jpeg');

  list($width_orig, $height_orig) = getimagesize($filename);

  $ratio_orig = $width_orig/$height_orig;

  if ($width/$height > $ratio_orig) {
     $width = $height*$ratio_orig;
  } else {
     $height = $width/$ratio_orig;
  }

  $image_p = imagecreatetruecolor($width, $height);
  $image = imagecreatefromjpeg($filename);
  imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
  imagejpeg($image_p, $filename);
  imagedestroy($image);
  imagedestroy($image_p);
}
?>
