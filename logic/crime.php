<?php
require "autho.php";
include "dbLogic/workWithDB.php";
include "checkPermission.php";
checkPermission(2);
$crime=""; $witness=''; $event=''; $id='';
if (isset($_GET['add']))
{
  if (isset($_POST['witness'])) $witness=$_POST['witness'];
  if (isset($_POST['name'])) $crime=$_POST['name'];
  if (isset($_POST['event'])) $event=$_POST['event'];

  $allowed = array("event", "crime", "witness");
  $values = array($event, $crime, $witness);

  writeNewCrime($allowed, $values);

  header("Location: ../secret.php");
}
if (isset($_GET['change']))
{
  if (isset($_POST['witness'])) $witness=$_POST['witness'];
  if (isset($_POST['name'])) $crime=$_POST['name'];
  if (isset($_POST['event'])) $event=$_POST['event'];
  if (isset($_GET['id'])) $id=$_GET['id'];

  $allowed = array("event", "crime", "witness");
  $values = array($event, $crime, $witness);

  updateCrime($allowed, $values, $id);

  header("Location: ../secret.php");
}
if (isset($_GET['del']))
{
  if (isset($_GET['id'])) $id=$_GET['id'];
  deleteCrime($id);

  header("Location: ../secret.php");
}
?>
