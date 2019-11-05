<?php
session_start();
if (isset($_GET['do']))
{
	if($_GET['do'] == 'logout')
	{
		unset($_SESSION['user']);
	  unset($_SESSION['date']);
		session_destroy();
	}
	header("Location: index.php");
	exit;
}

if(!$_SESSION['user']){
	header("Location: authorizePage.php");
	exit;
}
?>
