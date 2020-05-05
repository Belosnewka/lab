<?php
require "logic/autho.php";
include "logic/checkPermission.php";
include "logic/dbLogic/workWithDB.php";
checkPermission(2);
$id=0;
if (isset($_GET['id'])) $id=$_GET['id'];
$res=askEventWithIDFromBD($id);
$res2=askCityWithIDFromBD($res['city']);
$res3=askAllCitiesFromBD();
if(!$res) exit;
?>
<link href="https://getbootstrap.ru/docs/3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/my3.css">
<script src="js/validation.js"></script>
<div class="jumbotron col-lg-4 col-sm-offset-4">
  <form name="formForEventTable" method="POST" action="logic/updateEvent.php?id=<?php echo $id?>" onsubmit="return validate();" style="width:30%; margin-left: 35%;">
     <label for="city">Город</label>
     <select name="city" id="city">
       <?php foreach ($res3 as $key) {
         ?><option value='<?php echo $key['city'];?>' <?php if($key['city']==$res['city']) echo 'selected';?>><?php echo $key['city'];?></option>
       <?php }?>
     </select><span style="color:red; font-size: 16;" id="cityError"></span><br />
     <span style="color:red; font-size: 16;" id="cityError"></span><br />
     <label for="date">Дата</label>
     <input type="date" name="date" id="date"/ class="form-control" required value=<?php echo $res['date'] ?>><span style="color:red; font-size: 16;" id="dateError"></span><br />
     <label for="participants">Количество участников</label>
     <input type="number" name="participants" id="participants"/ class="form-control" required value=<?php echo $res['participants'] ?>><span style="color:red; font-size: 16;" id="participantsError"></span><br />
     <label for="name">Название</label>
     <input type="text" name="name" id="name"/ class="form-control" required value=<?php echo $res['name'] ?>><span style="color:red;font-size: 16;" id="nameError"></span><br />
     <input class="btn btn-danger" type="submit" name="submit" value="Отправить" />
  </form>
</div>
