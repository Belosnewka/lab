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
   $stmt = $pdo->prepare("SELECT * FROM events LEFT JOIN citizens ON events.master=citizens.login LEFT JOIN cities ON events.city=cities.idCity");
   $stmt->execute();
   return pdoToArray($stmt);
 }
 function askAllEventsFromBDSort($dat,  $people)
 {
   require "ConnectBD.php";
   if($dat && !$people)
   $stmt = $pdo->prepare("SELECT * FROM events LEFT JOIN citizens ON events.master=citizens.login LEFT JOIN cities ON events.city=cities.idCity ORDER BY events.date");
   else if (!$dat && $people)
   $stmt = $pdo->prepare("SELECT * FROM events LEFT JOIN citizens ON events.master=citizens.login LEFT JOIN cities ON events.city=cities.idCity ORDER BY events.participants DESC");
   else
   $stmt = $pdo->prepare("SELECT * FROM events LEFT JOIN citizens ON events.master=citizens.login LEFT JOIN cities ON events.city=cities.idCity ORDER BY events.date ASC, events.participants DESC");
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
 function findEvents($str)
 {
   require "ConnectBD.php";
   if(!is_numeric($str))
   {
     $stmt = $pdo->prepare("SELECT *, MATCH (fulltxt) AGAINST ('*$str*' IN BOOLEAN MODE) as relev FROM events LEFT JOIN citizens ON (events.master=citizens.login and MATCH (fulltxt) AGAINST ('*$str*' IN BOOLEAN MODE)>0) LEFT JOIN cities ON events.city=cities.idCity WHERE citizens.fio IS NOT NULL ORDER BY relev DESC");
   }
   else
   {
     $n=(int)$str;
     $stmt = $pdo->prepare("SELECT * FROM events INNER JOIN cities ON events.city=cities.idCity and participants = '$n'");
   }
   $stmt->execute();
   return pdoToArray($stmt);
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
 function deleteCities($id)
 {
   require "ConnectBD.php";
   $stmt = $pdo->prepare("DELETE FROM cities WHERE idCity = ?");
   $stmt->execute([$id]);
 }
 function findCities($str)
 {
   require "ConnectBD.php";
   if(!is_numeric($str))
   {
     $stmt = $pdo->prepare("SELECT *, MATCH (city) AGAINST ('*$str*' IN BOOLEAN MODE) as relev FROM cities WHERE MATCH (city) AGAINST ('*$str*' IN BOOLEAN MODE)>0  ORDER BY relev DESC");
   }
   else
   {
     $n=(int)$str;
     $stmt = $pdo->prepare("SELECT * FROM cities WHERE production = '$n' or people = '$n'");
   }
   $stmt->execute();
   return pdoToArray($stmt);
 }
 //------------------------Функции с таблицой пользователей----------------------------------
function chekLogin($login)
{
  require "ConnectBD.php";
  $stmt = $pdo->prepare("SELECT * FROM users WHERE login = '$login'");
  $stmt->execute();
  return pdoToArray($stmt);
}
function writeNewUser($allowed, $values)
{
  require "ConnectBD.php";
  $sql = "INSERT INTO users SET ".pdoSet($allowed);
  $stmt = $pdo->prepare($sql);
  $stmt->execute($values);
  return $pdo->lastInsertId();
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
 //------------------------Преступления, жители, свидетели функции----------------------------------
 function askCrimesFromBD()
 {
   require "ConnectBD.php";
   $stmt = $pdo->prepare("SELECT * FROM crimes LEFT OUTER JOIN citizens ON crimes.witness=citizens.idCitizen LEFT OUTER JOIN events ON crimes.event=events.id");
   $stmt->execute();
   return pdoToArray($stmt);
 }
 function askCrimeIDFromBD($id)
 {
   require "ConnectBD.php";
   $stmt = $pdo->prepare("SELECT * FROM crimes WHERE idCrime=?");
   $stmt->execute([$id]);
   return $stmt->fetch();
 }
 function writeNewCrime($allowed, $values)
 {
   require "ConnectBD.php";
   $sql = "INSERT INTO crimes SET ".pdoSet($allowed);
   $stmt = $pdo->prepare($sql);
   $stmt->execute($values);
   return $pdo->lastInsertId();
 }
 function updateCrime($allowed, $values, $id)
 {
   require "ConnectBD.php";
   $sql = "UPDATE crimes SET ".pdoSet($allowed)." WHERE idCrime=$id";
   $stmt = $pdo->prepare($sql);
   $stmt->execute($values);
 }
 function deleteCrime($id)
 {
   require "ConnectBD.php";
   $stmt = $pdo->prepare("DELETE FROM crimes WHERE idCrime = ?");
   $stmt->execute([$id]);
 }
 function askCitizensFromBD()
 {
   require "ConnectBD.php";
   $stmt = $pdo->prepare("SELECT * FROM citizens INNER JOIN cities ON citizens.city=cities.idCity INNER JOIN users ON citizens.login=users.id");
   $stmt->execute();
   return pdoToArray($stmt);
 }
 function askRightsFromBD($id)
 {
   require "ConnectBD.php";
   $stmt = $pdo->prepare("SELECT rights FROM citizens WHERE login = '$id'");
   $stmt->execute();
   return pdoToArray($stmt);
 }
 function writeNewCheckedUser($allowed, $values)
 {
   require "ConnectBD.php";
   $sql = "INSERT INTO citizens SET ".pdoSet($allowed);
   $stmt = $pdo->prepare($sql);
   $stmt->execute($values);
   return $pdo->lastInsertId();
 }
 function addCheckedUser($allowed, $values, $id)
 {
   require "ConnectBD.php";
   $sql = "UPDATE citizens SET ".pdoSet($allowed)." WHERE idCitizen=$id";
   $stmt = $pdo->prepare($sql);
   $stmt->execute($values);
 }
 function delCheckedUser($id)
 {
   try
   {
     require "ConnectBD.php";
     $stmt = $pdo->prepare("DELETE FROM citizens WHERE idCitizen = ?");
     $stmt->execute([$id]);
     return true;
   } catch (\Exception $e)
   {
     $ans['error']=$e->getMessage();
     return $ans;
   }

 }
function statistic($id)
{
  require "ConnectBD.php";
  $stmt = $pdo->prepare("CALL statistic($id)");
  $stmt->execute();
  $res = pdoToArray($stmt);
  $data =  array();
  $filterOutKeys = array('crime', 'fio');
  foreach ($res as $key)
  {
    $data[$key['id']]['name'] = $key['name'];
    $data[$key['id']]['date'] = $key['date'];
    $data[$key['id']]['city'] = $key['city'];
    $data[$key['id']]['participants'] = $key['participants'];
    if (array_key_exists('crime', $key)) $data[$key['id']]['crime'][]= array_intersect_key($key, array_flip($filterOutKeys));
  }
  return $data;
}
   //------------------------Вспомогательные функции----------------------------------
   function execAdminField($str)
   {
     try
     {
       require "ConnectBD.php";
       $stmt = $pdo->prepare($str);
       $stmt->execute();
     }
     catch(Exception $e)
     {
       return 'Неверный запрос';
     }
     return pdoToArray($stmt);
   }
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
