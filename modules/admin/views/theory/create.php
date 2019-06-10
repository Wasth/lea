<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Theory */

$this->title = 'Create Theory';
$this->params['breadcrumbs'][] = ['label' => 'Theories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="theory-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
