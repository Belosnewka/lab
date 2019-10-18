<?php
include "dbLogic/workWithDB.php";
function getIP()
{
  if (isset($_SERVER['HTTP_X_REAL_IP'])) $ip=$_SERVER['HTTP_X_REAL_IP'];
  else if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
  else if (isset($_SERVER['HTTP_CLIENT_IP'])) $ip=$_SERVER['HTTP_CLIENT_IP'];
  else $ip=$_SERVER['REMOTE_ADDR'];
  return $ip;
}

$ip=0;
$from='';
$where='';
if (!(isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/bot|crawl|slurp|spider|mediapartners/i', $_SERVER['HTTP_USER_AGENT'])))
{
  $ip=getIP();
  if (isset($_SERVER['HTTP_REFERER']))
  {
    if (strstr(parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST), 'vk.com')) $from='vk';
    else if (strstr(parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST), '.ru/search')) $from='browser';
    else if (strstr(parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST), 'localhost')) $from='inside';
  }
  $where=$_SERVER['REQUEST_URI'];
}
writeHit ($ip, $from, $where);
?>
