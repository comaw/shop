<?php

namespace backend\controllers;

use Yii;
use yii\helpers\Url;

class CacheController extends \backend\components\AdminController
{
    public function actionClear()
    {
        Yii::$app->cache->flush();
        Yii::$app->cacheFile->flush();
        return $this->redirect(Url::toRoute(['settings/index']));
    }

}
