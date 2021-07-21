<?php
require_once('class/db.php');
require_once('class/auth.php');
/** @var PDO $db */
$db = db::connect();

$login = new auth($db);
$login->logout();
