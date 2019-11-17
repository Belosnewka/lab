<?php
require "autho.php";
include "dbLogic/workWithDB.php";
if (isset($_POST["find"])) $find=$_POST["find"];
$hint="";
$response="";

if (strlen($find)>0)
{
  $hint=findEvents($find);
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
