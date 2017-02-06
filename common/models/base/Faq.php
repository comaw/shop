<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "{{%faq}}".
 *
 * @property string $id
 * @property string $classify
 * @property string $language
 * @property string $question
 * @property string $answer
 * @property string $created
 *
 * @property Language $language0
 */
class Faq extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%faq}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['language', 'question'], 'required'],
            [['language'], 'integer'],
            [['answer'], 'string'],
            [['created'], 'safe'],
            [['classify', 'question'], 'string', 'max' => 255],
            [['question', 'language'], 'unique', 'targetAttribute' => ['question', 'language'], 'message' => 'The combination of Language and Question has already been taken.'],
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
            'question' => Yii::t('app', 'Question'),
            'answer' => Yii::t('app', 'Answer'),
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
