<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "{{%manufacturer}}".
 *
 * @property string $id
 * @property string $classify
 * @property string $language
 * @property string $name
 * @property string $url
 * @property string $title
 * @property string $description
 * @property string $text
 * @property string $status
 * @property string $img
 * @property string $created
 *
 * @property Language $language0
 */
class Manufacturer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%manufacturer}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['language', 'name', 'url'], 'required'],
            [['language'], 'integer'],
            [['text', 'status'], 'string'],
            [['created'], 'safe'],
            [['classify', 'name', 'url', 'title', 'description', 'img'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['language', 'url'], 'unique', 'targetAttribute' => ['language', 'url'], 'message' => 'The combination of Language and Url has already been taken.'],
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
            'url' => Yii::t('app', 'Url'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'text' => Yii::t('app', 'Text'),
            'status' => Yii::t('app', 'Status'),
            'img' => Yii::t('app', 'Img'),
            'created' => Yii::t('app', 'Created'),
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
