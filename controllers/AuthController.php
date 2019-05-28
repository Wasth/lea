<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 28.05.2019
 * Time: 1:08
 */

namespace app\controllers;


use app\models\User;
use Yii;
use yii\web\Controller;

class AuthController extends Controller
{
    public function actionSignin(){

        $model = new User();
        $model->scenario = 'signin';

        if($model->load(Yii::$app->request->post()) && $model->signin()) {
            return $this->redirect('/');
        }

        return $this->render('signin', [
                'model' => $model,
        ]);
    }

    public function actionSignup(){
        $model = new User();
        $model->scenario = 'signup';

        if($model->load(Yii::$app->request->post()) && $model->signup()) {
            return $this->redirect('/');
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionLogout(){
        if(!Yii::$app->user->isGuest) {
            Yii::$app->user->logout();
            Yii::$app->session->setFlash('success', 'Вы успешно вышли из аккаунта');
        }
        return $this->redirect('/');
    }
}