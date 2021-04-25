<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ValuesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="values-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_crate') ?>

    <?= $form->field($model, 'date') ?>

    <?= $form->field($model, 'temperature') ?>

    <?= $form->field($model, 'humidity') ?>

    <?php // echo $form->field($model, 'hydrogen') ?>

    <?php // echo $form->field($model, 'oxigen') ?>

    <?php // echo $form->field($model, 'latitude') ?>

    <?php // echo $form->field($model, 'longitude') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
