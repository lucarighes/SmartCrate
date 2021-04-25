<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Crates */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="crates-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php $form->field($model, 'id_company') ?>

    <?= $form->field($model, 'content')->dropDownList([ 'apple' => 'Apple', 'pear' => 'Pear', 'grape' => 'Grape', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
