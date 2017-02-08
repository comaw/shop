<?php

namespace common\models;

use yii\helpers\ArrayHelper;
use Yii;

class Menu extends \common\models\base\Menu
{
    const TYPE_TOP = 'top';
    const TYPE_LEFT = 'left';
    const TYPE_RIGHT = 'right';
    const TYPE_FOOTER = 'footer';

    const TARGET_SELF = '_self';
    const TARGET_BLANK = '_blank';

    public static function listTarget(){
        return [
            self::TARGET_SELF => Yii::t('app', 'Открыть страницу в текущее окно.'),
            self::TARGET_BLANK => Yii::t('app', 'Открыть страницу в новое окно браузера.'),
        ];
    }

    public function getTargetName(){
        return self::listTarget()[$this->target];
    }

    public static function listType(){
        return [
            self::TYPE_TOP => Yii::t('app', 'Верхнее меню'),
            self::TYPE_LEFT => Yii::t('app', 'Левое меню'),
            self::TYPE_RIGHT => Yii::t('app', 'Правое меню'),
            self::TYPE_FOOTER => Yii::t('app', 'Нижнее меню'),
        ];
    }

    public function getTypeName(){
        return self::listType()[$this->type];
    }

    public function afterSave($insert, $changedAttributes)
    {

        parent::afterSave($insert, $changedAttributes);
    }

    public function beforeValidate()
    {
        return parent::beforeValidate();
    }

    public function behaviors()
    {
        return [
            'classify' => [
                'class' => 'common\behaviors\Classify',
                'attribute' => 'classify',
            ]
        ];
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['classify', 'name', 'url', 'icon'], 'filter', 'filter' => 'strip_tags'],
            [['classify', 'name', 'url', 'icon'], 'filter', 'filter' => 'trim'],
            [['type'], 'in', 'range' => array_keys(self::listType())],
            [['target'], 'in', 'range' => array_keys(self::listTarget())],
            [['name', 'language'], 'unique', 'targetAttribute' => ['name', 'language'], 'message' => Yii::t('app', 'The combination of Language and Name has already been taken.')],
        ]);
    }
}