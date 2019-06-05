<?php
$this->title = 'Lea - изучение английского';
use yii\bootstrap4\Alert;
use yii\helpers\Url;

?>
<style>
    #w0 {
        background-color: transparent !important;
        /*border-bottom: 1px solid rgba(255, 255, 255, 0.34);*/
    }
    .footer {
        display: none;
    }
    .wrap {
        padding-bottom: 0;
    }
    hr {
        border-top: 1px solid rgba(255, 255, 255, 0.34);
    }
</style>
<div class="landing">

    <div class="container text-white">
        <?php if( Yii::$app->session->hasFlash('success') ): ?>
            <div class="alert alert-white alert-dismissible border-secondary" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo Yii::$app->session->getFlash('success'); ?>
            </div>
        <?php endif;?>
        <div class="jumbotron">
            <h1 class="display-4 ">Lea - изучай английский и проверяй знания!</h1>
            <p class="lead">Наша цель - качественное изучение английского языка с дополнительной проверкой знаний и справок по
                теории</p>
            <hr class="my-4">

            <p class="lead">
                <?php if (Yii::$app->user->isGuest): ?>
                    <a class="btn btn-light btn-lg mt-2" href="<?= Url::to(['auth/signup']) ?>" role="button">Создать аккаунт</a>
                    <a class="btn btn-light btn-lg mt-2" href="<?= Url::to(['auth/signin']) ?>" role="button">Войти в аккаунт</a>
                <?php else: ?>
                    <a class="btn btn-light btn-lg" href="" role="button">Пройти тест</a>
                <?php endif; ?>
            </p>
        </div>
        <div class="row">
            <div class="col-md-4 col-xs-12">
                <h3>Теория</h3>
                <p>Теоритическая справка упрощена и написана понятным языком для улучшенного восприятия людей любых
                    возрастов</p>
            </div>
            <div class="col-md-4 col-xs-12">
                <h3>Практика</h3>
                <p>Тесты и задания с теоритической справкой дают необходимую практику в изучении английского. Вы можете
                    отслеживать свои результаты</p>
            </div>
            <div class="col-md-4 col-xs-12">
                <h3>Рекорды</h3>
                <p>Посоревнуйтесь с другими участниками в прохождении тестов, в знании теории и др. Соревновательный элемент
                    подстегнёт вас к большему интересу!</p>
            </div>
        </div>
    </div>
</div>
