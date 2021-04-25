<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Crates */

$this->title = 'Create Crates';
$this->params['breadcrumbs'][] = ['label' => 'Crates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="crates-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
