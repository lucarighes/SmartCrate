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

    <h1><?= Html::encode("Crate ID: " . $dataProvider->models[0]->id) ?></h1>
    <br>
    <hr style="border-top: 2px solid #bbb">
    <p>Live data</p>
    <br>
    <div style="width:100%; height:100px;">
        <div style="display:inline-block; float:left; width:10%">
        </div>
        <div style="display:inline-block; float:left; width:25%">
            <?php 
                echo GoogleChart::widget( array('visualization' => 'Gauge', 'packages' => 'gauge',
                'data' => array(
                    array('Label', 'Value'),
                    array('Temperature', $dataProvider->models[0]->temperature),
                ),
                'options' => array(
                    'width' => 700,
                    'height' => 120,
                    'redFrom' => 90,
                    'redTo' => 100,
                    'yellowFrom' => 75,
                    'yellowTo' => 90,
                    'minorTicks' => 5
                )
            ));
            ?>
        </div>
        <div style="display:inline-block; float:left; width:25%">
            <?php 
                echo GoogleChart::widget( array('visualization' => 'Gauge', 'packages' => 'gauge',
                'data' => array(
                    array('Label', 'Value'),
                    array('Humidity', $dataProvider->models[0]->humidity),
                ),
                'options' => array(
                    'width' => 700,
                    'height' => 120,
                    'redFrom' => 90,
                    'redTo' => 100,
                    'yellowFrom' => 75,
                    'yellowTo' => 90,
                    'minorTicks' => 5
                )
            ));
            ?>
        </div>
        <div style="display:inline-block; float:left; width:25%">
            <?php 
                echo GoogleChart::widget( array('visualization' => 'Gauge', 'packages' => 'gauge',
                'data' => array(
                    array('Label', 'Value'),
                    array('Hydrogen', $dataProvider->models[0]->hydrogen),
                ),
                'options' => array(
                    'width' => 700,
                    'height' => 120,
                    'redFrom' => 90,
                    'redTo' => 100,
                    'yellowFrom' => 75,
                    'yellowTo' => 90,
                    'minorTicks' => 5
                )
            ));
            ?>
        </div>
        <div style="display:inline-block; float:left; width:25%">
            <?php 
                echo GoogleChart::widget( array('visualization' => 'Gauge', 'packages' => 'gauge',
                'data' => array(
                    array('Label', 'Value'),
                    array('Oxigen', $dataProvider->models[0]->oxigen),
                ),
                'options' => array(
                    'width' => 700,
                    'height' => 120,
                    'redFrom' => 90,
                    'redTo' => 100,
                    'yellowFrom' => 75,
                    'yellowTo' => 90,
                    'minorTicks' => 5
                )
            ));
            ?>
        </div>
    </div>
    
    <br><br>
    <hr style="border-top: 2px solid #bbb; width:100%">
    <br><br>
    <div style="height=600; width=1000;">
        <div style="display:inline-block; float:center;">
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
                ?>
            </div>
            <div style="display:inline-block; float:right;">
                <?php
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
    </div>
    <br><br>
    <hr style="border-top: 2px solid #bbb; width:100%">
    <br><br>
    
    <div id="map" style="width:100%;height:400px;">

    </div>
    <script type="text/javascript">
        var map;
        var pathCoordinates = Array();
        function initMap() {
            var countryLength
            var mapLayer = document.getElementById("map");
            var centerCoordinates = new google.maps.LatLng(<?= $dataProvider->models[0]->latitude; ?>, <?= $dataProvider->models[0]->longitude; ?>);
            var defaultOptions = {
                center : centerCoordinates,
                zoom : 13
            }
            map = new google.maps.Map(mapLayer, defaultOptions);
            geocoder = new google.maps.Geocoder();
            <?php
                if (! empty($dataProvider->models)) {
            ?>
                countryLength = <?php echo count($dataProvider->models); ?>
                <?php
                    foreach ($dataProvider->models as $model) 
                    {
                    ?>
                
                geocoder.geocode({
                        'address' : '<?php echo "Italy"; ?>'
                    }, function(LocationResult, status) {
                        if (status == google.maps.GeocoderStatus.OK) {
                            var latitude = <?php echo $model->latitude; ?>;
                            var longitude = <?php echo $model->longitude ?>;
                            pathCoordinates.push({
                                lat : latitude,
                                lng : longitude
                            });

                            new google.maps.Marker({
                                position : new google.maps.LatLng(latitude, longitude),
                                map : map,
                                title : '<?php echo "Italy"; ?>'
                            });

                            if (countryLength == pathCoordinates.length) {
                                drawPath();
                            }

                        }
                    });
                <?php
                    }
                }
                ?>
        }
        function drawPath() {
            new google.maps.Polyline({
                path : pathCoordinates,
                geodesic : true,
                strokeColor : '#FF0000',
                strokeOpacity : 1,
                strokeWeight : 4,
                map : map
            });
        }
    </script>
    <script 
        src="https://maps.googleapis.com/maps/api/js?key=<?php echo "AIzaSyB4C7lr94XfmyYqwZvF0H0u8AITKQoLimw"; ?>&callback=initMap">
    </script>
  
  <br><br>
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
</div>
