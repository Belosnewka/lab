<?php
session_start();
if (isset($_SESSION['user']))
{
   header("Location: secret.php");
   exit;
}

?>
<link href="https://getbootstrap.ru/docs/3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/my3.css">
<div class="jumbotron col-lg-6 col-sm-offset-3">
  <form method="POST" action="logic/authorize.php" class="form-inline">
     Username: <input type="text" name="user" />
     Password: <input type="password" name="pass" />
     <input class="btn btn-danger" type="submit" name="submit" value="Войти" />
  </form>
</div>
