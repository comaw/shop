<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "{{%currency}}".
 *
 * @property string $id
 * @property string $classify
 * @property string $language
 * @property string $name
 * @property string $code
 * @property string $course
 *
 * @property Language $language0
 */
class Currency extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%currency}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['language', 'name', 'code'], 'required'],
            [['language'], 'integer'],
            [['course'], 'number'],
            [['classify', 'name'], 'string', 'max' => 255],
            [['code'], 'string', 'max' => 20],
            [['name'], 'unique'],
            [['language', 'name'], 'unique', 'targetAttribute' => ['language', 'name'], 'message' => 'The combination of Language and Name has already been taken.'],
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
            'code' => Yii::t('app', 'Code'),
            'course' => Yii::t('app', 'Course'),
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
