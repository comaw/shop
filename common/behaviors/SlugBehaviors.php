<?php

namespace common\behaviors;

use common\UrlHelper;
use Yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;

class SlugBehaviors extends Behavior
{
    public $in_attribute = 'name';
    public $out_attribute = 'url';
    public $translit = true;

    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'getSlug'
        ];
    }

    public function getSlug( $event )
    {
        if ( empty( $this->owner->{$this->out_attribute} ) ) {
            $this->owner->{$this->out_attribute} = $this->generateSlug( $this->owner->{$this->in_attribute} );
        } else {
            $this->owner->{$this->out_attribute} = $this->generateSlug( $this->owner->{$this->out_attribute} );
        }
    }

    private function generateSlug( $slug )
    {
        return UrlHelper::translateUrl($slug);
    }
}