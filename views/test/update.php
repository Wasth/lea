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
    <h2>Изменить тест</h2>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name') ?>
    <?= $form->field($model, 'time_limit') ?>
    <?= $form->field($model, 'attempt_limit') ?>


    <div class="form-group">
        <?= Html::submitButton('Обновить', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

    <?php if ($model->user_id == Yii::$app->user->id): ?>
        <h2>Прикрепить учителя к данному тесту</h2>
        <?php if($teachers): ?>
            <?php foreach ($teachers as $teacher): ?>
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
        <?php else: ?>
            <h3 class="text-secondary">Нету доступных учителей</h3>
        <?php endif; ?>
    <?php endif; ?>

    <h2>Вопросы <a href="<?= Url::to(['test/add-question', 'id' => $model->id]) ?>" role="button" class="btn btn-success">Добавить</a></h2>
    <?php if($questions): ?>
        <?php foreach($questions as $question): ?>
            <h4><?= $question->text ?></h4>
        <?php endforeach; ?>
    <?php else: ?>
        <h3 class="text-secondary">Вопросов еще нет</h3>
    <?php endif; ?>
</div><!-- test-create -->
