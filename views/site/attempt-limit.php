<?php
$this->title = 'Превышено кол-во попыток';
use yii\helpers\Url;
?>
<div class="container mt-3">
    <div class="jumbotron">
        <h1 class="display-4">Превышено кол-во попыток прохождение данного теста</h1>
        <hr class="my-4">
        <p class="">
            Попробуйте пройти другой тест
        </p>
        <p class="lead">
            <a class="btn btn-primary btn-lg" href="<?= Url::to(['/site/list']) ?>" role="button">Вернутся к тестам</a>
        </p>
    </div>
</div>
