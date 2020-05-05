<?php
require "autho.php";
include "dbLogic/workWithDB.php";
include "checkPermission.php";
$login=""; $pass=""; $fio=''; $city='';
if (isset($_GET['add']))
{
  if (isset($_POST['passport'])) $pass=$_POST['passport'];
  if (isset($_POST['name'])) $fio=$_POST['name'];
  if (isset($_POST['city'])) $city=$_POST['city'];
  $login = $_SESSION['user'];
  $_SESSION['rights'] = 3;

  $allowed = array("login", "passport", "fio", "city", "rights", "pay");
  $values = array($login, $pass, $fio, $city, 3, 1500);

  writeNewCheckedUser($allowed, $values);

  header("Location: ../secret.php");
}
if (isset($_GET['acept']))
{
  checkPermission(0);
  if (isset($_GET['id'])) $id=$_GET['id'];
  $allowed = array("rights");
  $values = array(2);

  addCheckedUser($allowed, $values, $id);

  header("Location: ../secret.php");
}
if (isset($_GET['del']))
{
  checkPermission(0);
  if (isset($_GET['id'])) $id=$_GET['id'];

  $res=delCheckedUser($id);
  if(isset($res['error']))
  {
    $mes=$res['error'];
    header("Location: ../errorPage.php?mes=$mes");
    exit;
  }

  header("Location: ../secret.php");
}
?>
