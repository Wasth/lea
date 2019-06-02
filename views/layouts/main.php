<?php

/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">

    <?php
    NavBar::begin(['brandLabel' => 'Lea', 'options' => [
        'class' => ['navbar-dark bg-info', 'navbar-expand-md']
    ]]);
    $items = [
        [
            'label' => 'Главная',
            'url' => ['/site/index'],
        ],
    ];
    if (Yii::$app->user->isGuest) {
        $items[] = [
            'label' => 'Вход',
            'url' => ['/auth/signin'],
        ];
        $items[] = [
            'label' => 'Регистрация',
            'url' => ['/auth/signup'],
        ];
    }else {
        $items[] = [
            'label' => 'Мой профиль',
            'url' => ['/site/profile'],
        ];
        $items[] = [
            'label' => 'Выход',
            'url' => ['/auth/logout'],
        ];
        if(Yii::$app->user->identity->role == 'admin') {
            $items[] = [
                'label' => 'Админ-панель',
                'url' => ['/admin/'],
            ];
        }
    }
    echo Nav::widget([
        'items' => $items,
        'options' => ['class' => 'navbar-nav ml-auto'],
    ]);
    NavBar::end(); ?>
    <div class="container">
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">Copyright &copy; Lea Diploma <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
