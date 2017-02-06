<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "{{%blog}}".
 *
 * @property string $id
 * @property string $classify
 * @property string $language
 * @property string $name
 * @property string $url
 * @property string $title
 * @property string $description
 * @property string $preview
 * @property string $text
 * @property string $status
 * @property string $created
 * @property string $update_at
 *
 * @property Language $language0
 */
class Blog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%blog}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['language', 'name', 'url', 'preview', 'text'], 'required'],
            [['language'], 'integer'],
            [['preview', 'text', 'status'], 'string'],
            [['created', 'update_at'], 'safe'],
            [['classify', 'name', 'url', 'title', 'description'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['url', 'language'], 'unique', 'targetAttribute' => ['url', 'language'], 'message' => 'The combination of Language and Url has already been taken.'],
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
            'preview' => Yii::t('app', 'Preview'),
            'text' => Yii::t('app', 'Text'),
            'status' => Yii::t('app', 'Status'),
            'created' => Yii::t('app', 'Created'),
            'update_at' => Yii::t('app', 'Update At'),
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
