<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AlertsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Alerts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alerts-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <br><br>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'layout'=> "{items}\n{summary}\n{pager}",
        //'filterModel' => $searchModel,
        'rowOptions' => function ($model) {
            if ($model->severity == 'HIGH') {
                return ['class' => 'danger'];
            }
            if ($model->severity == 'MEDIUM') {
                return ['class' => 'warning'];
            }
            if ($model->severity == 'LOW') {
                return ['class' => 'success'];
            }
        },
        'columns' => [

            'id',
            'severity',
            'domain',
            'note:ntext',
            'date',

            //['class' => 'yii\grid\ActionColumn'],
            [
                'format'=>'raw',
                'attribute' => 'Actions',
                'headerOptions' => ['style' => 'width:25%'],
                'value' => function($data){
                return
                    Html::a('<span class="glyphicon glyphicon-eye-open"></span> View', ['view','id'=>$data->id_values], ['title' => 'view','class'=>'btn btn-success']).' '.
                    Html::a('<span class="glyphicon glyphicon-pencil"></span> Update', ['update','id'=>$data->id], ['title' => 'edit','class'=>'btn btn-info']).' '.
                    Html::a('<span class="glyphicon glyphicon-trash"></span> Delete', ['delete', 'id' => $data->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]);
                }
            ],
        ],   
    ]); ?>

    <?php Pjax::end(); ?>

</div>
