<?php


namespace common\models;

use yii\helpers\ArrayHelper;
use Yii;

class Country extends \common\models\base\Country
{
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

    public function afterSave($insert, $changedAttributes)
    {
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
}