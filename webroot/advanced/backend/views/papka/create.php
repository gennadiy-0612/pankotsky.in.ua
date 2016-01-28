<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Papka */

$this->title = 'Create Papka';
$this->params['breadcrumbs'][] = ['label' => 'Papkas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="papka-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
