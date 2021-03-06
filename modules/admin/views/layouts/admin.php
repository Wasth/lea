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
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">

    <?php
    NavBar::begin(['brandLabel' => 'Lea - admin panel', 'options' => [
        'class' => ['navbar-dark bg-dark', 'navbar-expand-md']
    ]]);
    $items = [
        [
            'label' => 'Главная',
            'url' => ['/admin/'],
        ],
        [
            'label' => 'Пометить как преподавателя',
            'url' => ['/admin/default/set-teacher'],
        ],
        [
            'label' => 'Управление теорией',
            'url' => ['/admin/theory/'],
        ],
        [
            'label' => 'Вернуться на сайт',
            'url' => ['/site/'],
        ],
    ];
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
