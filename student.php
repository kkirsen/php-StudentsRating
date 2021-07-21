<?php
require_once('class/db.php');
require_once('class/auth.php');
/** @var PDO $db */
$db = db::connect();

$login = new auth($db);
$user = $login->check();

function getResultForStudent($avgMark)
{
    $textResult = [
        3 => 'Удовлетворительно',
        4 => 'Хорошо',
        5 => 'Отлично',
    ];
    $avgMark = floor($avgMark);

    if ($avgMark < 3) {
        return 'Неудовлетворительно';
    }

    return $textResult[$avgMark];
}

$sql = 'SELECT g.name
        FROM students_in_group sg
        INNER JOIN groups g ON sg.id_group=g.id
        WHERE id_user=:id_user';
$query = $db->prepare($sql);
$query->execute(['id_user' => $user['id']]);
$groupName = $query->fetchColumn();

$sql = 'SELECT id, name_sub
        FROM subjects
        WHERE 1';
$subjects = $db->query($sql)->fetchALL(PDO::FETCH_KEY_PAIR);

$sql = 'SELECT AVG(`mark`) as avg, GROUP_CONCAT(`mark`) as text_marks, `id_subject`
        FROM `marks`
        WHERE `id_student` = :student
        GROUP BY id_subject';
$query = $db->prepare($sql);
$query->execute(['student' => $user['id']]);
$data = $query->fetchALL();
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
    <title>Document</title>
</head>
<body>
<p>Вы вошли как студент: <strong><?= $user['username'] ?></strong> <a href="/logout.php">Выйти</a></p>
<p>Группа: <strong><?= $groupName ?></strong></p>
<h2><b>Рейтинг</b></h2>
<table class="table">
    <thead>
    <tr>
        <th>Предмет</th>
        <th>Оценки</th>
        <th>Итог</th>
        <th>Результат</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($data as $subject): ?>
        <tr>
            <td><?= $subjects[$subject['id_subject']] ?></td>
            <td><?= $subject['text_marks'] ?></td>
            <td><?= $subject['avg'] ?></td>
            <td><?= getResultForStudent($subject['avg']) ?></td>
        </tr>
    <?php endforeach; ?>

    </tbody>
</table>
</body>
</html>
