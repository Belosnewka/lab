<?php
include "dbLogic/workWithDB.php";
session_start();
$name=""; $date=""; $city=""; $master=""; $participants="";
if (isset($_POST['name'])) $name=$_POST['name'];
if (isset($_POST['date'])) $date=$_POST['date'];
if (isset($_POST['city'])) $city=$_POST['city'];
if (isset($_POST['participants'])) $participants=$_POST['participants'];
if(isset($_SESSION['user'])) $master=$_SESSION['user'];
$allowed = array("name","date","city", "master", "participants");
$values = array($name, $date, $city, $master, $participants);
writeNewEvent($allowed, $values);
header("Location: ../secret.php");
?>
