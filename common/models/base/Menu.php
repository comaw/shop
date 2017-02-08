<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "{{%menu}}".
 *
 * @property string $id
 * @property string $classify
 * @property string $language
 * @property string $type
 * @property string $target
 * @property string $name
 * @property string $url
 * @property string $parent
 * @property string $icon
 *
 * @property Menu $parent0
 * @property Menu[] $menus
 * @property Language $language0
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%menu}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['language', 'type', 'name', 'url'], 'required'],
            [['language', 'parent'], 'integer'],
            [['type', 'target'], 'string'],
            [['classify', 'name', 'url', 'icon'], 'string', 'max' => 255],
            [['name', 'language'], 'unique', 'targetAttribute' => ['name', 'language'], 'message' => 'The combination of Language and Name has already been taken.'],
            [['parent'], 'exist', 'skipOnError' => true, 'targetClass' => Menu::className(), 'targetAttribute' => ['parent' => 'id']],
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
            'type' => Yii::t('app', 'Type'),
            'target' => Yii::t('app', 'Target'),
            'name' => Yii::t('app', 'Name'),
            'url' => Yii::t('app', 'Url'),
            'parent' => Yii::t('app', 'Parent'),
            'icon' => Yii::t('app', 'Icon'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent0()
    {
        return $this->hasOne(Menu::className(), ['id' => 'parent']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenus()
    {
        return $this->hasMany(Menu::className(), ['parent' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage0()
    {
        return $this->hasOne(Language::className(), ['id' => 'language']);
    }
}
