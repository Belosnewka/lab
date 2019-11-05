<?php
require "autho.php";
include "dbLogic/workWithDB.php";
$name=""; $date=""; $city=""; $master=""; $participants="";$id=0;
if (isset($_POST['name'])) $name=$_POST['name'];
if (isset($_POST['date'])) $date=$_POST['date'];
if (isset($_POST['city'])) $city=$_POST['city'];
if (isset($_POST['participants'])) $participants=$_POST['participants'];
if(isset($_SESSION['user'])) $master=$_SESSION['user'];
if (isset($_GET['id'])) $id=$_GET['id'];
$res2=askEventWithIDFromBD($id);
if($res2['master']!=$master)
{
  $mes='Вы не можете изменить событие другого товарища!';
  header("Location: ../errorPage.php?mes=$mes");
}
$res=askAllCitiesFromBD();
$checkCity=0;
foreach ($res as $row)
{
  if($row['city']===$city)
  {
    $checkCity=$row['idCity'];
    break;
  }
}
if($checkCity>0)
{
  $allowed = array("name","date","city", "master", "participants");
  $values = array($name, $date, $checkCity, $master, $participants);
  updateEvent($allowed, $values, $id);
  header("Location: ../secret.php");
}
else
{
  $mes='Нет такого города!';
  header("Location: ../errorPage.php?mes=$mes");
}
?>
