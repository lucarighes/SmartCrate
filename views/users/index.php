<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Users', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'layout'=> "{items}\n{summary}\n{pager}",
        'columns' => [
            'id',
            'username',
            //'password',
            //'id_company',
            //'auth_key',
            //'owner',

            [
                'format'=>'raw',
                'attribute' => 'Actions',
                'headerOptions' => ['style' => 'width:25%'],
                'value' => function($data){
                return
                    Html::a('<span class="glyphicon glyphicon-eye-open"></span> View', ['view','id'=>$data->id], ['title' => 'view','class'=>'btn btn-success']).' '.
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


</div>
