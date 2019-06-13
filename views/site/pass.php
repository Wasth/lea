<?php
$this->title = 'Прохождение теста';

use yii\helpers\Url; ?>

<div id="testPass" class="container mt-3">
    <div class="question card card-body test-card d-block">
        <h3>{{ raw_data.questions[curQuestion].text }}</h3>
        <div v-if="raw_data.questions[curQuestion][0].type == '0'" class="mb-3">
            <input type="text" v-model="type0answer" class="form-control" placeholder="Введите свой ответ">
        </div>
        <div v-if="raw_data.questions[curQuestion][0].type == '1'">
            <p v-for="option in raw_data.questions[curQuestion][0].options">
                <input type="radio" v-model="type1answer" :value="option" :name="'awd'+raw_data.questions[curQuestion][0].id" :id="option">
                <label :for="option">{{ option }}</label>
            </p>
        </div>
        <button @click="answerToQuestion" class="btn btn-primary">Ответить</button>
    </div>
    <form id="resultForm" action="<?= Url::to(['/site/set-result']) ?>" method="post">
        <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>">
        <input type="hidden" name="data">
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/vue"></script>
<script>
    function shuffle(array) {
        // console.log(array);
        array.sort(() => Math.random() - 0.5);
        // console.log(array);
        return array;
    }

    let testPass = new Vue({
        el: '#testPass',
        data: {
            raw_data: JSON.parse('<?= $data ?>'),
            curQuestion: 0,
            type0answer: '',
            type1answer: '',
            results: {},
            forSending: '',
        },
        watch: {
            results() {
                console.log(this.forSending());
            }
        },
        created() {
            for (let i = 0; i < this.raw_data.questions.length; i++) {
                if (this.raw_data.questions[i][0].type === "1") {
                    this.raw_data.questions[i][0].options = shuffle(this.raw_data.questions[i][0].text.split(';'));
                    this.raw_data.questions[i][0].options.push(this.raw_data.questions[i][0].right_answer);
                    this.raw_data.questions[i][0].options = shuffle(this.raw_data.questions[i][0].options);
                }
            }
            this.results.test_id = this.raw_data.id;
            this.results.start_time = Date.now();
            if (this.raw_data.time_limit) {
                setTimeout(() => {

                    this.results.finish_time = Date.now();
                    alert('Вы не успели!');
                    this.forSending = JSON.stringify(this.results);
                    let input = document.querySelector('input[name="data"]');
                    input.value = this.forSending;
                    let form = document.querySelector('#resultForm');
                    // form.submit();
                }, parseInt(this.raw_data.time_limit) * 1000);
            }
        },
        methods: {
            answerToQuestion() {
                if (this.curQuestion <= this.raw_data.questions.length - 1) {
                    this.results[this.raw_data.questions[this.curQuestion].id] = {};
                    this.results[this.raw_data.questions[this.curQuestion].id].btn_press = Date.now();
                    if (this.raw_data.questions[this.curQuestion][0].type === "1") {
                        this.results[this.raw_data.questions[this.curQuestion].id].answer = this.type1answer;
                    } else {
                        this.results[this.raw_data.questions[this.curQuestion].id].answer = this.type0answer;
                    }
                    this.type0answer = '';
                    this.type1answer = '';

                }
                if (this.curQuestion == this.raw_data.questions.length - 1) {
                    this.results.finish_time = Date.now();
                    this.forSending = JSON.stringify(this.results);
                    let input = document.querySelector('input[name="data"]');
                    input.value = this.forSending;
                    let form = document.querySelector('#resultForm');
                    form.submit();
                }

                if(this.curQuestion < this.raw_data.questions.length - 1){
                    this.curQuestion++;
                }
            }

        }

    });
</script>