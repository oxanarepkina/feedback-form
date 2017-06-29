<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\bootstrap\ActiveForm;
use demogorgorn\ajax\AjaxSubmitButton;

$this->title = 'Feedback Form';
$this->params['breadcrumbs'][] = $this->title;
?>
<h3 class="message"></h3>
<?php $form = ActiveForm::begin(['id' => 'feedback-form']); ?>

<?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

<?= $form->field($model, 'email') ?>

<?= $form->field($model, 'phone') ?>

<?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

<?= $form->field($model, 'hidden')->hiddenInput()->label(false);?>


<?php AjaxSubmitButton::begin([
    'label' => 'Check',
    'useWithActiveForm' => 'feedback-form',
    'ajaxOptions' => [
        'type' => 'POST',
        'url' => \yii\helpers\Url::to(['/site/save']),
        'success' => new \yii\web\JsExpression('function(html){
            if(html == "success") {
                $(".message").text("Your message has been sent!");
                $(".message").css("color", "green");
                $("#feedback-form")[0].reset();
            }
            else {
                $(".message").text("Something went wrong. Try to send form again!");
                $(".message").css("color", "red");
                console.log("error");
            }   
            }'),
    ],
    'options' => ['class' => 'btn btn-primary', 'type' => 'submit'],
]);
AjaxSubmitButton::end();
?>


<?php ActiveForm::end(); ?>
