<?php
$this->title = 'Прикрепленные ко мне';
use yii\helpers\Url;
?>
<div class="container">
    <?php if($tests_access): ?>
    <?php foreach($tests_access as $test_a): ?>
        <div class="card mt-3 card-body test-card">
            <div class="d-flex w-100 justify-content-between align-items-center">
                <div class="name">
                    <?= $test_a->test->name ?>
                </div>
                <div class="questions">
                    Вопросов: <?= count($test_a->test->questions) ?>
                </div>
                <div class="time-limit">
                    Время на прохождение: <?= $test_a->test->time_limit ? $test_a->test->time_limit : 'неогр. кол-во' ?> сек.
                </div>
                <div class="attempt-linit">
                    Попыток: <?= $test_a->test->attempt_limit ? $test_a->test->attempt_limit : 'неогр.' ?>
                </div>
                <div class="actions">
                    <a href="<?= Url::to(['/test/update', 'id' => $test_a->test->id]) ?>">
                        <button class="btn btn-primary">Редактировать</button>
                    </a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <?php else: ?>
        <h1 class="text-secondary mt-3">Нету прикрепленных к вам тестов</h1>
    <?php endif; ?>
</div>
