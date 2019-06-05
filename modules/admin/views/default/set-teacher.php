<?php
$this->title = 'Lea - отметить как учителя'
?>

<h1>Список пользователей</h1>

<table class="table table-striped">
    <?php foreach($users as $user): ?>
        <tr>
            <td><?= $user->id ?></td>
            <td><?= $user->first_last_name ?></td>
            <td><?= $user->role ?></td>
            <td><a href="<?= \yii\helpers\Url::to(['id' => $user->id]) ?>"><?= $user->role == 'teacher' ? 'Пометить как ученика' : 'Пометить как учителя' ?></a></td>
        </tr>
    <?php endforeach; ?>
    <tr>
        <td>2</td>
        <td>Олег Жуков</td>
        <td>teacher</td>
        <td><a href="#">Пометить как ученика</a></td>
    </tr>
</table>