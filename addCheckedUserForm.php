<?php
include "logic/dbLogic/workWithDB.php";
require "logic/autho.php";
if(isset($_SESSION['rights']) || count(askRightsFromBD($_SESSION['user'])) != 0)
{
  $mes='Вы уже проверенный пользователь.';
  header("Location: ./errorPage.php?mes=$mes");
  exit;
}

$res=askAllCitiesFromBD();
?>
<link href="https://getbootstrap.ru/docs/3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/my3.css">
<script src="js/validationPass.js"></script>
<div class="jumbotron col-lg-4 col-sm-offset-4">
  <form name="formForUserTable" method="POST" action="logic/checkedUser.php?add=true" onsubmit="return validate();" style="width:30%; margin-left: 35%;">
     <label for="city">Город</label>
     <select name="city" id="city" required>
       <?php foreach ($res as $key) {
         ?><option value='<?php echo $key['idCity'];?>'><?php echo $key['city'];?></option>
       <?php }?>
     </select><span style="color:red; font-size: 16;" id="cityError"></span><br />
     <label for="name">Ф.И.О.</label>
     <input type="text" name="name" id="name"/ class="form-control" required><span style="color:red;font-size: 16;" id="nameError"></span><br />
     <label for="passport">Серия и номер паспорта</label>
     <input type="text" name="passport" id="passport"/ class="form-control" required><span style="color:red;font-size: 16;" id="passportError"></span><br />
     <input class="btn btn-danger" type="submit" name="submit" value="Отправить" />
  </form>
</div>
