<?php
include "dbLogic/workWithDB.php";
$hint="";
$response="";
$find="";
if (isset($_POST["find"])) $find = htmlspecialchars($_POST["find"]);

$hint=chekLogin($find);

if ($hint!=NULL)
{
  $response="no";
}
echo json_encode($response);
?>
