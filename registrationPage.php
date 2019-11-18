<link href="https://getbootstrap.ru/docs/3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/my3.css">
<script src="js/jquery-3.4.1.js"></script>
<script src="js/validationRegistration.js"></script>
<script>
function checkLogin(str)
{
  $.ajax({
       type: "POST",
       url: "logic/registrationCheckLogin.php",
       dataType: "json",
       data: {find:str}
   }).done(function(result)
       {
         if (result=="no") $("#loginError").html("Логин занят!");
       });
}
</script>
<div class="jumbotron col-lg-4 col-sm-offset-4">
  <form name="formForEventTable" method="POST" action="logic/addUser.php" onsubmit="return validate();" style="width:30%; margin-left: 35%;">
     <label for="login">Логин</label>
     <input type="text" name="login" id="login" class="form-control" required onblur="checkLogin(this.value)"><span style="color:red; font-size: 16;" id="loginError"></span><br />
     <label for="pass">Пароль</label>
     <input type="password" name="pass" id="pass" class="form-control" required><span style="color:red; font-size: 16;" id="passError"></span><br />
     <label for="pass2">Повторите пароль</label>
     <input type="password" name="pass2" id="pass2" class="form-control" required><span style="color:red; font-size: 16;" id="pass2Error"></span><br />
     <input class="btn btn-danger" type="submit" name="submit" value="Отправить" />
  </form>
</div>
