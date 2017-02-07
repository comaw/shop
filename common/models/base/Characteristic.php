<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "{{%characteristic}}".
 *
 * @property string $id
 * @property string $classify
 * @property string $language
 * @property string $name
 * @property string $units
 * @property string $specification
 *
 * @property Language $language0
 */
class Characteristic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%characteristic}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['language', 'name'], 'required'],
            [['language'], 'integer'],
            [['classify', 'name', 'specification'], 'string', 'max' => 255],
            [['units'], 'string', 'max' => 30],
            [['name', 'language'], 'unique', 'targetAttribute' => ['name', 'language'], 'message' => 'The combination of Language and Name has already been taken.'],
            [['language'], 'exist', 'skipOnError' => true, 'targetClass' => Language::className(), 'targetAttribute' => ['language' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'classify' => Yii::t('app', 'Classify'),
            'language' => Yii::t('app', 'Language'),
            'name' => Yii::t('app', 'Name'),
            'units' => Yii::t('app', 'Units'),
            'specification' => Yii::t('app', 'Specification'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage0()
    {
        return $this->hasOne(Language::className(), ['id' => 'language']);
    }
}
