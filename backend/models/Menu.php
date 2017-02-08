<?php


namespace backend\models;

use yii\db\Expression;
use yii\helpers\ArrayHelper;

class Menu extends \common\models\Menu
{
    /**
     * @return array
     */
    public static function getDropClassify(){
        return ArrayHelper::map(self::find()->select(['classify', 'name'])->orderBy('id desc')->all(), 'classify', 'name');
    }

    /**
     * @return array
     */
    public static function getDrop(){
        $model =  self::find()->orderBy([new Expression('id DESC')])->all();
        return self::sortByParentsToDrop(self::sortByParents($model));
    }

    /**
     * @param array $array
     *
     * @return array
     */
    public static function sortByParents(array $array): array {
        $r = [];
        foreach ($array AS $arr){
            if(!$arr->parent){
                $r[0][] = $arr;
            }else{
                $r[$arr->parent][] = $arr;
            }
        }
        return $r;
    }

    /**
     * @param array $array
     * @param int $parent
     * @param string $pre
     *
     * @return array
     */
    public static function sortByParentsToDrop(array $array, int $parent = 0, string $pre = ''): array {
        $r = [];
        if(isset($array[$parent])){
            foreach ($array[$parent] AS $k => $arr){
                $r[$arr->id] = trim($pre . ' ' . $arr->name);
                $rParent = self::sortByParentsToDrop($array, $arr->id, $pre . '--');
                $r = ArrayHelper::merge($r, $rParent);
            }
        }
        return $r;
    }
}