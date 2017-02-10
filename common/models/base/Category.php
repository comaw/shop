<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "{{%category}}".
 *
 * @property string $id
 * @property string $parent
 * @property string $classify
 * @property string $language
 * @property string $name
 * @property string $url
 * @property string $title
 * @property string $description
 * @property string $texttop
 * @property string $text
 * @property string $status
 * @property string $img
 * @property string $created
 *
 * @property Category $parent0
 * @property Category[] $categories
 * @property Language $language0
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent', 'language'], 'integer'],
            [['language', 'name', 'url'], 'required'],
            [['texttop', 'text', 'status'], 'string'],
            [['created'], 'safe'],
            [['classify', 'name', 'url', 'title', 'description', 'img'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['language', 'url'], 'unique', 'targetAttribute' => ['language', 'url'], 'message' => 'The combination of Language and Url has already been taken.'],
            [['parent'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['parent' => 'id']],
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
            'parent' => Yii::t('app', 'Parent'),
            'classify' => Yii::t('app', 'Classify'),
            'language' => Yii::t('app', 'Language'),
            'name' => Yii::t('app', 'Name'),
            'url' => Yii::t('app', 'Url'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'texttop' => Yii::t('app', 'Texttop'),
            'text' => Yii::t('app', 'Text'),
            'status' => Yii::t('app', 'Status'),
            'img' => Yii::t('app', 'Img'),
            'created' => Yii::t('app', 'Created'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent0()
    {
        return $this->hasOne(Category::className(), ['id' => 'parent']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['parent' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage0()
    {
        return $this->hasOne(Language::className(), ['id' => 'language']);
    }
}
