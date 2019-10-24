<?php
require "logic/autho.php";
include "logic/dbLogic/workWithDB.php";

$res=askAllEventsFromBD();
$res1=askIpFromBD();
$res2=askViewsFromBD();
?>
<link href="https://getbootstrap.ru/docs/3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/my3.css">
<div class="jumbotron col-lg-4 col-sm-offset-4">
 <h1> Здравствуй, товарищ! </h1>
  <table class="table table-bordered table-hover table-sm tablesp">
    <tr>
      <th>Название</th>
      <th>Дата</th>
      <th>Город</th>
      <th>Ответственный</th>
      <th>Кол-во участников</th>
    </tr>
      <?php
      foreach ($res as $row)
      {
      ?>
          <tr>
            <td><?php echo $row['name'] ?></td>
            <td><?php echo $row['date'] ?></td>
            <td> <?php echo $row['city'] ?>  </td>
            <td> <?php echo $row['master'] ?>  </td>
            <td> <?php echo $row['participants'] ?>  </td>
          </tr>
    <?php } ?>
  </table>
  <p><a class="btn btn-lg btn-danger" href="addEvent.php" role="button">Добавить событие</a></p>
  <h2>Просмотры</h2>
  <table class="table table-bordered table-hover table-sm tablesp">
    <tr>
      <th>Страница</th>
      <th>Просмотры</th>
      <th>Внутренние переходы</th>
      <th>Вк</th>
      <th>Браузер</th>
    </tr>
      <?php
      foreach ($res2 as $row)
      {
      ?>
          <tr>
            <td><?php echo $row['page'] ?></td>
            <td><?php echo $row['countOfViews'] ?></td>
            <td> <?php echo $row['inside'] ?> </td>
            <td> <?php echo $row['vk'] ?> </td>
            <td> <?php echo $row['browser'] ?> </td>
          </tr>
    <?php } ?>
  </table>
  <h2>Уникальные посетители</h2>
  <table class="table table-bordered table-hover table-sm tablesp">
    <tr>
      <th>ip</th>
    </tr>
      <?php
      foreach ($res1 as $row)
      {
      ?>
          <tr>
            <td><?php echo $row['ip'] ?></td>
          </tr>
    <?php } ?>
  </table>
    <h2><?=$_SESSION['date']?></h2>
    <p><a class="btn btn-lg btn-danger" href="secret.php?do=logout" role="button">Выйти</a></p>
    <p><a class="btn btn-lg btn-danger" href="index.php">Вернуться на глвную</a></p>
</div>
