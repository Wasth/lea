<?php
$this->title = 'Результаты теста - '.$data['test_name'];
$responses = [
  'full' => 'Вы восхитительны!',
  'zero' => 'Возможно вам нужно подтянуть знания и попробывать еще!',
  'lessThanHalf' => 'Плохой результат - тоже результат',
  'moreThanHalf' => 'Хорошая работа',
];

use yii\helpers\Url;
?>
<div class="container mt-3">
    <div class="jumbotron">
        <h1 class="display-2"><?= $data['test_name'] ?></h1>
        <p class="display-3"><?= $data['score'] ?>/<?= $data['max_score'] ?></p>
        <hr class="my-4">
        <p class="display-4">
            <?php if($data['score'] == $data['max_score']): ?>
                <?= $responses['full'] ?>
            <?php elseif ($data['score'] == 0): ?>
                <?= $responses['zero'] ?>
            <?php elseif( (int) $data['max_score'] / (int) $data['score'] <= 2): ?>
                <?= $responses['moreThanHalf'] ?>
            <?php elseif((int) $data['max_score'] / (int) $data['score'] > 2): ?>
                <?= $responses['lessThanHalf'] ?>
            <?php endif; ?>
        </p>
        <p class="lead">
            <a class="btn btn-primary btn-lg" href="<?= Url::to(['/site/list']) ?>" role="button">Еще тесты</a>
        </p>
    </div>
</div>
