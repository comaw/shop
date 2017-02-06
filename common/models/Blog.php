<?php

namespace common\models;

use yii\helpers\ArrayHelper;
use Yii;

class Blog extends \common\models\base\Blog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['classify', 'name', 'url', 'title', 'description'], 'filter', 'filter' => 'strip_tags'],
            [['classify', 'name', 'url', 'title', 'description', 'preview', 'text'], 'filter', 'filter' => 'trim'],
            [['url', 'language'], 'unique', 'targetAttribute' => ['url', 'language'], 'message' => Yii::t('app', 'The combination of Language and Url has already been taken.')],

        ]);
    }

    public function beforeValidate()
    {
        if(!$this->title){
            $this->title = $this->name;
        }
        if(!$this->description){
            $this->description = mb_substr(strip_tags($this->text), 0, 160, 'UTF-8');
        }
        return parent::beforeValidate();
    }

    public function afterSave($insert, $changedAttributes)
    {
        self::updateAll(['status' => $this->status], ['=', 'classify', $this->classify]);
        $url = self::find()->where(['=', 'classify', $this->classify])->orderBy('id asc')->one();
        if($url){
            self::updateAll(['url' => $url->url], ['=', 'classify', $this->classify]);
        }
        parent::afterSave($insert, $changedAttributes);
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
}