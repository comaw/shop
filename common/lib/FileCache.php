<?php
/**
 * powered by php-shaman
 * FileCache.php 10.12.2016
 * franshiza
 */

namespace common\lib;


class FileCache extends \yii\caching\FileCache
{

    public $redis = null;
}