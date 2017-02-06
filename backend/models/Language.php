<?php

namespace backend\models;

use yii\helpers\ArrayHelper;

class Language extends \common\models\Language
{

    /**
     * @return array
     */
    public static function getDrop(){
        return ArrayHelper::map(self::find()->orderBy('id')->all(), 'id', 'name');
    }
}