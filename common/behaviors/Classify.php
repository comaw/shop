<?php

namespace common\behaviors;

use Yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;

class Classify extends Behavior
{
    public $attribute = 'classify';

    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'setClassify'
        ];
    }

    public function setClassify( $event )
    {
        if(!$this->owner->{$this->attribute} || empty($this->owner->{$this->attribute})){
            $this->owner->{$this->attribute} = Yii::$app->security->generateRandomString().time();
        }
    }
}