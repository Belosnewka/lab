<?php
require "logic/autho.php";
include "logic/dbLogic/workWithDB.php";

$res=askAllEventsFromBD();
$res1=askIpFromBD();
$res2=askViewsFromBD();
$res3=askAllCitiesFromBD();
?>
<head>
<link href="https://getbootstrap.ru/docs/3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/my3.css">
<script src="js/jquery-3.4.1.js"></script>
<script src="js/makeTable.js"></script>
<script>
function askShow(str, tab)
{
  $.ajax({
       type: "POST",
       url: "logic/search.php",
       dataType: "json",
       data: {find:str, table:tab}
   }).done(function(result)
       {
         if(tab=='events')
         {
           if(result=="no suggestion" || result=="") $("#searchResultEvent").html(result);
           else $("#searchResultEvent").html(makeTableEvent(result));
         }
         if(tab=='cities')
         {
           if(result=="no suggestion" || result=="") $("#searchResultCity").html(result);
           else $("#searchResultCity").html(makeTableCity(result));
         }
       });
}
</script>
</head>
<div class="jumbotron col-lg-6 col-sm-offset-3">
 <h1> Здравствуй, товарищ! </h1>
 <form>
    <div class="col-sm-offset-9 col-xs-3 form-group row">
      <input class="form-control" type="text" value="Найти" onkeyup="askShow(this.value, 'events')">
    </div>
  </form>
  </br>
  <div id="searchResultEvent"></div>
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
  <form>
     <div class="col-sm-offset-9 col-xs-3 form-group row">
       <input class="form-control" type="text" value="Найти" onkeyup="askShow(this.value, 'cities')">
     </div>
   </form>
   </br>
   <div id="searchResultCity"></div>
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
  <p class="col-sm-offset-2 form-group row">
    <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Af80fed1c4f93f2d3b03e728a15918c0df713e2d6ac25a1db72e9f998d80334d3&amp;width=400&amp;height=250&amp;lang=ru_RU&amp;scroll=true"></script>
  </p>
    <h2><?=$_SESSION['date']?></h2>
    <p><a class="btn btn-lg btn-danger" href="secret.php?do=logout" role="button">Выйти</a></p>
    <p><a class="btn btn-lg btn-danger" href="Location: ../index.php">Вернуться на глвную</a></p>
</div>
