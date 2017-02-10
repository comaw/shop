<?php


namespace common\models;

use yii\helpers\ArrayHelper;
use Yii;

class Category extends \common\models\base\Category
{
    public function afterSave($insert, $changedAttributes)
    {
        self::updateAll(['status' => $this->status], ['=', 'classify', $this->classify]);
        $url = self::find()->where(['=', 'classify', $this->classify])->orderBy('id asc')->one();
        if($url){
            self::updateAll(['url' => $url->url], ['=', 'classify', $this->classify]);
            self::updateAll(['img' => $url->img], "classify = :classify AND (img IS NULL OR img = '')", [':classify' => $this->classify]);
        }
        parent::afterSave($insert, $changedAttributes);
    }

    public function beforeValidate()
    {
        if(!$this->title){
            $this->title = $this->name;
        }
        if(!$this->description){
            if($this->text){
                $this->description = mb_substr(strip_tags($this->text), 0, 160, 'UTF-8');
            }else{
                $this->description = $this->name;
            }
        }
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
            [['classify', 'name', 'url', 'title', 'description', 'status', 'img'], 'filter', 'filter' => 'strip_tags'],
            [['classify', 'name', 'url', 'title', 'description', 'texttop', 'text', 'status', 'img'], 'filter', 'filter' => 'trim'],
            [['language', 'url'], 'unique', 'targetAttribute' => ['language', 'url'], 'message' => Yii::t('app', 'The combination of Language and Url has already been taken.')],
        ]);
    }
}