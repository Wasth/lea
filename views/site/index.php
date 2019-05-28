<?php

use yii\helpers\Url;

?>
<div class="jumbotron">
    <h1 class="display-4">Lea - изучай английский и проверяй знания!</h1>
    <p class="lead">Наша цель - качественное изучение английского языка с дополнительной проверкой знаний и справок по
        теории</p>
    <hr class="my-4">

    <p class="lead">
        <?php if (Yii::$app->user->isGuest): ?>
            <a class="btn btn-primary btn-lg" href="<?= Url::to(['auth/signup']) ?>" role="button">Создать аккаунт</a>
            <a class="btn btn-primary btn-lg" href="<?= Url::to(['auth/signin']) ?>" role="button">Войти в аккаунт</a>
        <?php else: ?>
            <a class="btn btn-primary btn-lg" href="" role="button">Пройти тест</a>
        <?php endif; ?>
    </p>
</div>
<div class="row">
    <div class="col-md-4 col-xs-12">
        <h3>Теория</h3>
        <p>Теоритическая справка упрощена и написана понятным языком для улучшенного восприятия людей любых возрастов</p>
    </div>
    <div class="col-md-4 col-xs-12">
        <h3>Практика</h3>
        <p>Тесты и задания с теоритической справкой дают необходимую практику в изучении английского. Вы можете отслеживать свои результаты</p>
    </div>
    <div class="col-md-4 col-xs-12">
        <h3>Рекорды</h3>
        <p>Посоревнуйтесь с другими участниками в прохождении тестов, в знании теории и др. Соревновательный элемент подстегнёт вас к большему интересу!</p>
    </div>
</div>