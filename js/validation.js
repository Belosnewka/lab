function validate()
{
   var name=document.getElementById("name").value;
   var date=document.getElementById("date").value;
   var city=document.getElementById("city").value;
   var count=document.getElementById("participants").value;
   var valid = true;

   if (isFinite(name))
   {
      document.getElementById("nameError").innerHTML="ожидается строка";
      valid = false;
   }
   else document.getElementById("nameError").innerHTML="";
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
   else document.getElementById("participantsError").innerHTML="";
   var re = /\d\d\-\d\d\-\d+/;
   var found = date.match(re);
   if (found==null)
   {
      document.getElementById("dateError").innerHTML="ожидается дата в формате дд-мм-гггг";
      valid = false;
   }
   else document.getElementById("dateError").innerHTML="";
   return valid;
}
