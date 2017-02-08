<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\Json;


/* @var $this yii\web\View */
/* @var $models backend\models\Menu[] */
/* @var $model backend\models\Menu */

$this->title = Yii::t('app', 'Управление меню');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Menus'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile('/admin/jstree/dist/themes/default/style.min.css');
$this->registerJsFile('/admin/jstree/dist/jstree.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<div class="menu-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div id="jstree"></div>
</div>
<?php
$urlMove = Url::toRoute(['menu/move']);
$urlDel = Url::toRoute(['menu/del']);
$data = [];
foreach ($models AS $model){
    $data[] = [
    "id" => $model->id,
    "parent" => ($model->parent ? $model->parent : '#'),
    "text" => $model->name,
    ];
}
$data = Json::encode($data);
$script = <<< JS
$( document ).ready(function () {
    
    $('#jstree')
    .on('move_node.jstree', function (e, data) {
            $.ajax({
                url: '$urlMove',
                type: 'POST',
                dataType: "json",
                data: {id: data.node.id, parents: data.node.parents},
                error: function () {
                    alert('Ошибка запроса к серверу - обновите страницу и попробуйте еще раз!');
                },
                success: function (msg) {
                    if (msg && msg.length > 2) {
                        alert(msg);
                    }
                }
            });
        })
    .on('delete_node.jstree', function (e, data) {
            $.ajax({
                url: '$urlDel',
                type: 'POST',
                dataType: "json",
                data: {id: data.node.id},
                error: function () {
                    alert('Ошибка запроса к серверу - обновите страницу и попробуйте еще раз!');
                },
                success: function (msg) {
                    if (msg && msg.length > 2) {
                        alert(msg);
                    }else{
                        window.location.href = window.location.href;
                    }
                }
            });
        })
        .jstree({ 
            'core' : {
                "animation" : 0,
                "check_callback" : true,
                'data' : $data
            },
            'contextmenu' : {
                'items' : {
                    "remove" : {
                        "separator_before"	: false,
                        "icon"				: false,
                        "separator_after"	: false,
                        "_disabled"			: false, //(this.check("delete_node", data.reference, this.get_parent(data.reference), "")),
                        "label"				: "Удалить",
                        "action"			: function (data) {
                            var inst = $.jstree.reference(data.reference),
                                obj = inst.get_node(data.reference);
                            if(inst.is_selected(obj)) {
                                inst.delete_node(inst.get_selected());
                            }
                            else {
                                inst.delete_node(obj);
                            }
                        }
                    },
                }
            },
            "plugins" : [
                "sort",
                // "unique",
                "conditionalselect",
                "dnd",
                "changed",
                "contextmenu"
            ]
        });
    
});
JS;
$this->registerJs($script, yii\web\View::POS_END);