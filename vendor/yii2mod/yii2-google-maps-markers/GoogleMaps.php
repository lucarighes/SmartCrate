<?php

namespace yii2mod\google\maps\markers;

use Yii;
use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\View;

/**
 * GoogleMaps displays a set of user addresses as markers on the map.
 *
 * To use GoogleMaps, you need to configure its [[userLocations]] property. For example:
 *
 * ```php
 * echo yii2mod\google\maps\markers\GoogleMaps::widget([
 *     'userLocations' => [
 *           [
 *               'location' => [
 *                   'address' => 'Kharkov',
 *                   'country' => 'Ukraine',
 *               ],
 *               'htmlContent' => '<h1>Kharkov</h1>'
 *           ],
 *           [
 *               'location' => [
 *                   'city' => 'New York',
 *                   'country' => 'Usa',
 *               ],
 *               'htmlContent' => '<h1>New York</h1>'
 *           ],
 *     ]
 * ]);
 * ```
 */
class GoogleMaps extends Widget
{
    /**
     * @var array user locations array
     */
    public $userLocations = [];

    /**
     * @var string main wrapper height
     */
    public $wrapperHeight = '500px';

    /**
     * @var string google maps url
     */
    public $googleMapsUrl = 'https://maps.googleapis.com/maps/api/js?';

    /**
     * libraries - Example: geometry, places. Default - empty string
     * version - 3.exp (Default)
     *
     * @var array google maps url options(v, language, key, libraries)
     */
    public $googleMapsUrlOptions = [];

    /**
     * Google Maps options (mapTypeId, tilt, zoom, etc...)
     *
     * @see https://developers.google.com/maps/documentation/javascript/reference
     *
     * @var array
     */
    public $googleMapsOptions = [];

    /**
     * Example listener for infowindow object:
     *
     * ```php
     * [
     *    [
     *       'object' => 'infowindow',
     *       'event' => 'domready',
     *       'handler' => (new \yii\web\JsExpression('function() {
     *              // your custom js code
     *        }'))
     *    ]
     * ]
     * ```
     *
     * @var array google map listeners
     */
    public $googleMapsListeners = [];

    /**
     * @see https://developers.google.com/maps/documentation/javascript/reference#InfoWindowOptions
     *
     * @var array
     */
    public $infoWindowOptions = [];

    /**
     * @var string google maps container id
     */
    public $containerId = 'map_canvas';

    /**
     * @var bool render empty map, if userLocations is empty. Defaults to 'true'
     */
    public $renderEmptyMap = true;

    /**
     * Json array for yii.googleMapManager with users address and html contents
     *
     * @var array
     */
    protected $geocodeData = [];

    /**
     * Init widget
     */
    public function init()
    {
        parent::init();

        if (is_array($this->userLocations) === false) {
            throw new InvalidConfigException('The "userLocations" property must be of the type array');
        }

        $this->googleMapsOptions = $this->getGoogleMapsOptions();
        $this->infoWindowOptions = $this->getInfoWindowOptions();
        $this->googleMapsUrlOptions = $this->getGoogleMapsUrlOptions();
    }

    /**
     * Executes the widget.
     */
    public function run()
    {
        if (empty($this->userLocations) && $this->renderEmptyMap === false) {
            return;
        }

        $this->geocodeData = $this->getGeoCodeData();

        echo Html::beginTag('div', ['id' => $this->getId(), 'style' => "height: {$this->wrapperHeight}"]);
        echo Html::tag('div', '', ['id' => $this->containerId]);
        echo Html::endTag('div');

        $this->registerAssets();

        parent::run();
    }

    /**
     * Register assets
     */
    protected function registerAssets()
    {
        $view = $this->getView();
        GoogleMapsAsset::register($view);
        $view->registerJsFile($this->getGoogleMapsApiUrl(), ['position' => View::POS_HEAD]);
        $options = $this->getClientOptions();
        $view->registerJs("yii.googleMapManager.initModule({$options})", $view::POS_END, 'google-api-js');
    }

    /**
     * Get place urls and htmlContent
     *
     * @return string
     */
    protected function getGeoCodeData()
    {
        $result = [];
        foreach ($this->userLocations as $data) {
            $result[] = [
                'country' => ArrayHelper::getValue($data['location'], 'country'),
                'address' => implode(',', ArrayHelper::getValue($data, 'location')),
                'htmlContent' => ArrayHelper::getValue($data, 'htmlContent'),
            ];
        }

        return $result;
    }

    /**
     * Get google maps api url
     *
     * @return string
     */
    protected function getGoogleMapsApiUrl()
    {
        return $this->googleMapsUrl . http_build_query($this->googleMapsUrlOptions);
    }

    /**
     * Get google maps url options
     *
     * @return array
     */
    protected function getGoogleMapsUrlOptions()
    {
        if (isset(Yii::$app->params['googleMapsUrlOptions']) && empty($this->googleMapsUrlOptions)) {
            $this->googleMapsUrlOptions = Yii::$app->params['googleMapsUrlOptions'];
        }

        return ArrayHelper::merge([
            'v' => '3.exp',
            'key' => null,
            'libraries' => null,
            'language' => 'en',
        ], $this->googleMapsUrlOptions);
    }

    /**
     * Get google maps options
     *
     * @return array
     */
    protected function getGoogleMapsOptions()
    {
        if (isset(Yii::$app->params['googleMapsOptions']) && empty($this->googleMapsOptions)) {
            $this->googleMapsOptions = Yii::$app->params['googleMapsOptions'];
        }

        return ArrayHelper::merge([
            'mapTypeId' => 'roadmap',
            'tilt' => 45,
            'zoom' => 2,
        ], $this->googleMapsOptions);
    }

    /**
     * Get info window options
     *
     * @return array
     */
    protected function getInfoWindowOptions()
    {
        if (isset(Yii::$app->params['infoWindowOptions']) && empty($this->infoWindowOptions)) {
            $this->infoWindowOptions = Yii::$app->params['infoWindowOptions'];
        }

        return ArrayHelper::merge([
            'content' => '',
            'maxWidth' => 350,
        ], $this->infoWindowOptions);
    }

    /**
     * Get google map client options
     *
     * @return string
     */
    protected function getClientOptions()
    {
        return Json::encode([
            'geocodeData' => $this->geocodeData,
            'mapOptions' => $this->googleMapsOptions,
            'listeners' => $this->googleMapsListeners,
            'containerId' => $this->containerId,
            'renderEmptyMap' => $this->renderEmptyMap,
            'infoWindowOptions' => $this->infoWindowOptions,
        ]);
    }
}
