<?php
/**
 * Created by PhpStorm.
 * User: WSR-666
 * Date: 06.06.2019
 * Time: 10:00
 */

namespace app\controllers;


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
        foreach($test_access as $item){
            $ids[] = $item->user_id;
        }
        $teachers = User::find()->where(['role' => 'teacher'])->andWhere(['<>', 'id', Yii::$app->user->id])->andWhere(['not in', 'id', $ids])->all();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $model->save();
                return $this->redirect('/test/created-by-me');
            }
        }

        return $this->render('update', [
            'model' => $model,
            'teachers' => $teachers,
        ]);
    }

    public function actionAttach($id, $user) {
        $test = Test::findOne($id);
        $test->attachTeacher($user);
        return $this->redirect(['/test/update', 'id' => $test->id]);
    }

    public function actionDelete($id){
        $test = Test::find()->where(['id' => $id])->one();
        $test->delete();
        return $this->redirect('/test/created-by-me');
    }
}