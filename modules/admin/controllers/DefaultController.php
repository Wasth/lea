<?php

namespace app\modules\admin\controllers;

use app\models\User;
use yii\web\Controller;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionSetTeacher($id = null){

        if($id) {
            $roles = [
                'teacher' => 'user',
                'user' => 'teacher',
            ];
            $user = User::findOne($id);
            $user->role = $roles[$user->role];
            $user->save();
            $this->redirect(['/admin/default/set-teacher']);
        }

        $users = User::find()->where(['<>', 'role', 'admin'])->all();

        return $this->render('set-teacher', [
            'users' => $users,
        ]);
    }
}
