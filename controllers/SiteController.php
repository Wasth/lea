<?php

namespace app\controllers;

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
}
