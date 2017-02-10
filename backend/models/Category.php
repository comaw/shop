<?php


namespace backend\models;

use common\behaviors\StatusBehaviors;
use yii\db\Expression;
use common\lib\FolderLib;
use yii\helpers\ArrayHelper;
use yii\imagine\Image;
use yii\web\UploadedFile;
use Yii;

/**
 * This is the model class for table "{{%category}}".
 *
 * @property UploadedFile $imageFile
 */

class Category extends \common\models\Category
{
    public $imageFile;

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'status' => [
                'class' => 'common\behaviors\StatusBehaviors',
                'attribute' => 'status',
            ],
            'slug' => [
                'class' => 'common\behaviors\SlugBehaviors',
                'in_attribute' => 'name',
                'out_attribute' => 'url',
                'translit' => true
            ]
        ]);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['imageFile'],
                'image',
//                'minWidth' => 250,
//                'maxWidth' => 250,
//                'minHeight' => 250,
//                'maxHeight' => 250,
                'extensions' => 'jpg, jpeg, gif, png',
                'maxSize' => 1024 * 1024 * 2
            ],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'imageFile' => Yii::t('app', 'Image'),
        ]);
    }

    /**
     * @return array
     */
    public static function getDropClassify(){
        return ArrayHelper::map(self::find()->select(['classify', 'name'])->where(['=', 'status', StatusBehaviors::STATUS_ACTIVE])->orderBy('id desc')->all(), 'classify', 'name');
    }

    /**
     * @return array
     */
    public static function getDrop(){
        $model = self::find()->where(['=', 'status', StatusBehaviors::STATUS_ACTIVE])->orderBy([new Expression('id DESC')])->all();
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

    public function afterSave($insert, $changedAttributes)
    {
        if($this->imageFile){
            $this->upload();
        }
        parent::afterSave($insert, $changedAttributes);
    }

    public static function listTypeImg(){
        return [
            'preview-' => [250, 250],
            'mini-' => [80, 80],
        ];
    }


    /**
     * @param string $type
     * @param bool $rand
     *
     * @return string
     */
    public function imageUrl(string $type = '', bool $rand = true) : string {
        $type .= '-';
        if(!isset(self::listTypeImg()[$type])){
            $type = '';
        }
        $explode = explode('/', $this->img);
        $explode = end($explode);
        return str_replace($explode, $type . $explode, $this->img) . ($rand ? '?' . rand(10000, 1000000) : '' );
    }

    public function imageDelete(){
        $dir = FolderLib::getFolder($this->formName(), $this->id);
        @unlink($dir . $this->img);
        foreach (self::listTypeImg() AS $type => $r){
            @unlink($dir . $type . $this->img);
        }
    }

    public function upload()
    {
        $fileName = mb_substr($this->url, 0, 198, 'UTF-8') . '.' . $this->imageFile->extension;
        $dir = FolderLib::getFolder($this->formName(), $this->id);
        $this->imageFile->saveAs($dir . $fileName);
        foreach (self::listTypeImg() AS $type => $r){
            Image::thumbnail($dir . $fileName, $r[0], $r[1])
                ->save($dir . $type . $fileName);
        }
        $this->imageFile = null;
        $this->img = FolderLib::getFolderUrl($this->formName(), $this->id) . $fileName;
        $this->save(false);
    }
}