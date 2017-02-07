<?php


namespace common\models;

use yii\helpers\ArrayHelper;
use Yii;

class Settings extends \common\models\base\Settings
{
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
    }

    public function beforeValidate()
    {
        return parent::beforeValidate();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['name', 'specification'], 'filter', 'filter' => 'strip_tags'],
            [['name', 'specification', 'value'], 'filter', 'filter' => 'trim'],
        ]);
    }
}