<?php
/**
 *
 */

namespace backend\models;

use yii\helpers\ArrayHelper;

class Faq extends \common\models\Faq
{
    /**
     * @return array
     */
    public static function getDropClassify(){
        return ArrayHelper::map(self::find()->select(['classify', 'question'])->orderBy('id desc')->all(), 'classify', 'question');
    }

    /**
     * @return array
     */
    public static function getDrop(){
        return ArrayHelper::map(self::find()->select(['id', 'question'])->orderBy('id desc')->all(), 'id', 'question');
    }
}