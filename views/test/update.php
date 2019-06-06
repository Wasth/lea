<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Test */
/* @var $form ActiveForm */
$this->title = 'Изменить тест'
?>
<div class="test-create container mt-3">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name') ?>
    <?= $form->field($model, 'time_limit') ?>
    <?= $form->field($model, 'attempt_limit') ?>
    <?= $form->field($model, 'user_id')->hiddenInput(['value' => Yii::$app->user->id])->label(false) ?>


    <div class="form-group">
        <?= Html::submitButton('Обновить', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

    <h2>Прикрепить учителя к данному тесту</h2>

    <?php foreach($teachers as $teacher): ?>
        <div class="card mt-3 card-body test-card">
            <div class="d-flex w-100 justify-content-between align-items-center">
                <div class="name">
                    <?= $teacher->first_last_name ?>
                </div>
                <div class="actions">
                    <a href="<?= Url::to(['/test/attach', 'id' => $model->id, 'user' => $teacher->id]) ?>">
                        <button class="btn btn-primary">Прикрепить</button>
                    </a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

</div><!-- test-create -->
