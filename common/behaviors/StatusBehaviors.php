<?php

namespace common\behaviors;

use Yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;

class StatusBehaviors extends Behavior
{
    const STATUS_ACTIVE = 'active';
    const STATUS_HIDE = 'hide';

    public $attribute = 'status';

    public static function listStatus(){
        return [
            self::STATUS_ACTIVE => Yii::t('app', 'Активный'),
            self::STATUS_HIDE => Yii::t('app', 'Скрыт'),
        ];
    }

    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'setStatus',
            ActiveRecord::EVENT_AFTER_FIND => 'getStatus',
        ];
    }

    public function setStatus( $event )
    {
        if(!$this->owner->{$this->attribute}){
            $this->owner->{$this->attribute} = self::STATUS_ACTIVE;
        }
        if(!isset(self::listStatus()[$this->owner->{$this->attribute}])){
            $this->owner->{$this->attribute} = self::STATUS_ACTIVE;
        }
     }

    public function getStatus( $event )
    {
        $list = self::listStatus();
        $this->owner->{$this->attribute} = isset($list[$this->owner->{$this->attribute}]) ? $list[$this->owner->{$this->attribute}] : $list[self::STATUS_ACTIVE];
    }
}