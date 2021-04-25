<?php
namespace app\common;

use Yii;
use yii\db\ActiveRecord;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExcelReport extends ActiveRecord {
    
    public function exportActionLog($actionlogs,$date_from,$date_to){
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $dateFrom = str_replace('-','',substr($date_from,0,10));
        $dateTo   = str_replace('-','',substr($date_to,0,10));
        
        $title = array("Action","Controller","IP","Log Time","Username","Remark");
        $row = 1;
        $char = 'A';
        
        foreach ($title as $key => $value) {
           $sheet->setCellValue($char.$row, $value);
           $char++;
        }
                
        $row = 2;
        foreach ($actionlogs as $actionlog){
            $sheet->setCellValue('A'.$row,$actionlog->action);
            $sheet->setCellValue('B'.$row,$actionlog->controller);
            $sheet->setCellValue('C'.$row,$actionlog->ip);
            $sheet->setCellValue('D'.$row,$actionlog->log_time);
            $sheet->setCellValue('E'.$row,$actionlog->username);
            $sheet->setCellValue('F'.$row,$actionlog->remark);
            $row++;
        }
        
        $writer = new Xlsx($spreadsheet);
        $filename = 'ActionLog'.$dateFrom.'-'.$dateTo.'.xlsx';        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename='.$filename);
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }
    
    public function exportAnnouncement($announcements,$date_from,$date_to){
        
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $dateFrom = str_replace('-','',substr($date_from,0,10));
        $dateTo   = str_replace('-','',substr($date_to,0,10));
        
        $title = array("Title","Description","Enable","Start Date","End Date");
        $row = 1;        
        $char = 'A';
        
        foreach ($title as $key => $value) {
           $sheet->setCellValue($char.$row, $value);
           $char++;
        }
        
        $row = 2;
        foreach ($announcements as $announcement){
            $sheet->setCellValue('A'.$row,$announcement->title);
            $sheet->setCellValue('B'.$row,$announcement->description);
            $sheet->setCellValue('C'.$row,$announcement->enable);
            $sheet->setCellValue('D'.$row,$announcement->start_date);
            $sheet->setCellValue('E'.$row,$announcement->end_date);            
            $row++;
        }
        
        $writer = new Xlsx($spreadsheet);
        $filename = 'Announcement'.$dateFrom.'-'.$dateTo.'.xlsx';        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename='.$filename);
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }
}