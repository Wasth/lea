<?php
$this->title = 'Добавить вопрос к тесту';

use app\models\Theory;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url; ?>

<div id="addQuestion" class="container mt-3">
    <h2>Добавить вопрос</h2>
    <p>
        <label for="">Текст вопроса</label>
    </p>
    <p>
        <input type="text" class="form-control">
    </p>
    <p>
        <label for="">Баллы за вопрос</label>
    </p>
    <p>
        <input type="text" class="form-control">
    </p>
    <p>
        <label for="">Выберите тему</label>
    </p>
    <p>
        <?= Html::dropDownList('theory', null, ArrayHelper::map(Theory::find()->all(), 'id', 'text')) ?>
    </p>



    <form action="<?= Url::to(['/test/add-question', 'id' => $id]) ?>" method="post" class="d-none">
        <?= Html::csrfMetaTags() ?>

    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/vue"></script>
