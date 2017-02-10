<?php


namespace backend\components;

use backend\models\Manufacturer;
use backend\models\Tag;
use Yii;
use PHPExcel;
use PHPExcel_IOFactory;
use yii\helpers\Url;

class ExportExcel
{

    /**
     * @param array $models
     */
    public static function manufacturerExport(array $models){
        $model = new Manufacturer();
        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();

// Set document properties
        $objPHPExcel->getProperties()->setCreator($model->formName())
            ->setLastModifiedBy($model->formName())
            ->setTitle($model->formName() . " 2007 XLSX Document")
            ->setSubject($model->formName() . " 2007 XLSX Document")
            ->setDescription($model->formName() . " Office 2007 XLSX, generated using PHP classes.")
            ->setKeywords($model->formName() . "office 2007 php")
            ->setCategory($model->formName());


// Add some data
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Id')
            ->setCellValue('B1', 'Имя')
            ->setCellValue('C1', 'Язык')
            ->setCellValue('D1', 'Статус')
            ->setCellValue('E1', 'Title')
            ->setCellValue('F1', 'Description')
            ->setCellValue('G1', 'Текст')
            ->setCellValue('H1', 'Картинка');

        foreach ($models AS $k => $model){
            $i = $k + 2;
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A' . $i, $model->id)
                ->setCellValue('B' . $i, $model->name)
                ->setCellValue('C' . $i, $model->language0->name)
                ->setCellValue('D' . $i, $model->status)
                ->setCellValue('E' . $i, $model->title)
                ->setCellValue('F' . $i, $model->description)
                ->setCellValue('G' . $i, $model->text)
                ->setCellValue('H' . $i, ($model->img ? rtrim(str_replace('admin', '', Url::home(true)), '/') . $model->img : ''));
        }



        $objPHPExcel->getActiveSheet()->setTitle($model->formName());
        $objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$model->formName() . '-' . date("d_m_Y-H_i_s") .'.xls"');
        header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }

    /**
     * @param array $models
     */
    public static function tagExport(array $models){
        $model = new Tag();
        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();

// Set document properties
        $objPHPExcel->getProperties()->setCreator($model->formName())
            ->setLastModifiedBy($model->formName())
            ->setTitle($model->formName() . " 2007 XLSX Document")
            ->setSubject($model->formName() . " 2007 XLSX Document")
            ->setDescription($model->formName() . " Office 2007 XLSX, generated using PHP classes.")
            ->setKeywords($model->formName() . "office 2007 php")
            ->setCategory($model->formName());


// Add some data
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Id')
            ->setCellValue('B1', 'Имя')
            ->setCellValue('C1', 'Язык')
            ->setCellValue('D1', 'Статус')
            ->setCellValue('E1', 'Title')
            ->setCellValue('F1', 'Description')
            ->setCellValue('G1', 'Верхний текст')
            ->setCellValue('H1', 'Текст');

        foreach ($models AS $k => $model){
            $i = $k + 2;
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A' . $i, $model->id)
                ->setCellValue('B' . $i, $model->name)
                ->setCellValue('C' . $i, $model->language0->name)
                ->setCellValue('D' . $i, $model->status)
                ->setCellValue('E' . $i, $model->title)
                ->setCellValue('F' . $i, $model->description)
                ->setCellValue('G' . $i, $model->texttop)
                ->setCellValue('H' . $i, $model->text);
        }



        $objPHPExcel->getActiveSheet()->setTitle($model->formName());
        $objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$model->formName() . '-' . date("d_m_Y-H_i_s") .'.xls"');
        header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }
}