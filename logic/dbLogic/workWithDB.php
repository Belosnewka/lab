<?php
function writeHit($ip, $from, $where) //записываем посещение в бд
{
  require "ConnectBD.php";
   if ($from)
   {
     switch ($from)
     {
      case 'vk':
          $stmt = $pdo->prepare("UPDATE views SET vk=vk+1 WHERE page=?");
          break;
      case 'browser':
          $stmt = $pdo->prepare("UPDATE views SET browser=browser+1 WHERE page=?");
          break;
      case 'inside':
          $stmt = $pdo->prepare("UPDATE views SET inside=inside+1 WHERE page=?");
          break;
     }
     $stmt->execute([$where]);
     $stmt = $pdo->prepare("UPDATE views SET countOfViews=countOfViews+1 WHERE page=?");
     $stmt->execute([$where]);
   }
   $stmt = $pdo->prepare("INSERT INTO ips (ip) VALUES (?)");
   $stmt->execute([$ip]);
 }
 //------------------------Функции с таблицей событий----------------------------------
 function askAllEventsFromBD()
 {
   require "ConnectBD.php";
   $stmt = $pdo->prepare("SELECT * FROM events INNER JOIN cities ON events.city=cities.idCity");
   $stmt->execute();
   return pdoToArray($stmt);
 }
 function askEventWithIDFromBD($id)
 {
   require "ConnectBD.php";
   $stmt = $pdo->prepare("SELECT * FROM events WHERE id=?");
   $stmt->execute([$id]);
   return $stmt->fetch();
 }
 function deleteEvent($id)
 {
   require "ConnectBD.php";
   $stmt = $pdo->prepare("DELETE FROM events WHERE id = ?");
   $stmt->execute([$id]);
 }
 function writeNewEvent($allowed, $values)
 {
   require "ConnectBD.php";
   $sql = "INSERT INTO events SET ".pdoSet($allowed);
   $stmt = $pdo->prepare($sql);
   $stmt->execute($values);
 }
 function updateEvent($allowed, $values, $id)
 {
   require "ConnectBD.php";
   $sql = "UPDATE events SET ".pdoSet($allowed)." WHERE id=$id";
   $stmt = $pdo->prepare($sql);
   $stmt->execute($values);
 }
  //------------------------Функции с таблицей городов----------------------------------
 function askAllCitiesFromBD()
 {
   require "ConnectBD.php";
   $stmt = $pdo->prepare("SELECT * FROM cities");
   $stmt->execute();
   return pdoToArray($stmt);
 }
 function askCityWithIDFromBD($id)
 {
   require "ConnectBD.php";
   $stmt = $pdo->prepare("SELECT * FROM cities WHERE idCity=?");
   $stmt->execute([$id]);
   return $stmt->fetch();
 }
 function writeNewCity($allowed, $values)
 {
   require "ConnectBD.php";
   $sql = "INSERT INTO cities SET ".pdoSet($allowed);
   $stmt = $pdo->prepare($sql);
   $stmt->execute($values);
 }
 function updateCity($allowed, $values, $id)
 {
   require "ConnectBD.php";
   $sql = "UPDATE cities SET ".pdoSet($allowed)." WHERE idCity=$id";
   $stmt = $pdo->prepare($sql);
   $stmt->execute($values);
 }
 function deleteCity($id)
 {
   require "ConnectBD.php";
   $stmt = $pdo->prepare("DELETE FROM cities WHERE idCity = ?");
   $stmt->execute([$id]);
 }
  //------------------------Функции с таблицами посещений и пользователей----------------------------------
 function askIpFromBD()
 {
   require "ConnectBD.php";
   $stmt = $pdo->prepare("SELECT DISTINCT ip FROM ips");
   $stmt->execute();
   return pdoToArray($stmt);
 }
 function askViewsFromBD()
 {
   require "ConnectBD.php";
   $stmt = $pdo->prepare("SELECT * FROM views ORDER BY countOfViews ASC");
   $stmt->execute();
   return pdoToArray($stmt);
 }
   //------------------------Вспомогательные функции----------------------------------
 function pdoSet($allowed) // функция для оформления в sql запрос - какие поля буду заполнять и чем (поле $field получит $field из $values), нашла и переделала для себя
 {
  $set = '';
  foreach ($allowed as $field)
  {
      $set.="`".str_replace("`","``",$field)."`". "=:$field, ";
  }
  return substr($set, 0, -2);
}
function pdoToArray($stmt)
{
  $res=array();
  $i=0;
  while ($row = $stmt->fetch())
  {
    $res[$i]=$row;
    $i++;
  }
  return $res;
}
?>
