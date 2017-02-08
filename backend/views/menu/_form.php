<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Language;
use backend\models\Menu;

/* @var $this yii\web\View */
/* @var $model backend\models\Menu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menu-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-6 col-xs-12">
            <?= $form->field($model, 'language')->dropDownList(Language::getDrop(), ['prompt' => '-- Выберите язык --']) ?>
        </div>
        <div class="col-sm-6 col-xs-12">
            <?= $form->field($model, 'classify')->dropDownList(Menu::getDropClassify(), ['prompt' => '-- Выберите первичную меню --'])->hint('Выбрать меню для которого делается перевод, напрмиер есть меню на русском и вы делаете её перевод на украинсткий') ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4 col-xs-12">
            <?= $form->field($model, 'target')->dropDownList(Menu::listTarget()) ?>
        </div>
        <div class="col-sm-4 col-xs-12">
            <?= $form->field($model, 'type')->dropDownList(Menu::listType(), ['prompt' => '-- Выберите тип меню --']) ?>
        </div>
        <div class="col-sm-4 col-xs-12">
            <?= $form->field($model, 'parent')->dropDownList(Menu::getDrop(), ['prompt' => '-- Выберите родительский элемент --']) ?>
        </div>
    </div>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true])->hint('Напрмиер: /category/name_category/  - начальный и конечный слеши "/" обязательно! Можно вставлять ссылки на другие сайты') ?>

    <?= $form->field($model, 'icon')->textInput(['maxlength' => true])->hint('Напрмиер: fa fa-user') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
