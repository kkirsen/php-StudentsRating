<?php
require_once('class/db.php');
require_once('class/auth.php');
/** @var PDO $db */
$db = db::connect();

$login = new auth($db, auth::ACCESS_TYPE_STUDENTS);
if ($login->check()) {
    $login::redirect($login->getRedirectUrl());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Login page for students</title>
</head>
<body>

<div class="container">
    <form class="form-singin" method="POST" action="login.php">
        <h2> Login </h2>

        <input type="text" name="login" class="form-control" placeholder="login" required>
        <input type="password" name="password" class="form-control" placeholder="password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
    </form>
</div>
</body>
</html>