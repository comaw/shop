<?php

namespace common\models;

use yii\helpers\ArrayHelper;
use Yii;

class Characteristic extends \common\models\base\Characteristic
{
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
    }

    public function beforeValidate()
    {
        return parent::beforeValidate();
    }

    public function behaviors()
    {
        return [
            'classify' => [
                'class' => 'common\behaviors\Classify',
                'attribute' => 'classify',
            ]
        ];
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['name', 'units', 'specification'], 'filter', 'filter' => 'strip_tags'],
            [['name', 'units', 'specification'], 'filter', 'filter' => 'trim'],
            [['name', 'language'], 'unique', 'targetAttribute' => ['name', 'language'], 'message' => Yii::t('app', 'The combination of Language and Name has already been taken.')],

        ]);
    }
}