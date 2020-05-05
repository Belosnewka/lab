<?php
require "logic/autho.php";
include "logic/checkPermission.php";
include "logic/dbLogic/workWithDB.php";
checkAdmin();


$pub=isset($_SESSION['pub']) && $_SESSION['pub'];
$people=isset($_SESSION['people']) && $_SESSION['people'];
if($pub || $people)
{
  $res=askAllEventsFromBDSort($pub, $people);
}
else $res=askAllEventsFromBD();
$res1=askIpFromBD();
$res2=askViewsFromBD();
$res3=askAllCitiesFromBD();
$res4=askCitizensFromBD();
$res5=askCrimesFromBD();
$res7=statistic($_SESSION['user']);

if(isset($_POST['textAdmin']) && checkAdmin() && (!isset($_SESSION['amdReq']) || $_SESSION['amdReq']!=$_POST['textAdmin']))
{
  $textAdmin=$_POST['textAdmin'];
  $_SESSION['amdReq'] = $_POST['textAdmin'];
  $res6=execAdminField($textAdmin);
}

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

<?php if(checkAdmin()){
  ?>
     <div class="col-sm-offset-2 col-xs-9 form-group row">
       <form name="formForEventTable" action="secret.php" method="post" style="width:80%; margin-left: 5%;">
         <input class="form-control" type="text" name="textAdmin" value="Выполнить" style="margin-bottom: 10%;">
         <input class="btn btn-danger" type="submit" name="submit" value="Отправить" />
      </form>
     </div>
   </br>
   <?php if(isset($res6)){?>
     <div id="bdFeildResult" class="col-sm-offset-2 col-xs-9" style="margin-left: 13%;">
       <h2>Результат</h2>
       <?php echo var_dump($res6);?>
     </div>
   <?php }?>
<?php }?>

 <h2 class="showEvents">События</h2>
 <div class="events hidden">
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
        <th>Дата<a href="logic/sort.php?pub=true">^</a><br><a href="logic/sort.php?both=true">+ по кол-ву</a></th>
        <th>Город</th>
        <th>Ответственный</th>
        <th>Кол-во участников<a href="logic/sort.php?people=true">^</a><br><a href="logic/sort.php?both=true">+ по дате</a></th>
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
              <td> <?php echo $row['fio'] ?>  </td>
              <td> <?php echo $row['participants'] ?>  </td>
              <td><p><a class="btn btn-info" href="logic/deleteEvent.php?id=<?php echo $row['id']?>" role="button">Удалить</a></p>
                <a class="btn btn-success" href="updateEventForm.php?id=<?php echo $row['id']?>" role="button">Изменить</a></td>
            </tr>
      <?php } ?>
    </table>
    <p><a class="btn btn-lg btn-danger" href="addEvent.php" role="button">Добавить событие</a></p>
  </div>


  <h2 class="showCities">Города</h2>
  <div class="cities hidden">
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
        <th>Заинтересованная публика</th>
        <th>Оборот средств</th>
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
  </div>


  <h2 class="showCitizens">Проверенные пользователи</h2>
  <div class="citizens hidden">
     <table class="table table-bordered table-hover table-sm tablesp">
       <tr>
         <th>Пользователь</th>
         <th>Город</th>
         <th>Налог</th>
         <th>ФИО</th>
         <?php if(checkAdmin()){?>
         <th>Паспорт</th>
         <th>Действие</th>
       <?php }?>
       </tr>
         <?php
         foreach ($res4 as $row)
         {
         ?>
             <tr>
               <td><?php echo $row['login'] ?></td>
               <td><?php echo $row['city'] ?></td>
               <td> <?php echo $row['pay'] ?></td>
               <td> <?php echo $row['fio'] ?></td>
               <?php if(checkAdmin()){?>
                 <td> <?php echo $row['passport'] ?></td>
                 <td><p><a class="btn btn-info" href="logic/checkedUser.php?del=true&id=<?php echo $row['idCitizen'];?>" role="button">Удалить</a></p>
                  <?php if($row['rights'] ==3){?><a class="btn btn-success" href="logic/checkedUser.php?acept=true&id=<?php echo $row['idCitizen'];?>" role="button">Подтвердить</a></td><?php }?>
               <?php }?>
             </tr>
       <?php } ?>
     </table>
     <p><a class="btn btn-lg btn-danger" href="addCheckedUserForm.php" role="button">Подать заявку</a></p>
   </div>

   <h2 class="showCrimes">Происшествия</h2>
   <div class="crimes hidden">
      <table class="table table-bordered table-hover table-sm tablesp">
        <tr>
          <th>Название</th>
          <th>Свидетель</th>
          <th>Событие</th>
          <th>Действие</th>
        </tr>
          <?php
          foreach ($res5 as $row)
          {
          ?>
              <tr>
                <td><?php echo $row['crime'] ?></td>
                <td><?php echo $row['fio'] ?></td>
                <td> <?php echo $row['name'] ?>  </td>
                <td><p><a class="btn btn-info" href="logic/crime.php?del=true&id=<?php echo $row['idCrime']?>" role="button">Удалить</a></p>
                  <a class="btn btn-success" href="updateCrimeForm.php?id=<?php echo $row['idCrime']?>" role="button">Изменить</a></td>
              </tr>
        <?php } ?>
      </table>
      <p><a class="btn btn-lg btn-danger" href="addCrimeForm.php" role="button">Добавить происшествие</a></p>
    </div>
    <?php $t=current($res7);
    if(isset($t['crime']) || checkAdmin() || (isset($_SESSION['rights']) && $_SESSION['rights'] == 2)){
      if(!isset($t['crime'])){
        echo '<h3>Вы не проводили мероприятия</h3>';
      }else{
        ?>
      <h2>Ваши мероприятия</h2>
      <table class="table table-bordered table-hover table-sm tablesp">
        <tr>
          <th>Название</th>
          <th>Дата</th>
          <th>Город</th>
          <th>Кол-во участников</th>
          <th>Действие</th>
          <th>Происшествия</th>
        </tr>
          <?php
          foreach ($res7 as $keyval => $row)
          {
          ?>
              <tr>
                <td><?php echo $row['name'] ?></td>
                <td><?php echo $row['date'] ?></td>
                <td> <?php echo $row['city'] ?>  </td>
                <td> <?php echo $row['participants'] ?>  </td>
                <td><p><a class="btn btn-info" href="logic/deleteEvent.php?id=<?php echo $keyval?>" role="button">Удалить</a></p>
                  <a class="btn btn-success" href="updateEventForm.php?id=<?php echo $keyval?>" role="button">Изменить</a></td>
                <td>
                  <?php foreach ($row['crime'] as $key) {?>
                  <?php echo $key['crime'] ?></br>
                    Свидетель:</br>
                    <?php echo $key['fio'] ?>
                  <?php } ?>
                </td>
              </tr>
        <?php } ?>
      </table>
      <?php } ?>
    <?php } else{
      if(!isset($_SESSION['rights'])){
        echo '<h3>Для отображения собственной статистики нужно стать проверенным пользователем</h3>';
      }else{
      ?>
      <h2>Топ-3 мероприятия</h2>
      <table class="table table-bordered table-hover table-sm tablesp">
        <tr>
          <th>Название</th>
          <th>Дата</th>
          <th>Город</th>
          <th>Кол-во участников</th>
        </tr>
          <?php
          foreach ($res7 as $row)
          {
          ?>
              <tr>
                <td><?php echo $row['name'] ?></td>
                <td><?php echo $row['date'] ?></td>
                <td> <?php echo $row['city'] ?></td>
                <td> <?php echo $row['participants'] ?></td>
              </tr>
          <?php } ?>
        </table>
    <?php } ?>
    <?php } ?>
    <h2><?=$_SESSION['date']?></h2>
    <p><a class="btn btn-lg btn-danger" href="secret.php?do=logout" role="button">Выйти</a></p>
    <p><a class="btn btn-lg btn-danger" href="Location: ../index.php">Вернуться на глвную</a></p>
</div>
<script>
$('.showCities').click(
  function () {
    $('.cities').toggleClass('hidden');
  }
);
$('.showEvents').click(
  function () {
    $('.events').toggleClass('hidden');
  }
);
$('.showCitizens').click(
  function () {
    $('.citizens').toggleClass('hidden');
  }
);
$('.showCrimes').click(
  function () {
    $('.crimes').toggleClass('hidden');
  }
);
</script>
