<?php
$chart=array(
    "caption"=> "Risk Categorization",
    "subCaption"=> "",
    "paletteColors"=> "#0075c2,#1aaf5d,#f2c500,#f45b00,#8e0000",
    "numberPrefix"=> "",
    "showBorder"=> "0",
    "use3DLighting"=> "0",
    "enableSmartLabels"=> "1",
    "startingAngle"=> "310",
    "showLabels"=> "1",
    "showPercentValues"=> "1",
    "showLegend"=> "1",
    //"defaultCenterLabel"=> $this->utils->bytes2h($ds),
    //"centerLabel"=> $this->utils->bytes2h($ds),
    //"centerLabelBold"=> "1",
    "showTooltip"=> "1",
    "decimals"=> "0",
    "useDataPlotColorForLabels"=> "1",
    "theme"=> "fint"
);

$arr1['High Risk']=10;
$arr1['Normal Risk']=100;
$arr1['Low Risk']=30;
$arr1['Undefined Risk']=2;

$data=$this->utils->array2array($arr1, 'label', 'value');
$FC_array=array('chart'=>$chart,'data'=>$data);

$jsonEncodedData = json_encode($FC_array);
$chart1.=$this->utils->chart_js_new('pie2d', 600, 400, 'chart-1', $jsonEncodedData);

echo $chart1;