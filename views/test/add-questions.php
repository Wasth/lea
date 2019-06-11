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
        <input type="text" class="form-control" v-model="questionText">
    </p>
    <p>
        <label for="">Баллы за вопрос</label>
        <input type="text" class="form-control" v-model="questionScore">
    </p>
    <p>
        <label for="">Выберите тему</label>
        <?= Html::dropDownList('theory', null, ArrayHelper::map(Theory::find()->all(), 'id', 'title'), ['class' => 'form-control', 'v-model'=>'questionTheory']) ?>
    </p>
    <p>
        <label for="">Тип ответа</label>
        <?= Html::dropDownList('theory', null, [
            '0' => 'Точный ответ',
            '1' => 'Варианты ответа',
        ], ['class' => 'form-control', 'v-model' => 'answerType']) ?>
    </p>
    <div>
        <div v-if="answerType == 0">
            Введите правильный ответ
            <input type="text" class="form-control" v-model="answerRight">
        </div>
        <div v-if="answerType == 1">
            Введите правильный ответ
            <input type="text" class="form-control" v-model="answerRight">
            Введите остальные варианты ответа
            <input type="text" class="form-control" v-model="types.type1.other1">
            <input type="text" class="form-control mt-2" v-model="types.type1.other2">
            <input type="text" class="form-control mt-2" v-model="types.type1.other3">
        </div>
    </div>
    <button @click="tryToAdd" class="btn btn-success mt-3">Добавить</button>
    <form id="#form" action="<?= Url::to(['/test/add-question', 'id' => $id]) ?>" method="post" class="d-none">
        <?= Html::csrfMetaTags() ?>
        <input type="text" name="answer-type" v-model="answerType">
        <input type="text" name="answer-text" v-model="text">
        <input type="text" name="answer-right" v-model="answerRight">
        <input type="text" name="question-text" v-model="questionText">
        <input type="text" name="question-theory" v-model="questionTheory">
        <input type="text" name="question-score" v-model="questionScore">
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/vue"></script>
<script>
    let addApp = new Vue({
        el: '#addQuestion',
        data: {
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
            answerType: null,
            answerRight: '',
            questionText: '',
            questionTheory: '',
            questionScore: '',

            answerText: '',
        },
        computed: {
            text() {

                if(this.answerType == '0'){
                    return 'hint';
                }else if(this.answerType == '1') {
                    let ready = '';

                    ready = this.types.type1.other1+this.types.type1.other2+this.types.type1.other3;

                    return ready;
                }

                return null;

            }
        },
        methods: {
            tryToAdd() {
                this.errorText = '';
                this.answerText = this.text;

                if(this.answerType !== null && this.answerRight && this.answerText && this.questionText && this.questionTheory && this.questionScore){
                    let form = document.querySelector('#form');
                    form.submit();
                }else {
                    this.errorText = 'Не заполнены все поля';
                }

            }
        }
    });
</script>