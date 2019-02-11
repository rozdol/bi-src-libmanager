<?php
$chart=array(
    "caption"=> "Transactions types",
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

$sql="SELECT * FROM listitems WHERE list_id=101";
if (!($cur = pg_query($sql))) {$this->html->SQL_error($sql);}
$rows=pg_num_rows($cur);
while ($row = pg_fetch_array($cur,NULL,PGSQL_ASSOC)){
    //echo $this->html->pre_display($row,"row");
    $arr1[$row[name]]=$this->db->getval("SELECT count(*) from books_transactions where type_id=$row[id]");
}
// echo $this->html->pre_display($arr1,"arr1");
// exit;

// $arr1['Aquisition']=$this->db->getval("SELECT count(*) from books_transactions where type_id=1");
// $arr1['INs']=$this->db->getval("SELECT count(*) from books_transactions where type_id=2");
// $arr1['OUTs']=$this->db->getval("SELECT count(*) from books_transactions where type_id=3");
// $arr1['Disposals']=$this->db->getval("SELECT count(*) from books_transactions where type_id=4");

$data=$this->utils->array2array($arr1, 'label', 'value');
// echo $this->html->pre_display($arr1,"arr1");
// echo $this->html->pre_display($data,"result");

$FC_array=array('chart'=>$chart,'data'=>$data);
// echo $this->html->pre_display($FC_array,"result");
// exit;
$jsonEncodedData = json_encode($FC_array);
$chart1=$this->utils->chart_js_new('pie2d', 600, 400, 'chart-1', $jsonEncodedData);

$body.= $chart1;




