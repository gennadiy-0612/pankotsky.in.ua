<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html id="root" lang="<?= Yii::$app->language = 'ru-RU'?>">
    <head id="head">
        <link rel="shortcut icon" href="http://pankotsky.in.ua/advanced/frontend/web/favicon.ico">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta charset="<?= Yii::$app->charset ?>"/>
        <?= Html::csrfMetaTags() ?>
        <meta name="keywords" content="<?php echo Html::encode($this->title) ?>">
        <meta name="description" content="<?php echo Html::encode($this->title) ?>">
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body id="body">
    <?= $content; $this->endBody() ?>
    <ol class="main-menu-left-center">
        <li class="main-menu-li"><a class="main-menu-li-a" href="/">Главная</a></li>
        <li class="main-menu-li"><a class="main-menu-li-a" href="/1/1">Одежда</a></li>
        <!--<li class="main-menu-li"><a class="main-menu-li-a" href="/2/1">Верхняя одежда</a></li>
        <li class="main-menu-li"><a class="main-menu-li-a" href="/3/1">Детское белье</a></li>
        <li class="main-menu-li"><a class="main-menu-li-a" href="/4/1">Обувь</a></li>-->
    </ol>
    <ol class="main-menu-right-center">
        <li class="main-menu-li"><a class="main-menu-li-a" href="/11/1">Книги</a></li>
        <li class="main-menu-li"><a class="main-menu-li-a" href="/">О нас</a></li>
    </ol>
    <ol class="top-right-menu">
        <li class="top-right-li"><a class="top-right-li-a" href="/pages/map">Карта сайта</a></li>
        <li class="top-right-li"><a class="top-right-li-a" href="/site/contact">Связь</a></li>
    </ol>
    <form id="main-form" method="post" action="/finder/index">
        <input class="main-input" name="text" placeholder="Искать текст" pattern=".{3,30}" title="Введите минимум 3 символа">
        <input id="send" class="main-input" type="submit" value="Найти">
        <input type="hidden" name="_csrf" value="<?php echo Yii::$app->request->csrfToken; ?>">
    </form>
    <p id="info">Пан Коцький</p>
    <?= Breadcrumbs::widget([
        'homeLink'=>false,
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]); ?>
    <p class="foot">Вещи для детей</p>
    </body>
    </html>
<?php $this->endPage() ?>