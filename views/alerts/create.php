<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Alerts */

$this->title = 'Create Alerts';
$this->params['breadcrumbs'][] = ['label' => 'Alerts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alerts-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
