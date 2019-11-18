<?php
require "autho.php";
include "dbLogic/workWithDB.php";
$hint="";
$response="";
$find="";
$table="";
if (isset($_POST["find"])) $find=htmlspecialchars($_POST["find"]);
if (isset($_POST["table"])) $table=htmlspecialchars($_POST["table"]);

if (strlen($find)>0)
{
  if($table=="events") $hint=findEvents($find);
  if($table=="cities") $hint=findCities($find);
}
else
{
  echo json_encode($hint);
  exit;
}
if ($hint==NULL)
{
  $response="no suggestion";
}
else
{
  $response=$hint;
}
echo json_encode($response);
?>
