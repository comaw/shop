<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "{{%tag}}".
 *
 * @property string $id
 * @property string $classify
 * @property string $language
 * @property string $name
 * @property string $url
 * @property string $title
 * @property string $description
 * @property string $texttop
 * @property string $text
 * @property string $status
 * @property string $created
 *
 * @property Language $language0
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tag}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['language', 'name', 'url'], 'required'],
            [['language'], 'integer'],
            [['texttop', 'text', 'status'], 'string'],
            [['created'], 'safe'],
            [['classify', 'name', 'url', 'title', 'description'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['url'], 'unique'],
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
            'texttop' => Yii::t('app', 'Texttop'),
            'text' => Yii::t('app', 'Text'),
            'status' => Yii::t('app', 'Status'),
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
