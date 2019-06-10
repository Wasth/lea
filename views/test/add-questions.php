<?php
$this->title = 'Добавить вопрос к тесту';

use app\models\Theory;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url; ?>

<div id="addQuestion" class="container mt-3">
    <h2>Добавить вопрос</h2>
    <h4 class="text-danger" v-show="errorText">{{ errorText }}</h4>
    <p>
        <label for="">Текст вопроса</label>
        <input type="text" class="form-control">
    </p>
    <p>
        <label for="">Баллы за вопрос</label>
        <input type="text" class="form-control">
    </p>
    <p>
        <label for="">Выберите тему</label>
        <?= Html::dropDownList('theory', null, ArrayHelper::map(Theory::find()->all(), 'id', 'title'), ['class' => 'form-control']) ?>
    </p>
    <p>
        <label for="">Тип ответа</label>
        <?= Html::dropDownList('theory', null, [
            '0' => 'Точный ответ',
            '1' => 'Варианты ответа',
        ], ['class' => 'form-control', 'v-model' => 'answerType    ']) ?>
    </p>
    <div>
        <div v-if="answerType == 0">
            Введите правильный ответ
            <input type="text" class="form-control" v-model="types.type0.right">
        </div>
        <div v-if="answerType == 1">
            Введите правильный ответ
            <input type="text" class="form-control" v-model="types.type1.right">
            Введите остальные варианты ответа
            <input type="text" class="form-control" v-model="types.type1.other1">
            <input type="text" class="form-control mt-2" v-model="types.type1.other2">
            <input type="text" class="form-control mt-2" v-model="types.type1.other3">
        </div>
    </div>
    <button class="btn btn-success mt-3">Добавить</button>
    <form action="<?= Url::to(['/test/add-question', 'id' => $id]) ?>" method="post" class="d-none">
        <?= Html::csrfMetaTags() ?>
        <input type="text" name="answer-type">
        <input type="text" name="answer-text">
        <input type="text" name="answer-right">
        <input type="text" name="question-text">
        <input type="text" name="question-theory">
        <input type="text" name="question-score">
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/vue"></script>
<script>
    let addApp = new Vue({
        el: '#addQuestion',
        data: {
            answerType: null,
            errorText: null,
            types: {
                type0: {
                    right: ''
                },
                type1: {
                    right: '',
                    other1: '',
                    other2: '',
                    other3: '',
                }
            },
            // answerType: '',
            answerText: '',
            answerRight: '',
            questionText: '',
            questionTheory: '',
            questionScore: '',
        },
    });
</script>