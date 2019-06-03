<?php

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use simialbi\yii2\date\Datetimepicker;

$this->title = 'Lea - Мой профиль';
?>
<div class="container mt-5">
    <?php if( Yii::$app->session->hasFlash('success') ): ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo Yii::$app->session->getFlash('success'); ?>
        </div>
    <?php endif;?>
    <div class="container card card-body">
        <div class="row profile-view">
            <div class="col-sx-12 col-md-3 text-center">
                <?php if (!$model->avatar): ?>
                    <h5>Ваш аватар</h5>
                    <span class="not-set">(не задано)</span>
                <?php else: ?>
                    <div class="w-100 rounded-circle avatar" style="background-image: url('<?= $model->avatarUrl ?>');"><div></div></div>
                <?php endif; ?>
            </div>
            <div class="col-sx-12 col-md-9">
                <h2><?= $model->first_last_name ?></h2>
                <h4><?= $model->login ?></h4>
                <h4>Дата рождения - <?= Yii::$app->formatter->asDate($model->birthday) ?></h4>
                <button class="btn btn-primary mt-2" id="show-edit">Редактировать профиль</button>
            </div>
        </div>

        <?php $form = ActiveForm::begin(); ?>
        <div class="row profile-edit">
            <div class="col-md-6 col-xs-12">
                <?= $form->field($model, 'first_last_name')->label('Фамилия и Имя') ?>
                <?= $form->field($model, 'birthday')->label('Дата рождения')->widget(Datetimepicker::className(), [
                    'format' => 'dd.MM.yyyy',
                    'type'   => Datetimepicker::TYPE_INPUT
                ]) ?>

            </div>
            <div class="col-md-6 col-xs-12">
                <?= $form->field($model, 'avatarfile')->label('Аватар')->fileInput() ?>
                <?= $form->field($model, 'newpassword')->passwordInput()->label('Пароль') ?>
                <div class="form-group text-right">
                    <button type="button" class="btn btn-danger" id="show-view">Отмена</button>
                    <?= Html::submitButton('Применить', ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>


