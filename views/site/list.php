<?php
/* @var $tests[] app\models\Test
 * @var $test app\models\Test
 * */


$this->title = 'Список тестов';

use yii\helpers\Url; ?>

<div class="container mt-3">
    <h3>Выбирайте тест!</h3>
    <?php foreach($tests as $test): ?>
    <div class="card card-body test-card mt-2 mb-2 d-flex justify-content-between flex-row align-items-center">
        <div>
            <h5><?= $test->name ?></h5>
            <p class="text-secondary mb-0"><?= $test->user->first_last_name ?>, вопросов - <?= count($test->questions) ?>, осталось попыток - <?= $test->getAttemptsLeft() ?></p>
        </div>
        <div>
            <p class="text-right"><a href="<?= Url::to(['site/pass', 'id' => $test->id]) ?>" role="button" class="btn btn-success">Пройти тест</a></p>

                <div class="dropdown">
                    <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Темы теста
                    </button>
                    <div class="dropdown-menu">
                        <?php foreach($test->getTheoryTopics() as $topic): ?>
                        <span class="dropdown-item-text"><?= $topic ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
