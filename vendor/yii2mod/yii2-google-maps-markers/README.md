<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Google Maps Markers Widget for Yii2</h1>
    <br>
</p>

GoogleMaps Widget displays a set of user addresses as markers on the map.

[![Latest Stable Version](https://poser.pugx.org/yii2mod/yii2-google-maps-markers/v/stable)](https://packagist.org/packages/yii2mod/yii2-google-maps-markers)
[![Total Downloads](https://poser.pugx.org/yii2mod/yii2-google-maps-markers/downloads)](https://packagist.org/packages/yii2mod/yii2-google-maps-markers)
[![License](https://poser.pugx.org/yii2mod/yii2-google-maps-markers/license)](https://packagist.org/packages/yii2mod/yii2-google-maps-markers)
[![Build Status](https://travis-ci.org/yii2mod/yii2-google-maps-markers.svg?branch=master)](https://travis-ci.org/yii2mod/yii2-google-maps-markers)

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require yii2mod/yii2-google-maps-markers "*"
```

or add

```
"yii2mod/yii2-google-maps-markers": "*"
```

to the require section of your composer.json.

Usage
-----

To use GoogleMaps, you need to configure its [[userLocations]] property. For example:

```php
echo yii2mod\google\maps\markers\GoogleMaps::widget([
    'userLocations' => [
        [
            'location' => [
                'address' => 'Kharkiv',
                'country' => 'Ukraine',
            ],
            'htmlContent' => '<h1>Kharkiv</h1>',
        ],
        [
            'location' => [
                'city' => 'New York',
                'country' => 'United States',
            ],
            'htmlContent' => '<h1>New York</h1>',
        ],
    ],
]);
```

Configuration
-------------

To configure the Google Maps key or other options like language, version, library, or map options:

```php
echo yii2mod\google\maps\markers\GoogleMaps::widget([
    'userLocations' => [...],
    'googleMapsUrlOptions' => [
        'key' => 'this_is_my_key',
        'language' => 'id',
        'version' => '3.1.18',
    ],
    'googleMapsOptions' => [
        'mapTypeId' => 'roadmap',
        'tilt' => 45,
        'zoom' => 5,
    ],
]);
```

OR via yii params configuration. For example:

```php
'params' => [
    'googleMapsUrlOptions' => [
        'key' => 'this_is_my_key',
        'language' => 'id',
        'version' => '3.1.18',
     ],
    'googleMapsOptions' => [
        'mapTypeId' => 'roadmap',
        'tilt' => 45,
        'zoom' => 10,
    ],
],
```

To get key, please visit [page](https://developers.google.com/maps/documentation/javascript/get-api-key)

Google Maps Options
-------------------

You can find them on the [options page](https://developers.google.com/maps/documentation/javascript/reference)

#### Example
------------

![Alt text](http://res.cloudinary.com/zfort/image/upload/v1441115988/Map_preview_hcwb1x.png "Example")
