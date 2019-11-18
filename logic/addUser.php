<?php
include "dbLogic/workWithDB.php";
session_start();
$login=""; $pass="";
if (isset($_POST['login'])) $login=$_POST['login'];
if (isset($_POST['pass'])) $pass=md5($_POST['pass']);

$allowed = array("login", "password");
$values = array($login, $pass);

$_SESSION['user'] = writeNewUser($allowed, $values);
$_SESSION['date'] = date(DATE_RFC822);

header("Location: ../secret.php");//As12345*
?>
