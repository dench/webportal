<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\assets\FontAwesomeAsset;

AppAsset::register($this);
FontAwesomeAsset::register($this);
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
        'id' => 'top',
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'brandOptions' => [
            'class' => 'visible-xs visible-sm'
        ],
        'options' => [
            'class' => 'navbar-inverse navbar-static-top',
        ],
    ]);

    $mainItems = [
        ['label' => '<i class="fa fa-briefcase"></i> ' . Yii::t('app', 'Компании'), 'url' => '#', 'options' => ['class' => 'menu-xs']],
        ['label' => '<i class="fa fa-th-list"></i> ' . Yii::t('app', 'Товары<span class="menu-md"> и услуги</span>'), 'url' => '#', 'options' => ['class' => 'menu-xs']],
        ['label' => '<i class="fa fa-file-text"></i> ' . Yii::t('app', 'Статьи'), 'url' => '#', 'options' => ['class' => 'menu-xs']],
        ['label' => '<i class="fa fa-newspaper-o"></i> ' . Yii::t('app', 'Новости'), 'url' => '#', 'options' => ['class' => 'menu-xs']],
        ['label' => '<i class="fa fa-star"></i> ' . Yii::t('app', 'Рейтинг<span class="menu-lg"> сайтов</span>'), 'url' => '#', 'options' => ['class' => 'menu-xs']],
        ['label' => '<i class="fa fa-pencil-square-o"></i> ' . Yii::t('app', 'Блоги'), 'url' => '#', 'options' => ['class' => 'menu-xs hidden-sm']],
        ['label' => '<i class="fa fa-comments"></i> ' . Yii::t('app', 'Форум'), 'url' => '#', 'options' => ['class' => 'menu-xs']],
    ];

    $menuItems[] = ['label' => false, 'url' => false, 'options' => ['class' => 'navbar-divider']];

    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => '<i class="fa fa-sign-in"></i> ' . Yii::t('app', 'Войти'), 'url' => ['/user/default/login']];
        $menuItems[] = ['label' => '<i class="fa fa-user"></i> ' . Yii::t('app', 'Регистрация'), 'url' => ['/user/default/signup']];
    } else {
        $menuItems[] = ['label' => '<i class="fa fa-cogs"></i> ' . Yii::t('app', 'Панель управления'), 'url' => ['/admin/default/index']];
        $menuItems[] = '<li>'
            . Html::beginForm(['/user/default/logout'], 'post')
            . Html::submitButton(
                '<i class="fa fa-sign-out"></i> ' . Yii::t('app', 'Выйти'),
                ['class' => 'btn btn-link']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'encodeLabels' => false,
        'items' => array_merge($mainItems, $menuItems),
    ]);
    NavBar::end();
    ?>

    <div id="header" class="hidden-xs">
        <div class="container">

            <div id="vse">
                <a href="#" target="_blank"><i class="fa fa-users"></i> Найти строителей</a>
                <a href="#" target="_blank"><i class="fa fa-cubes"></i> Найти материалы</a>
            </div>

            <?= Html::a(Html::img('/img/local/stroimdom.png',
                ['alt' => Yii::$app->name]), Url::to(['/main/default/index']), ['id' => 'logo']) ?>

            <div id="tbnr">

            </div>
        </div>
    </div>

    <?php
    NavBar::begin([
        'id' => 'menu',
        'options' => [
            'class' => 'navbar-main navbar-static-top hidden-xs',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'encodeLabels' => false,
        'items' =>$mainItems,
    ]);
    NavBar::end();
    ?>

    <div id="main">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
