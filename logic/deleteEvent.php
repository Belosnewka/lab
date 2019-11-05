<?php
require "autho.php";
include "dbLogic/workWithDB.php";
$id=0;
if (isset($_GET['id'])) $id=$_GET['id'];
$res=askEventWithIDFromBD($id);
if($res)
{
  if($res['master']==$_SESSION['user'])
  {
    deleteEvent($id);
    header("Location: ../secret.php");
  }
  else
  {
    $mes='Вы не можете удалить событие другого товарища!';
    header("Location: ../errorPage.php?mes=$mes");
  }
}
?>
