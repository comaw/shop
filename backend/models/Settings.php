<?php


namespace backend\models;

use yii\helpers\ArrayHelper;

class Settings extends \common\models\Settings
{
    /**
     * @return array
     */
    public static function getDrop(){
        return ArrayHelper::map(self::find()->select(['id', 'name'])->orderBy('id desc')->all(), 'id', 'name');
    }
}