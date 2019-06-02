<?php

namespace app\modules\admin;

use Yii;
use yii\base\Module;
use yii\filters\AccessControl;

/**
 * admin module definition class
 */
class AdminModule extends Module
{
    public $layout = 'admin';
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\admin\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'rules' => [
                [
                    'allow' => true,
                    'matchCallback' => function ($rule, $action) {
                        return !Yii::$app->user->isGuest && Yii::$app->user->identity->role == 'admin';
                    }
                ],
            ]

        ];

        return $behaviors;
    }
}
