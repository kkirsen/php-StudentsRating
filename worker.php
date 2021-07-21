<?php
require_once('class/db.php');
require_once('class/auth.php');
require_once('class/HtmlHelper.php');
/** @var PDO $db */
$db = db::connect();

$login = new auth($db);
$user = $login->check();

$sql = 'SELECT GROUP_CONCAT(id_sub) AS list_subjects, GROUP_CONCAT(id_group) AS list_groups
        FROM table_workers w
        WHERE id_worker = :id_user';
$query = $db->prepare($sql);
$query->execute(['id_user' => $user['id']]);
$dataLists = $query->fetch();
$listSubjects = $dataLists['list_subjects'];
$listGroups = $dataLists['list_groups'];

$sql = "SELECT id, name_sub
        FROM subjects
        WHERE id IN ($listSubjects)";
$query = $db->query($sql);
$dataListsSubjects = $query->fetchALL(PDO::FETCH_KEY_PAIR);

$sql = "SELECT id, name
        FROM groups
        WHERE id IN ($listGroups)";
$query = $db->query($sql);
$dataListsGroups = $query->fetchALL(PDO::FETCH_KEY_PAIR);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!--<link rel="stylesheet" href="style.css">-->
    <title>Document</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-12">Вы вошли как преподаватель: <strong><?= $user['username'] ?></strong></div>
    </div>
    <div class="form-row">
        <div class="сol">
            <?= HtmlHelper::selectList('group', $dataListsGroups, ['prompt' => 'Выберите группу', 'class' => 'form-control']) ?>
        </div>
        <div class="сol">
            <?= HtmlHelper::selectList('subject', $dataListsSubjects, ['prompt' => 'Выберите предмет', 'class' => 'form-control']) ?>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-2">Показать</button>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <table class="table">
                <thead>
                <tr>
                    <th>Номер группы</th>
                    <th>Код предмета</th>
                    <th>Название предмета</th>
                    <th>Код студента</th>
                    <th>ФИО студента</th>
                    <th>Оценки</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
