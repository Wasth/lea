<?php
$this->title = 'Мои результаты';
?>

<div class="container mt-3">
    <h3>Результаты</h3>
    <table class="table table-striped">
        <tr>
            <th>Название теста</th>
            <th>Баллы</th>
            <th>Время прохождения</th>
        </tr>
        <?php foreach($data as $test_result): ?>
            <tr>
                <td><?= $test_result->getResultData()['test_name'] ?></td>
                <td><?= $test_result->getResultData()['score'] ?>/<?= $test_result->getResultData()['max_score'] ?></td>
                <td><?= $test_result->getResultData()['pass_time'] ?> сек.</td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

