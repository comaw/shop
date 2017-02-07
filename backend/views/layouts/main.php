<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => Yii::t('app', 'Home'), 'url' => ['/site/index']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => Yii::t('app', 'Login'), 'url' => ['/site/login']];
    } else {
        $menuItems[] = ['label' => Yii::t('app', 'Users'), 'items' => [
            ['label' => Yii::t('app', 'Users'), 'url' => ['/user/index']],
            ['label' => Yii::t('app', 'Subscribers'), 'url' => ['/subscriber/index']],
        ]];
        $menuItems[] = ['label' => Yii::t('app', 'Items'), 'items' => [
            ['label' => Yii::t('app', 'Items'), 'url' => ['/item/index']],
            ['label' => Yii::t('app', 'Manufacturers'), 'url' => ['/manufacturer/index']],
            ['label' => Yii::t('app', 'Tags'), 'url' => ['/tag/index']],
        ]];
        $menuItems[] = ['label' => Yii::t('app', 'Blog'), 'url' => ['/blog/index']];
        $menuItems[] = ['label' => Yii::t('app', 'Дополнительно'), 'items' => [
            ['label' => Yii::t('app', 'Pages'), 'url' => ['/page/index']],
            ['label' => Yii::t('app', 'Currencies'), 'url' => ['/currency/index']],
            ['label' => Yii::t('app', 'Countries'), 'url' => ['/country/index']],
            ['label' => Yii::t('app', 'Languages'), 'url' => ['/language/index']],
            ['label' => Yii::t('app', 'FAQ'), 'url' => ['/faq/index']],
        ]];
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                Yii::t('app', 'Logout ({user})', ['user' => Yii::$app->user->identity->username]),
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?=Yii::$app->name?> <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
