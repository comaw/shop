<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ManufacturerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Manufacturers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manufacturer-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Manufacturer'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'img',
                'format' => 'raw',
                'value' => function($data){
                    return Html::a(Html::img($data->imageUrl('mini'),['style' => 'max-width: 60px; max-height: 60px;']), $data->imageUrl(), [
                        'data-lightbox' => 'image-1',
                        'style' => 'max-width: 60px; max-height: 60px;',
                    ]);
                },
                'filter' => false,
            ],
            'id',
//            'classify',
//            'language',
            [
                'attribute' => 'language',
                'value' => function($data){
                    return $data->language0->name;
                },
                'filter' => \backend\models\Language::getDrop(),
            ],
            'name',
            'url',
            // 'title',
            // 'description',
            // 'text:ntext',
//             'status',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function($data){
                    return $data->status;
                },
                'filter' => \common\behaviors\StatusBehaviors::listStatus(),
            ],
            // 'img',
             'created',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
