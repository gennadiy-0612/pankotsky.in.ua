<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = "hhhh";
?>
<?php foreach ($pages as $page): ?>
    <?= $page->text ?>
<?php endforeach; ?>

<?= LinkPager::widget(['pagination' => $pagination]) ?>