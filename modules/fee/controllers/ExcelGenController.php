<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 14-Dec-17
 * Time: 11:22 AM
 */
namespace app\modules\fee\controllers;

use app\modules\registration\models\Application;
use PHPExcel;
use yii\web\Controller;

class ExcelGenController extends Controller
{

    public function actionGenerateExcel($month=null, $year=null){

        $excelObj = new PHPExcel();

        //create object
        $excelObj->createSheet();

        $columns = ['Email', 'Mobile Number','Person Exchange','CustomerName','CustomerId','Branch','Note','Due Date','Currency Code','Product Name','Quantity','Price','Discounts(%)','Tax(%)'];

        $rowNumber = 1;

        $columnsIndex =[];

        $counter = 0;
        foreach(range('A','Z')as $item) {
            array_push($columnsIndex, $item . $rowNumber);

            if ($counter == count($columns)) {

                break;
            }
            $counter++;
        }

        foreach($columns as $index => $column){

            $excelObj ->getActiveSheet()->setCellValue($columnsIndex[$index],$column);
        }

        $application = Application::find()->all();

        foreach ($application as $application){
            $rowNumber++;
            $excelObj->getActiveSheet()
                ->setCellValue('A'.$rowNumber, $application->student->member->id0->email);

            $excelObj->getActiveSheet()
                ->setCellValue('B'.$rowNumber, $application->student->member->mobile);

            $excelObj->getActiveSheet()
                ->setCellValue('C'.$rowNumber, $application->student->first_name);

            $excelObj->getActiveSheet()
                ->setCellValue('D'.$rowNumber, $application->student->member->name);

            $excelObj->getActiveSheet()
                ->setCellValue('E'.$rowNumber, $application->student->mykid_no);

            $excelObj->getActiveSheet()
                ->setCellValue('F'.$rowNumber, $application->campusProgramme->campus->campus_name);

        }

        $excelWriter = new \PHPExcel_Writer_Excel2007($excelObj);

        //$excelWriter->save("myfirstexcel.xlsx");

        header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition:attachment; filename="myfilename.xlsx"');

        $excelWriter->save("php://output");

       // die(var_dump($columnsIndex));

    }


}