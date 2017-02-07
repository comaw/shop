<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/jquery-ui.min.css',
        'css/lightbox/css/lightbox.min.css',
        'css/site.css',
    ];
    public $js = [
        'js/lightbox/lightbox.min.js',
        'js/jquery-ui.min.js',
        'js/i18n/datepicker-ru.js',
        'js/admin.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
