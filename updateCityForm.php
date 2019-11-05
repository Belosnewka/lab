<?php
require "logic/autho.php";
include "logic/dbLogic/workWithDB.php";
$id=0;
if (isset($_GET['id'])) $id=$_GET['id'];
$res=askCityWithIDFromBD($id);
if(!$res) exit;
?>
<link href="https://getbootstrap.ru/docs/3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/my3.css">
<script src="js/validation.js"></script>
<div class="jumbotron col-lg-4 col-sm-offset-4">
  <form name="formForCityTable" method="POST" enctype="multipart/form-data" action="logic/updateCity.php?id=<?php echo $id?>" onsubmit="return validateCity();" style="width:30%; margin-left: 35%;">
    <label for="city">Название</label>
    <input type="text" name="city" id="city"/ class="form-control" required value=<?php echo $res['city'] ?>><span style="color:red; font-size: 16;" id="cityError"></span><br />
     <label for="participants">Количество жителей</label>
     <input type="number" name="participants" id="participants"/ class="form-control" required value=<?php echo $res['people'] ?>><span style="color:red; font-size: 16;" id="participantsError"></span><br />
     <label for="volume">Объем производства</label>
     <input type="number" name="volume" id="volume"/ class="form-control" required value=<?php echo $res['production'] ?>><span style="color:red;font-size: 16;" id="volumeError"></span><br />
     <label for="file">Фото</label>
     <input type="file" name="file" id="file">
     <label for="contactChoice">Удалить прошлую фотографию</label>
     <input type="radio" id="contactChoice" name="del" value="delFile"></br>
     <input class="btn btn-danger" type="submit" name="submit" value="Отправить" />
   </form>
</div>
