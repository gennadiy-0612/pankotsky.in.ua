<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Pages */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="pages-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-group field-pages-status">
        <label for="pages-status" class="control-label">Видно</label>
        <select name="Pages[id_papka]" class="form-control" id="pages-status">
            <option value=""></option>
            <option value="1">Одежда</option>
            <option value="2">Обувь</option>
            <option value="3">Игрушки</option>
        </select>

        <div class="help-block"></div>
    </div>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 16]) ?>

    <?= $form->field($model, 'status')->dropDownList(['0', '1',], ['prompt' => '']) ?>

    <?= $form->field($model, 'author')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
