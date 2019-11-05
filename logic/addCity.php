<?php
require "autho.php";
include "dbLogic/workWithDB.php";
include "resizeImg.php";
$city=""; $volume=""; $participants="";
if (isset($_POST['volume'])) $volume=$_POST['volume'];
if (isset($_POST['city'])) $city=$_POST['city'];
if (isset($_POST['participants'])) $participants=$_POST['participants'];
$res=askAllCitiesFromBD();
foreach ($res as $row)
{
  if($row['city']===$city)
  {
    $mes='Такой город уже есть!';
    header("Location: ../errorPage.php?mes=$mes");
    exit;
  }
}
if(file_exists($_FILES["file"]['tmp_name']))
{
  $foto=$_FILES["file"];
  if($foto["error"])
  {
    $mes='Ошибка загрузки файла';
    header("Location: ../errorPage.php?mes=$mes");
  }
  if (exif_imagetype($foto['tmp_name']) != IMAGETYPE_JPEG)
  {
    $mes='Не jpeg изображение';
    header("Location: ../errorPage.php?mes=$mes");
    exit;
  }
  $name=$city.".jpg";
  move_uploaded_file($foto["tmp_name"], "../images/$name");
  resizeImage("../images/$name", 150, -1);
}
  $allowed = array("city", "production", "people");
  $values = array($city, $volume, $participants);
  writeNewCity($allowed, $values);
  header("Location: ../secret.php");
?>
