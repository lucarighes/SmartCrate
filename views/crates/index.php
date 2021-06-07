<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\CratesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Crates';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="crates-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Crates', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'layout'=> "{items}\n{summary}\n{pager}",
        'columns' => [

            'crate ID' => 'id',
            'content',
            'company',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'headerOptions' => ['style' => 'width:18%'],
                'template' => '{view}           {update}',
                'buttons'=>[
                    'view'=>function ($url, $model) {
                        $new_url = 'index.php?r=crates%2Fview&id='.$model['id'];
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span> View', $new_url, ['title' => 'view','class'=>'btn btn-success']);
                    },
                    'update'=>function ($url, $model) {
                        $new_url = 'index.php?r=crates%2Fupdate&id='.$model['id'];
                        return Html::a('<span class="glyphicon glyphicon-wrench"></span> Update', $new_url, ['title' => 'edit','class'=>'btn btn-info']);
                    },
                ]
            ],
        ],
    ]); ?>

    
    <?php Pjax::end(); ?>

</div>
