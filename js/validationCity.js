function validateCity()
{
   var volume=document.getElementById("volume").value;
   var city=document.getElementById("city").value;
   var count=document.getElementById("participants").value;
   var valid = true;

   if (isFinite(city))
   {
      document.getElementById("cityError").innerHTML="ожидается строка";
      valid = false;
   }
   else document.getElementById("cityError").innerHTML="";
   if (!isFinite(count))
   {
      document.getElementById("participantsError").innerHTML="ожидается число";
      valid =false;
   }
   if (!isFinite(volume))
   {
      document.getElementById("volumeError").innerHTML="ожидается число";
      valid =false;
   }
   else document.getElementById("volumeError").innerHTML="";
   return valid;
}
