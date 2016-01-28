<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Papka;

/* @var $this yii\web\View */
/* @var $model backend\models\Pages */
/* @var $form yii\widgets\ActiveForm */
//echo var_dump($m);

$papki = Papka::find()->all();
$namepap = Papka::findOne($model->id_papka);
$p = '';
foreach ($papki as $m) {
    if($m->title){
        $p .= '<option value="'. $m->id . '">' . $m->title . '</option>';
    }
}
?>

<div class="pages-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-group field-pages-status">
        <label for="pages-status" class="control-label">Раздел</label>
        <select name="Pages[id_papka]" class="form-control" id="pages-status">
            <option class="in" value=" <?php echo $namepap['id'] ?>"> <?php echo $namepap['title'] ?></option>

        <?php echo $p ?>

        </select>

        <div class="help-block"></div>
    </div>

    <?= $form->field($model, 'title')->textInput() ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 16]) ?>

    <?= $form->field($model, 'status')->dropDownList([ '0', '1', ]) ?>

    <?= $form->field($model, 'author')->textInput() ?>

    <input type="hidden" name="_csrf" value="<?php echo Yii::$app->request->csrfToken; ?>">

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
