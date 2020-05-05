<?php
require "logic/autho.php";
include "logic/checkPermission.php";
include "logic/dbLogic/workWithDB.php";
checkPermission(1);
$res1=askAllEventsFromBD();
$res=askCitizensFromBD();
?>
<link href="https://getbootstrap.ru/docs/3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/my3.css">
<script src="js/validationCity.js"></script>
<div class="jumbotron col-lg-4 col-sm-offset-4">
  <form name="formForCityTable" method="POST" enctype="multipart/form-data" action="logic/crime.php?add=true" style="width:30%; margin-left: 35%;">
      <label for="name">Название происшествия</label>
      <input type="text" name="name" id="name"/ class="form-control" required>
      <label for="witness">Свидетель</label>
      <select style="margin-left:-15px;" name="witness" id="witness" required>
        <?php foreach ($res as $key) {
          ?><option value='<?php echo $key['idCitizen'];?>'><?php echo $key['fio'];?></option>
        <?php }?>
      </select>
      <label for="event">Событие</label>
      <select name="event" id="event" required>
        <?php foreach ($res1 as $key) {
          ?><option value='<?php echo $key['id'];?>'><?php echo $key['name'];?></option>
        <?php }?>
      </select>
      <input style="margin-top:5px;" class="btn btn-danger" type="submit" name="submit" value="Отправить" />
  </form>
</div>
