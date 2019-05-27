<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 28.05.2019
 * Time: 1:08
 */

namespace app\controllers;


use app\models\User;
use yii\web\Controller;

class AuthController extends Controller
{
    public function actionSignin(){

        $model = new User();
        return $this->render('signin', [
                'model' => $model,
        ]);
    }
}