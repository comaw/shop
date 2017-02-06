<?php
/**
 *
 */

namespace common\models;

use yii\helpers\ArrayHelper;

class Language extends \common\models\base\Language
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['name', 'code'], 'filter', 'filter' => 'strip_tags'],
            [['name', 'code'], 'filter', 'filter' => 'trim'],

        ]);
    }
}