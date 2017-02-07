<?php

namespace common\lib;

use Yii;

class FolderLib
{

    /**
     * @param integer $id
     *
     * @return float|int
     */
    public static function folderById(int $id) : int
    {
        $folder = floor($id / 1000);
        return intval($folder < 1 ? 1 : $folder * 1000);
    }

    /**
     * @param string $formName
     * @param int $id
     *
     * @return string
     */
    public static function getFolder(string $formName, int $id) : string {
        $formName = mb_strtolower($formName);
        $dir = Yii::getAlias("@frontend/web/upload/") . $formName . '/';
        if(!is_dir($dir)){
            mkdir($dir, 0777);
        }
        $dir .= self::folderById($id) . '/';
        if(!is_dir($dir)){
            mkdir($dir, 0777);
        }
        $dir .= $id . '/';
        if(!is_dir($dir)){
            mkdir($dir, 0777);
        }
        return $dir;
    }


    /**
     * @param string $formName
     * @param int $id
     *
     * @return string
     */
    public static function getFolderUrl(string $formName, int $id) : string {
        $formName = mb_strtolower($formName);
        $dir = "/upload/" . $formName . '/';
        $dir .= self::folderById($id) . '/';
        $dir .= $id . '/';
        return $dir;
    }
}