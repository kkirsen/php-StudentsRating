<?php
require_once('class/db.php');
require_once('class/auth.php');
/** @var PDO $db */
$db = db::connect();

$loginText = isset($_POST['login']) ? (int)$_POST['login'] : null;
$passText = isset($_POST['password']) ? (int)$_POST['password'] : null;

$login = new auth($db);
$login->login($loginText, $passText);
$user = $login->check();