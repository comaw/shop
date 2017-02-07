<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "{{%settings}}".
 *
 * @property string $id
 * @property string $name
 * @property string $value
 * @property string $specification
 */
class Settings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%settings}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['value'], 'string'],
            [['name', 'specification'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'value' => Yii::t('app', 'Value'),
            'specification' => Yii::t('app', 'Specification'),
        ];
    }
}
