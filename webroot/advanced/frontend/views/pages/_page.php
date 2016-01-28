<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

$this->title = $model->title;
?>
    <h2><?= Html::encode($model->title) ?></h2>

<?= HtmlPurifier::process($model->text) ?>