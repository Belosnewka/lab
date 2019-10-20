<?php
session_start();

function authorize ($log, $pas)
{
  $users = [
  ['login' => 'first', 'password' => md5('111'), 'id' => '1'],
  ['login' => 'second', 'password' => md5('222'), 'id' => '2'],
  ['login' => 'third', 'password' => md5('333'), 'id' => '3']
  ];
  $pass = md5($pas);
  foreach ($users as $user)
    {
      if ($user['login'] == $log AND $user['password'] == $pass)
        {
          $id = $user['id'];
          $_SESSION['user'] = $id;
          $_SESSION['date'] = date(DATE_RFC822);
          return $id;
        }
      else if($user['login'] == $log AND $user['password'] != $pass) return 0;
    }
  return -1;
}

$result=authorize($_POST['user'], $_POST['pass']);
if ($result==-1) $ans='Логина нет в системе!';
else if ($result==0) $ans= 'Неверный пароль!';
else header("Location: ../secret.php");
?>

<link href="https://getbootstrap.ru/docs/3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="my3.css">
<div class="jumbotron col-lg-4 col-sm-offset-4 error">
  <h1><?=$ans?></h1>
</div>
