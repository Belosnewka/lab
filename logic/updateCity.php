<?php
require "autho.php";
include "dbLogic/workWithDB.php";
include "resizeImg.php";
$city=""; $volume=""; $participants="";$id=0;$del=false;
if (isset($_POST['volume'])) $volume=$_POST['volume'];
if (isset($_POST['city'])) $city=$_POST['city'];
if (isset($_POST['participants'])) $participants=$_POST['participants'];
if (isset($_POST['del'])) $del=$_POST['del'];
if (isset($_GET['id'])) $id=$_GET['id'];
$res=askAllCitiesFromBD();
$res2=askCityWithIDFromBD($id);
foreach ($res as $row)
{
  if($row['city']===$city && $row['idCity']!=$id) // проверяем нет ли в базе города, на имя которого хотим поменять имя текущего
  {
    $mes='Такой город уже есть!';
    header("Location: ../errorPage.php?mes=$mes");
  }
}
if ($del)
{
  $name=$res2['city'].".jpg";
  $path="../images/$name";
  if (file_exists($path))
  {
    unlink($path);
  }
}
else
{
  $name=$res2['city'].".jpg";
  $path="../images/$name";
  if (file_exists($path))
  {
    $name=$city.".jpg";
    copy($path, "../images/$name");
    unlink($path);
  }
}
if(isset($_FILES["file"]))
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
  esizeImage("../images/$name", 150, -1);
}
$allowed = array("city", "production", "people");
$values = array($city, $volume, $participants);
updateCity($allowed, $values, $id);
header("Location: ../secret.php");
?>
