<?php
$this->title = 'Созданные мной';
use yii\helpers\Url;
?>
<script>
    function confirmDelete() {

        if (confirm("Вы подтверждаете удаление?")) {

            return true;

        } else {

            return false;

        }

    }

</script>
<div class="container">
    <?php if($tests): ?>
    <?php foreach($tests as $test): ?>
    <div class="card mt-3 card-body test-card">
        <div class="d-flex w-100 justify-content-between align-items-center">
            <div class="name">
                <?= $test->name ?>
            </div>
            <div class="questions">
                Вопросов: <?= count($test->questions) ?>
            </div>
            <div class="time-limit">
                Время на прохождение: <?= $test->time_limit ? $test->time_limit : 'неогр. кол-во' ?> сек.
            </div>
            <div class="attempt-linit">
                Попыток: <?= $test->attempt_limit ? $test->attempt_limit : 'неогр.' ?>
            </div>
            <div class="actions">
                <a href="<?= Url::to(['/test/update', 'id' => $test->id]) ?>">
                    <button class="btn btn-primary">Редактировать</button>
                </a><a href="<?= Url::to(['/test/delete', 'id' => $test->id]) ?>" onclick="return confirmDelete();">
                    <button class="btn btn-danger">Удалить</button>
                </a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <?php else: ?>
        <h1 class="text-secondary mt-3">Вы еще не создавали тесты</h1>
    <?php endif; ?>
</div>
