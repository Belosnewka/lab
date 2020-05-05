<?php
function checkPermission ($need)
{
  if(!isset($_SESSION['rights']) || $_SESSION['rights']>$need)
  {
    $mes='У вас нет прав на это действие! Нужен уровень доступа '.$need;
    header("Location: ./errorPage.php?mes=$mes");
    exit;
  }
}
function checkAdmin ()
{
  if(isset($_SESSION['rights']) && $_SESSION['rights'] == 0)
  {
    return true;
  }
  return false;
}
?>
