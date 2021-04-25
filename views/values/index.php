<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use slavkovrn\visualize\VisualizeWidget;
use scotthuangzl\googlechart\GoogleChart;


/* @var $this yii\web\View */
/* @var $searchModel app\models\ValuesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Values';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="values-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <br><br>

    <?php //Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'layout'=> "{items}\n{summary}\n{pager}",
        'columns' => [
            'id_crate',
            'date',
            'temperature',
            'humidity',
            'hydrogen',
            'oxigen',
            'latitude',
            'longitude',
        ],
    ]); ?>
    <?php //Pjax::end(); ?>
    <br><br>

    <?php
        $temp = array(array('name' => 'temperature', 'data' => array()));
        $hum = array(array('name' => 'humidity', 'data' => array()));

        foreach($dataProvider->models as $model){
            array_push($temp[0]['data'], array($model->date, $model->temperature));
            array_push($hum[0]['data'], array($model->date, $model->humidity));
        }
    
        echo \onmotion\apexcharts\ApexchartsWidget::widget([
            'type' => 'area', // default area
            'height' => '400', // default 350
            'width' => '500', // default 100%
            'chartOptions' => [
                'chart' => [
                    'toolbar' => [
                        'show' => true,
                        'autoSelected' => 'zoom'
                    ],
                ],
                'xaxis' => [
                    'type' => 'datetime',
                    // 'categories' => $categories,
                ],
                'plotOptions' => [
                    'bar' => [
                        'horizontal' => false,
                        'endingShape' => 'rounded'
                    ],
                ],
                'dataLabels' => [
                    'enabled' => false
                ],
                'stroke' => [
                    'show' => true,
                    'colors' => ['transparent']
                ],
                'legend' => [
                    'verticalAlign' => 'bottom',
                    'horizontalAlign' => 'left',
                ],
            ],
            'series' => $temp
        ]);

        echo \onmotion\apexcharts\ApexchartsWidget::widget([
            'type' => 'area', // default area
            'height' => '400', // default 350
            'width' => '500', // default 100%
            'chartOptions' => [
                'chart' => [
                    'toolbar' => [
                        'show' => true,
                        'autoSelected' => 'zoom'
                    ],
                ],
                'xaxis' => [
                    'type' => 'datetime',
                    // 'categories' => $categories,
                ],
                'plotOptions' => [
                    'bar' => [
                        'horizontal' => false,
                        'endingShape' => 'rounded'
                    ],
                ],
                'dataLabels' => [
                    'enabled' => false
                ],
                'stroke' => [
                    'show' => true,
                    'colors' => ['transparent']
                ],
                'legend' => [
                    'verticalAlign' => 'bottom',
                    'horizontalAlign' => 'left',
                ],
            ],
            'series' => $hum
        ]);
    ?>


</div>
