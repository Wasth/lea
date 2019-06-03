<?php
$this->title = 'Lea - вход';

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form ActiveForm */
?>
<div class="container mt-5">
    <div class="auth-signin col-md-6 col-xs-12 mx-auto">
        <h2>Вход в Lea</h2>
        <div class="card card-body">
            <?php $form = ActiveForm::begin(); ?>


            <?= $form->field($model, 'login')->label('Логин') ?>
            <?= $form->field($model, 'password')->passwordInput()->label('Пароль') ?>

            <div class="form-group">
                <?= Html::submitButton('Войти!', ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>


    </div>
</div>
<!-- auth-signin -->
