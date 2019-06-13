<?php

namespace app\controllers;

use app\models\Answer;
use app\models\Question;
use app\models\QuestionResult;
use app\models\Test;
use app\models\TestResult;
use app\models\User;
use Yii;
use yii\web\Controller;

class SiteController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionProfile(){
        if(Yii::$app->user->isGuest) {
            return $this->redirect('/');
        }

        $model = Yii::$app->user->identity;
        if($model->load(Yii::$app->request->post())) {
            $model->updateData();

        }

//        $model->reformatDate();
        return $this->render('profile', [
            'model' => $model
        ]);
    }


    public function actionList(){
        $tests = Test::find()->orderBy('id DESC')->all();
        return $this->render('list', [
            'tests' => $tests,
        ]);
    }

    public function actionPass($id) {
        $test = Test::findOne($id);
        $data = $test->toArray();
        $data['questions'] = [];
        foreach(Question::find()->where(['test_id' => $test->id])->all() as $question){
            $data['questions'][] = $question->toArray();
        }
        for($i = 0; $i < count($data['questions']); $i++){
            $data['questions'][$i][] = Answer::find()->where(['question_id' =>  $data['questions'][$i]['id']])->one()->toArray();
        }
//        var_dump($data['questions']);die;
        return $this->render('pass', [
            'data' => json_encode($data),
        ]);
    }

    public function actionSetResult(){
        $data = json_decode(Yii::$app->request->post('data'));
//        var_dump($data->test_id);die;
        $test_result = new TestResult();
        $test_result->user_id = Yii::$app->user->id;
        $test_result->test_id = $data->test_id;
        $test_result->date_time_start = $data->start_time;
        $test_result->date_time_finish = $data->finish_time;
//        var_dump($test_result->date_time_start);die;
        $test_result->save(false);
//        die;
        foreach ($data as $key => $value){
            if(is_numeric($key)){
                $question_result = new QuestionResult();
                $question_result->test_result_id = $test_result->id;
                $question_result->question_id = $key;
                $question_result->bttn_press = $data->$key->btn_press;
                $question_result->answer_right = $data->$key->answer;
                $question_result->save();
            }
        }

    }
}
