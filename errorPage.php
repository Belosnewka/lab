<?php
$mes='';
if (isset($_GET['mes'])) $mes=htmlspecialchars($_GET['mes']);
?>
<link href="https://getbootstrap.ru/docs/3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/my3.css">
<div class="jumbotron col-lg-4 col-sm-offset-4 error">
  <h1><?=$mes?></h1>
</div>
