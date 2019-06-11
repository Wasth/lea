<?php
/**
 * Created by PhpStorm.
 * User: WSR-666
 * Date: 06.06.2019
 * Time: 10:00
 */

namespace app\controllers;


use app\models\Answer;
use app\models\Question;
use app\models\Test;
use app\models\TestAccess;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class TestController extends Controller
{

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'rules' => [
                [
//                    'actions' => ['create', 'created-by-me', 'attached-to-me', 'update', 'delete'],
                    'allow' => true,
                    'matchCallback' => function ($rule, $action) {
                        $role = \Yii::$app->user->identity->role;
                        return $role == 'teacher' || $role == 'admin';
                    }
                ]
            ]
        ];

        return $behaviors;
    }

    public function actionCreate()
    {
        $model = new Test();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $model->save();
                return $this->redirect('/test/created-by-me');
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionCreatedByMe()
    {
        $tests = Test::find()->where(['user_id' => Yii::$app->user->id])->all();

        return $this->render('created-by-me', [
            'tests' => $tests
        ]);
    }

    public function actionAttachedToMe()
    {
        $tests_access = TestAccess::find()->where(['user_id' => Yii::$app->user->id])->all();

        return $this->render('attached-to-me', [
            'tests_access' => $tests_access
        ]);
    }

    public function actionUpdate($id)
    {
        $model = Test::findOne($id);
        $test_access = TestAccess::find()->where(['test_id' => $id])->all();
        $ids = [];
        foreach ($test_access as $item) {
            $ids[] = $item->user_id;
        }
        $teachers = User::find()->where(['role' => 'teacher'])->andWhere(['<>', 'id', Yii::$app->user->id])->andWhere(['not in', 'id', $ids])->all();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $model->save();
            }
        }

        return $this->render('update', [
            'model' => $model,
            'teachers' => $teachers,
            'questions' => $model->questions
        ]);
    }

    public function actionAttach($id, $user)
    {
        $test = Test::findOne($id);
        $test->attachTeacher($user);
        return $this->redirect(['/test/update', 'id' => $test->id]);
    }

    public function actionAddQuestion($id)
    {
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $question = new Question();
            $question->test_id = $id;
            $question->theory_id = $post['question-theory'];
            $question->text = $post['question-text'];
            $question->question_score = $post['question-score'];
            $question->save(false);
            $answer = new Answer();
            $answer->question_id = $question->id;
            $answer->type = $post['answer-type'];
            $answer->text = $post['answer-text'];
            $answer->right_answer = $post['answer-right'];
            $answer->save(false);
            return $this->redirect(['/test/update', 'id' => $id]);
        }
        return $this->render('add-questions', [
            'test_id' => $id,
        ]);
    }

    public function actionDelete($id)
    {
        $test = Test::find()->where(['id' => $id])->one();
        $test->delete();
        return $this->redirect('/test/created-by-me');
    }

    public function actionDeleteQuestion($id)
    {
        $question = Question::find()->where(['id' => $id])->one();
        $test_id = $question->test_id;
        $answer = Answer::find()->where(['question_id' => $question->id])->one();
        $answer->delete();
        $question->delete();
        return $this->redirect(['/test/update', 'id' => $test_id]);
    }
}