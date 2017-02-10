<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Category;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Category'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Управление категориями'), ['tree'], ['class' => 'btn btn-info']) ?>
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
//            'parent',
            [
                'attribute' => 'parent',
                'value' => function($data){
                    return $data->parent0->name;
                },
                'filter' => Category::getDrop(),
            ],
            'name',
            'url',
//            'classify',
            [
                'attribute' => 'language',
                'value' => function($data){
                    return $data->language0->name;
                },
                'filter' => \backend\models\Language::getDrop(),
            ],
            // 'title',
            // 'description',
            // 'texttop:ntext',
            // 'text:ntext',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function($data){
                    return $data->status;
                },
                'filter' => \common\behaviors\StatusBehaviors::listStatus(),
            ],
            // 'created',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
