<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var app\models\RsvpForm $model
 */
$this->title = 'Sam and Bryan | RSVP';
?>
<div class="contact-page">
    <h1 class='title'>R.S.V.P.</h1>
    <div class='clear'></div>
    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

    <div class="alert alert-success">
        Thank you for contacting us. We will respond to you as soon as possible.
    </div>


    <p>
        Note that if you turn on the Yii debugger, you should be able
        to view the mail message on the mail panel of the debugger.
        <?php if (Yii::$app->mail->useFileTransport): ?>
        Because the application is in development mode, the email is not sent but saved as
        a file under <code><?= Yii::getAlias(Yii::$app->mail->fileTransportPath) ?></code>.
        Please configure the <code>useFileTransport</code> property of the <code>mail</code>
        application component to be false to enable email sending.
        <?php endif; ?>
    </p>

    <?php else: ?>

    <div class="row">
            <?php $form = ActiveForm::begin([
                'id' => 'contact-form', 
                'options' => ['class' => 'form-horizontal'],
                'fieldConfig' => [
                            'template' => "{label}\n<div class=\"col-md-5\">{input}</div>\n<div class=\"col-md-12\">{error}</div>",
                            'labelOptions' => ['class' => 'col-md-7 control-label'],
                ],
            ]); ?>
                <?= $form->field($model, 'names') ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'accepting_count') ?>
                <?= $form->field($model, 'declining_count') ?>
                <?= $form->field($model, 'message')->textArea(['rows' => 6]) ?>
                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-md-5">{image}</div><div class="col-md-6 col-md-offset-1">{input}</div></div>',
                ]) ?>
                <div class="form-group">
                    <div class='col-md-3 col-md-offset-7'>
                        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                    </div>
                </div>
            <?php ActiveForm::end(); ?>
    </div>

    <?php endif; ?>
</div>
