<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Menu;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\MenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Menus');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Menu'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Управление меню'), ['tree'], ['class' => 'btn btn-info']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
//            'parent',
            [
                'attribute' => 'parent',
                'value' => function($data){
                    return $data->parent0->name;
                },
                'filter' => Menu::getDrop(),
            ],
            'name',
            'url',
//            'classify',
//            'language',
            [
                'attribute' => 'language',
                'value' => function($data){
                    return $data->language0->name;
                },
                'filter' => \backend\models\Language::getDrop(),
            ],
//            'type',
            [
                'attribute' => 'type',
                'value' => function($data){
                    return $data->getTypeName();
                },
                'filter' => Menu::listType(),
            ],
//            'target',
            [
                'attribute' => 'target',
                'value' => function($data){
                    return $data->getTargetName();
                },
                'filter' => Menu::listTarget(),
            ],

             'icon',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}'],
        ],
    ]); ?>
</div>
