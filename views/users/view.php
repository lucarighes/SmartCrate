<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="users-view">

    <h1><?= Html::encode($model->username) ?></h1>

    <p>
        <?= Html::a('Add crate', ['invoices/create', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout'=> "{items}\n{summary}\n{pager}",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_invoice',
            'date',
            'customer',
            'crate',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'contentOptions' => ['style' => 'width: 8.7%'],
                'template' => '      {view}          {update}           {delete}',
                'buttons'=>[
                    'view'=>function ($url, $model) {
                        $new_url = 'index.php?r=invoices%2Fview&id_invoice='.$model['id_invoice'].'&crate='.$model['crate'];
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $new_url);
                    },
                    'update'=>function ($url, $model) {
                        $new_url = 'index.php?r=invoices%2Fupdate&id_invoice='.$model['id_invoice'].'&crate='.$model['crate'];
                        return Html::a('<span class="glyphicon glyphicon-wrench"></span>', $new_url);
                    },
                    'delete'=>function ($url, $model) {
                        $new_url = 'index.php?r=invoices%2Fdelete&id_invoice='.$model['id_invoice'].'&crate='.$model['crate'];
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $new_url, 
                            ['data' => 
                                ['confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),'method' => 'post',]
                            ]);
                    },
                ]
            ],
        ],
    ]); ?>

</div>
