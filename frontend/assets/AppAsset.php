<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'http://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900'.
        'lookz/css/style.css',
        'lookz/css/megamenu.css',
        'lookz/css/flexslider.css',
        'lookz/css/style.css',
        'css/site.css',
    ];
    public $js = [
        'lookz/js/megamenu.js',
        'lookz/js/jquery.flexslider.js',
        'lookz/home.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
