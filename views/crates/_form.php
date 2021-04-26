<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\SwitchInput


/* @var $this yii\web\View */
/* @var $model app\models\Crates */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="crates-form">
    <br><br>
    <?php $form = ActiveForm::begin(); ?>

    <?php $form->field($model, 'id_company') ?>

    <?= $form->field($model, 'active')->widget(SwitchInput::classname(), ([
            'name' => 'Status',
            'pluginOptions' => [
                'size' => 'medium',
                'onColor' => 'success',
                'offColor' => 'danger',
            ]
        ])) 
    ?>


    <?= $form->field($model, 'content')->dropDownList([ 'apple' => 'Apple', 'pear' => 'Pear', 'grape' => 'Grape', ], ['prompt' => '']) ?>
    <br>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
