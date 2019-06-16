<?php
$this->title = 'Lea - отметить как учителя'
?>

<h1>Список пользователей</h1>

<table class="table table-striped">
    <tr>
        <th>id</th>
        <th>Фамилия и Имя</th>
        <th>Роль</th>
        <th>Действие</th>
    </tr>
    <?php foreach($users as $user): ?>
        <tr>
            <td><?= $user->id ?></td>
            <td><?= $user->first_last_name ?></td>
            <td><?= $user->role ?></td>
            <td><a href="<?= \yii\helpers\Url::to(['/admin/default/set-teacher','id' => $user->id]) ?>"><?= $user->role == 'teacher' ? 'Пометить как ученика' : 'Пометить как учителя' ?></a></td>
        </tr>
    <?php endforeach; ?>
</table>