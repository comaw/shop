<?php

namespace common\lib;

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

}