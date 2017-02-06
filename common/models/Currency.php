<?php

namespace common\models;

use yii\helpers\ArrayHelper;
use Yii;

class Currency extends \common\models\base\Currency
{
    public function beforeValidate()
    {
        if($this->course){
            $this->course = str_replace([',', ' '], ['.', ''], $this->course);
        }
        return parent::beforeValidate();
    }

    public function afterSave($insert, $changedAttributes)
    {
        self::updateAll(['course' => $this->course], ['=', 'classify', $this->classify]);
        parent::afterSave($insert, $changedAttributes);
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
            [['name', 'code'], 'filter', 'filter' => 'strip_tags'],
            [['name', 'code'], 'filter', 'filter' => 'trim'],
            [['language', 'name'], 'unique', 'targetAttribute' => ['language', 'name'], 'message' => Yii::t('app', 'The combination of Language and Name has already been taken.')],

        ]);
    }
}