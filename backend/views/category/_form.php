<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use common\behaviors\StatusBehaviors;
use backend\models\Language;
use backend\models\Category;

/* @var $this yii\web\View */
/* @var $model backend\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="row">
        <div class="col-sm-4 col-xs-12">
            <?= $form->field($model, 'language')->dropDownList(Language::getDrop(), ['prompt' => '-- Выберите язык --']) ?>
        </div>
        <div class="col-sm-4 col-xs-12">
            <?= $form->field($model, 'status')->dropDownList(StatusBehaviors::listStatus()) ?>
        </div>
        <div class="col-sm-4 col-xs-12">
            <?= $form->field($model, 'classify')->dropDownList(Category::getDropClassify(), ['prompt' => '-- Выберите первичную категорию --'])->hint('Выбрать категорию для которой делается перевод, напрмиер есть категория на русском и вы делаете её перевод на украинсткий') ?>
        </div>
    </div>

    <?= $form->field($model, 'parent')->dropDownList(Category::getDrop(), ['prompt' => '-- Выберите категорию --']) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>


    <div class="row">
        <div class="col-sm-6 col-xs-12">
            <?= $form->field($model, 'imageFile')->fileInput(['accept' => 'image/*']) ?>
        </div>
        <div class="col-sm-6 col-xs-12">
            <?php if($model->img){ ?>
                <a href="<?=$model->imageUrl()?>" data-lightbox="image-1" data-title="<?=Html::encode($model->name)?>">
                    <img src="<?=$model->imageUrl('mini')?>" alt="<?=Html::encode($model->name)?>">
                </a>
            <?php } ?>
        </div>
    </div>

    <?= $form->field($model, 'texttop')->textarea(['rows' => 6])->widget(CKEditor::className(),[
        'options' => ['rows' => 6],
        'editorOptions' =>ElFinder::ckeditorOptions(['elfinder', 'path' => 'page'],[
            'preset' => 'full',
            'inline' => false,
        ]),
    ]) ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6])->widget(CKEditor::className(),[
        'options' => ['rows' => 6],
        'editorOptions' =>ElFinder::ckeditorOptions(['elfinder', 'path' => 'page'],[
            'preset' => 'full',
            'inline' => false,
        ]),
    ]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
