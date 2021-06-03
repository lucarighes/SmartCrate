# Visualize widget for Yii2 Framework

The extension uses visualize.jQuery.js and makes charts from php array of structure defined.

[Visualize widget PHP Array generator](http://yii2.kadastrcard.ru/visualize).

![Visualize widget](http://yii2.kadastrcard.ru/uploads/visualize.jpg)

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run:

```bash
composer require slavkovrn/yii2-visualize
```

or add

```bash
"slavkovrn/yii2-visualize": "*"
```

to the require section of your `composer.json` file.

Usage
-----

Set link to extension in your view:

```php
<?php

use slavkovrn\visualize\VisualizeWidget;

?>

<?= VisualizeWidget::widget([
    'id' => 'graphic',      // Id of visualize widget should be unique at page
    'class' => 'graphic',   // Class to define stile
    'name' => 'Visualize',  // Name of visualize widget
    'style' => 'light',     // Style of widget (only 'dark' or 'light' option)
    'width' => 800,         // Width of widget in pixels
    'height' => 200,        // Height of widget in pixels
    'graphic' => [          // data of chart of structure defined
        'SIN' => [
                    number_format(0,5) => sin(0),
                    number_format(Pi()/4,5) => sin(Pi()/4),
                    number_format(Pi()/2,5) => sin(Pi()/2),
                    number_format(Pi()/2+Pi()/4,5) => sin(Pi()/2+Pi()/4),
                    number_format(Pi(),5) => sin(Pi()),
                    number_format(Pi()+Pi()/4,5) => sin(Pi()+Pi()/4),
                    number_format(Pi()+Pi()/2,5) => sin(Pi()+Pi()/2),
                    number_format(Pi()+Pi()/2+Pi()/4,5) => sin(Pi()+Pi()/2+Pi()/4),
                    number_format(2*Pi(),5) => sin(2*Pi()),
                 ],
        'COS' => [
                    number_format(0,5) => cos(0),
                    number_format(Pi()/4,5) => cos(Pi()/4),
                    number_format(Pi()/2,5) => cos(Pi()/2),
                    number_format(Pi()/2+Pi()/4,5) => cos(Pi()/2+Pi()/4),
                    number_format(Pi(),5) => cos(Pi()),
                    number_format(Pi()+Pi()/4,5) => cos(Pi()+Pi()/4),
                    number_format(Pi()+Pi()/2,5) => cos(Pi()+Pi()/2),
                    number_format(Pi()+Pi()/2+Pi()/4,5) => cos(Pi()+Pi()/2+Pi()/4),
                    number_format(2*Pi(),5) => cos(2*Pi()),
                 ],
    ]
]) ?>
```
<a href="mailto:slavko.chita@gmail.com">write comments to admin</a>
