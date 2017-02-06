<?php


namespace backend\models;

use yii\db\Expression;
use yii\helpers\ArrayHelper;

class Page extends \common\models\Page
{
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'status' => [
                'class' => 'common\behaviors\StatusBehaviors',
                'attribute' => 'status',
            ],
            'slug' => [
                'class' => 'common\behaviors\SlugBehaviors',
                'in_attribute' => 'name',
                'out_attribute' => 'url',
                'translit' => true
            ]
        ]);
    }

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