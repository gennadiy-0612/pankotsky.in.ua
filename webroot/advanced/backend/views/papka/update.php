<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Papka */

$this->title = 'Update Papka: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Papkas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="papka-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
