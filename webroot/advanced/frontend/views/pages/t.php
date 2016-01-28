<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = "Стильные вещи из джинсовой ткани";

//echo $pagination->getLinks( $absolute = false )["self"];
?>
        <?php foreach ($pages as $page): ?>
           <h1><?= $this->title=$page->title; $page->title ?></h1>
                <?= $page->text ?>
        <?php endforeach; ?>

<?= LinkPager::widget(['pagination' => $pagination]) ?>