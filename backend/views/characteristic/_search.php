<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\search\CharacteristicSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="characteristic-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'classify') ?>

    <?= $form->field($model, 'language') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'units') ?>

    <?php // echo $form->field($model, 'specification') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
