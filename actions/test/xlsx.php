<?php
//report bvi_dirs
$id=$this->html->readRQn('loan_id');
$date=$this->html->readRQd('date', 1);


require_once FW_DIR.'/classes/PHPExcel/Classes/PHPExcel.php';
//require_once FW_DIR.'vendor'.DS.'PHPGangsta'.DS.'GoogleAuthenticator.php';
$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("IS")
->setLastModifiedBy("IS")
->setTitle("IS Export")
->setSubject("IS Export")
->setDescription("IS Export data")
->setKeywords("IS")
->setCategory("Data");

//$objPHPExcel->getActiveSheet()->fromArray($dataArray, NULL, 'A0');
$objPHPExcel->getActiveSheet()->setTitle('Sheet1');
$objPHPExcel->setActiveSheetIndex(0);
$sheet=$objPHPExcel->getActiveSheet();

$data=$this->project->export_to_xlsx();
// echo $this->html->pre_display($data,"result");
// exit;

$data=$this->utils->array_add_heder_row($data);
//echo $this->html->pre_display($data,"result"); exit;
$sheet->fromArray($data, null, 'A1');

//$sheet->getStyle("A1:AG1")->getFont()->setBold(true);
//$objPHPExcel->getActiveSheet()->removeRow(1);
foreach (range('A', 'AG') as $columnID) {
    $sheet->getColumnDimension($columnID)->setAutoSize(true);
    $sheet->calculateColumnWidths($columnID);
}



$fliename='export_from_bi';
// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$fliename.'.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
