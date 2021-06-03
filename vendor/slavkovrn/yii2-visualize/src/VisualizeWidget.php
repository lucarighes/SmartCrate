<?php

namespace slavkovrn\visualize;

use yii\base\Widget;
use yii\web\JqueryAsset;

class VisualizeWidget extends Widget {
    
    public $id = '';
    public $class='';
    public $name='';
    public $style='';
    public $width=0;
    public $height=0;
    public $graphic = [];

    public function init() {

        parent::init();

    }

    public function run() {

        parent::run();

        $this->registryScript();

        return $this->render('visualize',[
            'id' =>$this->id,
            'class' => $this->class,
            'name' => $this->name,
            'graphic' =>$this->graphic,
        ]);
    }

    protected function registryScript()
    {
        $path = \Yii::$app->getAssetManager()->publish(__DIR__ . '/assets/');

        $this->getView()->registerJsFile(
            $path[1] . '/js/visualize.jQuery.js',
            [
                'position' => \yii\web\View::POS_END,
                'depends'  => ['\yii\web\JqueryAsset'],
            ]
        );

        $this->getView()->registerCssFile($path[1] . '/css/visualize.css');
        $this->getView()->registerCssFile($path[1] . '/css/visualize-'.$this->style.'.css');

        $script = '$(function() {

            if ($("#graphic_table_' . $this->id . ' > table").length)
			    $("#graphic_table_' . $this->id . ' > table")
                    .visualize({type: "line", width: "' . $this->width . 'px", height: "' . $this->height . 'px"})
			        .appendTo("#' . $this->id . '").trigger("visualizeRefresh");

        });
        ';

        $this->getView()->registerJs($script,\yii\web\View::POS_END);
    }

}