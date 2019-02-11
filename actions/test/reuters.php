<?php

/*
echo "01.04.2017 - 31.12.2020";
$value1=$this->project->get_reuters_quote('NEWC','01.04.2017','31.12.2020');
echo $value1[debug];

$value2=$this->project->get_reuters_quote('API2','01.04.2017','31.12.2020');
echo $value2[debug];

$value3=$this->project->get_reuters_quote('API4','01.04.2017','31.12.2020');
echo $value3[debug];
exit;

*/

$result=$this->project->reuters_import(['ATWMF8']);
echo $this->html->pre_display($result,"result");
exit;
//echo $this->report('reuters_forwards_chart');
//exit;

$out.=$this->html->tag("VAL:$value1[value]",'h3','');

//echo $this->html->pre_display($value,"values");
echo "$out<br>";
exit;

$ric='ATWMF8';
//$ric='AFCQM7';
//$ric='NCFYZ9';
$ric='XXXMF8';
$index=$this->project->ric_decode($ric);
echo $this->html->pre_display($index,"$ric");

$ric=$this->project->ric_encode($index[index],$index[df],$index[dt]);
echo $this->html->pre_display($index,"$ric");

$ric=$this->project->ric_encode('','01.01.2018');
echo $this->html->pre_display($index,"Pricer:$ric");

exit;

 ?>