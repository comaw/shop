<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\User;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
//            'role',
            [
                'attribute' => 'role',
                'value' => function($data){
                    return $data->getRoleName();
                },
                'filter' => User::listRole()
            ],
            'username',
            'email:email',
//            'auth_key',
            // 'password_hash',
            // 'password_reset_token',
//             'status',
            [
                'attribute' => 'status',
                'value' => function($data){
                    return $data->getStatusName();
                },
                'filter' => User::listStatus()
            ],
//             'created_at',
            [
                'attribute' => 'created_at',
                'value' => function($data){
                    return date("Y-m-d H:i:s", $data->created_at);
                },
            ],
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}'],
        ],
    ]); ?>
</div>
