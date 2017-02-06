<?php


namespace common\models;

use yii\helpers\ArrayHelper;
use Yii;

class Faq extends \common\models\base\Faq
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['question'], 'filter', 'filter' => 'strip_tags'],
            [['answer', 'question'], 'filter', 'filter' => 'trim'],
            [['question', 'language'], 'unique', 'targetAttribute' => ['question', 'language'], 'message' => Yii::t('app', 'The combination of Language and Question has already been taken.')],

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