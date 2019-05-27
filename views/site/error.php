<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <h1><?= \Yii::t('app',Html::encode($this->title)) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        Возникла ошибка, когда сервер попытался обработать ваш запрос.
    </p>
    <p>
        Пожалуйста, свяжитесь с нами, если считаете, что это ошибка сервера. Спасибо :3
    </p>

</div>
