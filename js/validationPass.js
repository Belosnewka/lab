function validate()
{
   var passport=document.getElementById("passport").value;
   var re = /^\d{10}$/;
   var found = re.test(passport);
   if (!found)
   {
      document.getElementById("passportError").innerHTML="Ожидаются пасспортные данные из 10 цифр одной строкой";
      return false;
   }
   else document.getElementById("passportError").innerHTML="";
   return true;
}
