<?php


namespace backend\models;

use yii\helpers\ArrayHelper;

class Currency extends \common\models\Currency
{
    /**
     * @return array
     */
    public static function getDropClassify(){
        return ArrayHelper::map(self::find()->select(['classify', 'name'])->orderBy('id desc')->all(), 'classify', 'name');
    }

    /**
     * @return array
     */
    public static function getDrop(){
        return ArrayHelper::map(self::find()->select(['id', 'name'])->orderBy('id desc')->all(), 'id', 'name');
    }
}