<?php
$this->title = 'Lea - регистрация';
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form ActiveForm */
?>
<div class="auth-signin col-md-6 col-xs-12 mx-auto">
    <h2>Создание аккаунта</h2>
    <div class="card card-body">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'first_last_name')->label('Фамилия и Имя') ?>
        <?= $form->field($model, 'login')->label('Логин') ?>
        <?= $form->field($model, 'password')->label('Пароль')->passwordInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Создать профиль!', ['class' => 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>

</div><!-- auth-signup -->
