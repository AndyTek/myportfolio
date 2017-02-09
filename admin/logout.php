<?php

$dir = dirname(__FILE__);
require_once $dir.'/../includes/global.inc.php';

$UserTools = new UserTools();
$UserTools->logout();

header("Location: index.php");

?>