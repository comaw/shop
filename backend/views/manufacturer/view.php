<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Manufacturer */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Manufacturers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manufacturer-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'img',
                'format' => 'raw',
                'value' => Html::a(Html::img($model->imageUrl('mini')), $model->imageUrl(), [
                    'data-lightbox' => 'image-1'
                ]),
            ],
            'id',
//            'classify',
            [
                'attribute' => 'language',
                'value' => $model->language0->name,
            ],
            'status',
//            'img',
            'created',
            'name',
            'url',
            'title',
            'description',
            'text:ntext',
        ],
    ]) ?>

</div>
