function makeTableEvent(str)
{
  var res = "<table class=\"table table-bordered table-hover table-sm tablesp\">";
      res+="<tr>";
        res+="<th>Название</th>";
        res+="<th>Дата</th>";
        res+="<th>Город</th>";
        res+="<th>Ответственный</th>";
        res+="<th>Кол-во участников</th>";
        res+="<th>Действие</th></tr>";
      for(var i=0; i<str.length; i++){
        res+="<tr>";
        res+="<td>" +str[i].name +"</td>";
        res+="<td>"+str[i].date+"</td>";
        res+="<td>" +str[i].city + "</td>";
        res+="<td>" + str[i].fio + "</td>";
        res+="<td>" + str[i].participants+ "</td>";
        res+="<td><p><a class=\"btn btn-info\" href=\"logic/deleteEvent.php?id="+str[i].id+"role=\"button\">Удалить</a></p>";
        res+="<a class=\"btn btn-success\" href=\"updateEventForm.php?id="+str[i].id+ "role=\"button\">Изменить</a></td></tr>";
      }
      res+="</table>";
      return res;
}
function makeTableCity(str)
{
  var res = "<table class=\"table table-bordered table-hover table-sm tablesp\">";
      res+="<tr>";
        res+="<th>Название</th>";
        res+="<th>Заинтересованная публика</th>";
        res+="<th>Объем средств</th>";
        res+="<th>Фото</th>";
        res+="<th>Действие</th></tr>";
      for(var i=0; i<str.length; i++){
        res+="<tr>";
        res+="<td>" +str[i].city +"</td>";
        res+="<td>"+str[i].people+"</td>";
        res+="<td>" +str[i].production + "</td>";
        res+="<td> <img src=\"images\\/" + str[i].city+ ".jpg\"> </td>";
        res+="<td><p><a class=\"btn btn-info\" href=\"logic/deleteEvent.php?id="+str[i].id+"role=\"button\">Удалить</a></p>";
        res+="<a class=\"btn btn-success\" href=\"updateEventForm.php?id="+str[i].id+ "role=\"button\">Изменить</a></td></tr>";
      }
      res+="</table>";
      return res;
}
