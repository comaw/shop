<?php


namespace common\models;

use yii\helpers\ArrayHelper;

class Subscriber extends  \common\models\base\Subscriber
{
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
    }

    public function behaviors()
    {
        return [
            'status' => [
                'class' => 'common\behaviors\StatusBehaviors',
                'attribute' => 'status',
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['email', 'ip'], 'filter', 'filter' => 'strip_tags'],
            [['email', 'ip'], 'filter', 'filter' => 'trim'],

        ]);
    }
}