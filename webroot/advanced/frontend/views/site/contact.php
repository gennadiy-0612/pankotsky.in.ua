<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */
$this->registerCssFile(Yii::$app->request->baseUrl.'/css/contact.css');
$this->title = 'Связяться';
$this->params['breadcrumbs'][] = $this->title;
?>

    <h1><?= Html::encode($this->title) ?> можно по телефону +380997177447</h1>

    <p>Если у вас к нам есть деловые вопросы или предложения, тогда для того чтобы с нами связаться вам необходимо заполнить форму. </p>
<p>Заранее благодарны.</p>
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                <?= $form->field($model, 'name')->label('Имя')?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'subject')->label('От кого') ?>
                <?= $form->field($model, 'body')->textArea(['rows' => 6])->label('Текст') ?>
                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '{image}{input}',
                ]) ?>
                <div class="form-group button-send">
                    <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
