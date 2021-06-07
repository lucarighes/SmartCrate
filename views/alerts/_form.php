<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Alerts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="alerts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_values')->textInput() ?>

    <?= $form->field($model, 'severity')->dropDownList([ 'HIGH' => 'HIGH', 'MEDIUM' => 'MEDIUM', 'LOW' => 'LOW', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'domain')->dropDownList([ 'TEMPERATURE' => 'TEMPERATURE', 'HUMIDITY' => 'HUMIDITY', 'GASES' => 'GASES', 'POSITION' => 'POSITION', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
