<?php
include "dbLogic/workWithDB.php";
session_start();
$login=""; $pass="";
if (isset($_POST['login'])) $login=$_POST['login'];
if (isset($_POST['pass'])) $pass=md5($_POST['pass']);

$user=chekLogin($login);

if ($user!= NULL && $user[0]['password'] == $pass) // user - массив из одного элемента
  {
    $_SESSION['user'] = $user[0]['id'];
    $_SESSION['date'] = date(DATE_RFC822);
    header("Location: ../secret.php");
    exit;
  }
else if($user==NULL)
{
  $mes='Логина нет в системе!';
  header("Location: ../errorPage.php?mes=$mes");
  exit;
}
else
{
  $mes=$pass;
  header("Location: ../errorPage.php?mes=$mes");
  exit;
}
?>
