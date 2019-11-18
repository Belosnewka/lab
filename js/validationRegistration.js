function validate()
{
   var pass=document.getElementById("pass").value;
   var pass2=document.getElementById("pass2").value;
   var valid = true;

   if (pass!=pass2)
   {
      document.getElementById("pass2Error").innerHTML="Пароли не совпадают";
      valid = false;
   }
   else document.getElementById("pass2Error").innerHTML="";
   var re = /(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z!@#$%^&*]{6,}/g;
   var found = pass.match(re);
   if (found==null)
   {
      document.getElementById("passError").innerHTML="Ожидается пароль длинной более 5 символов, содержащий спец символ, цифру, латинскую букву в Верхнем и нижнем регистре";
      valid = false;
   }
   else document.getElementById("passError").innerHTML="";
   return valid;
}
