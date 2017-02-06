<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Subscriber */

$this->title = Yii::t('app', 'Create Subscriber');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Subscribers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subscriber-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
