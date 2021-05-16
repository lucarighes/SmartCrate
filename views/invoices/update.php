<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Invoices */

$this->title = 'Update Invoices: ' . $model->id_invoice;
$this->params['breadcrumbs'][] = ['label' => 'Invoices', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_invoice, 'url' => ['view', 'id_invoice' => $model->id_invoice, 'crate' => $model->crate]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="invoices-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
