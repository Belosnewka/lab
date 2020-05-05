<?php
require "autho.php";
include "checkPermission.php";
include "dbLogic/workWithDB.php";

if(isset($_GET['pub']))
{
  $_SESSION['pub']=true;
  $_SESSION['pubpeople']=false;
}
if(isset($_GET['people']))
{
  $_SESSION['people']=true;
  $_SESSION['pub']=false;
}
if(isset($_GET['both']))
{
  $_SESSION['people']=true;
  $_SESSION['pub']=true;
}
header("Location: ../secret.php");
