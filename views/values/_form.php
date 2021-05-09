<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Values */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="values-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_crate')->textInput() ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'temperature')->textInput() ?>

    <?= $form->field($model, 'humidity')->textInput() ?>

    <?= $form->field($model, 'hydrogen')->textInput() ?>

    <?= $form->field($model, 'oxigen')->textInput() ?>

    <?= $form->field($model, 'longitude')->textInput() ?>

    <?= $form->field($model, 'latitude')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
