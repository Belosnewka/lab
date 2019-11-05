<?php
require "autho.php";
include "dbLogic/workWithDB.php";
$id=0;
if (isset($_GET['id'])) $id=$_GET['id'];
$res=askCityWithIDFromBD($id);
if($res)
{
  $res2=askAllEventsFromBD();
  foreach ($res2 as $row)
  {
    if ($row['city']===$id)
    {
      $mes='Вы не можете удалить город с событием!';
      header("Location: ../errorPage.php?mes=$mes");
    }
  }
  $name=$res['city'].".jpg";
  $path="../images/$name";
  if (file_exists($path))
  {
    unlink($path);
  }
  deleteCity($id);
  header("Location: ../secret.php");
}
?>
