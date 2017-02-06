<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use backend\models\Language;
use backend\models\Faq;

/* @var $this yii\web\View */
/* @var $model backend\models\Faq */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="faq-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-sm-6 col-xs-12">
            <?= $form->field($model, 'language')->dropDownList(Language::getDrop(), ['prompt' => '-- Выберите язык --']) ?>
        </div>
        <div class="col-sm-6 col-xs-12">
            <?= $form->field($model, 'classify')->dropDownList(Faq::getDropClassify(), ['prompt' => '-- Выберите первичную faq --'])->hint('Выбрать faq для которой делается перевод, напрмиер есть faq на русском и вы делаете её перевод на украинсткий') ?>
        </div>
    </div>

    <?= $form->field($model, 'question')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'answer')->textarea(['rows' => 6])->widget(CKEditor::className(),[
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
