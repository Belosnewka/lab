<?php
require "logic/autho.php";
include "logic/dbLogic/workWithDB.php";

$res=askAllEventsFromBD();
$res1=askIpFromBD();
$res2=askViewsFromBD();
$res3=askAllCitiesFromBD();
?>
<link href="https://getbootstrap.ru/docs/3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/my3.css">
<div class="jumbotron col-lg-6 col-sm-offset-3">
 <h1> Здравствуй, товарищ! </h1>
  <table class="table table-bordered table-hover table-sm tablesp">
    <tr>
      <th>Название</th>
      <th>Дата</th>
      <th>Город</th>
      <th>Ответственный</th>
      <th>Кол-во участников</th>
      <th>Действие</th>
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
            <td><p><a class="btn btn-info" href="logic/deleteEvent.php?id=<?php echo $row['id']?>" role="button">Удалить</a></p>
              <a class="btn btn-success" href="updateEventForm.php?id=<?php echo $row['id']?>" role="button">Изменить</a></td>
          </tr>
    <?php } ?>
  </table>
  <p><a class="btn btn-lg btn-danger" href="addEvent.php" role="button">Добавить событие</a></p>
  <h2>Города</h2>
  <table class="table table-bordered table-hover table-sm tablesp">
    <tr>
      <th>Название</th>
      <th>Жители</th>
      <th>Объем производства</th>
      <th>Фото</th>
      <th>Действие</th>
    </tr>
      <?php
      foreach ($res3 as $row)
      {
      ?>
          <tr>
            <td><?php echo $row['city'] ?></td>
            <td><?php echo $row['people'] ?></td>
            <td> <?php echo $row['production'] ?> </td>
            <td> <img src="images/<?php echo $row['city'] ?>.jpg"> </td>
            <td><p><a class="btn btn-info" href="logic/deleteCity.php?id=<?php echo $row['idCity']?>" role="button">Удалить</a></p>
              <a class="btn btn-success" href="updateCityForm.php?id=<?php echo $row['idCity']?>" role="button">Изменить</a></td>
          </tr>
    <?php } ?>
  </table>
  <p><a class="btn btn-lg btn-danger" href="addCityForm.php" role="button">Добавить город</a></p>
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
    <p><a class="btn btn-lg btn-danger" href="Location: ../index.php">Вернуться на глвную</a></p>
</div>
