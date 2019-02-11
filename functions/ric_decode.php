<?php 
//function ric_decode($ric)
//$ric='ATWMF8';
//$ric='AFCQM7';
//$ric='NCFYZ9';

$indexes=[
'ATW'=>'API2',
'AFC'=>'API4',
'NCF'=>'NEWC'
];

$periods=[
'M'=>'month',
'Q'=>'quarter',
'YZ'=>'year',
];

$monthes=[
'F'=>'JAN',
'G'=>'FEB',
'H'=>'MAR',
'J'=>'APR',
'K'=>'MAY',
'M'=>'JUN',
'N'=>'JUL',
'Q'=>'AUG',
'U'=>'SEP',
'V'=>'OCT',
'X'=>'NOV',
'Z'=>'DEC',
];

$monthes_num=[
'F'=>'01',
'G'=>'02',
'H'=>'03',
'J'=>'04',
'K'=>'05',
'M'=>'06',
'N'=>'07',
'Q'=>'08',
'U'=>'09',
'V'=>'10',
'X'=>'11',
'Z'=>'12',
];

$quarters=[
'H'=>'Q1',
'M'=>'Q2',
'U'=>'Q3',
'Z'=>'Q4',
];

$this_yaer=$this->dates->F_thisyear();
$this_yaer_ric=substr($this_yaer, -1,1);
$this_yaer_decade=substr($this_yaer, 0,3)*10;

$index_ric=substr($ric, 0,3);
$period_ric=substr($ric, 3,2);
$year_ric=substr($ric, -1,1);

if($this_yaer_ric<=$year_ric){
	$year_add=$this_yaer_decade;
}else{
	$year_add=$this_yaer_decade+10;
}

$year=$year_add+$year_ric;

//echo "$ric = $index_ric-$period_ric-$year_ric =  $year<br>";



$index=$indexes[$index_ric];
//echo "$index_ric=$index<br>";
//echo "$period_ric<br>";

if($period_ric=='YZ'){
	$df="01.01.$year";
	$dt="31.12.$year";
}else{
	if($period_ric[0]=='M'){
		$month=$monthes_num[$period_ric[1]];
		$df="01.$month.$year";
		$days=$this->dates->F_daysinmonth($df);
		$dt="$days.$month.$year";

	}elseif($period_ric[0]=='Q'){
		if($period_ric[1]=='H'){
			$df="01.01.$year";
			$dt="31.03.$year";
		}elseif($period_ric[1]=='M'){
			$df="01.04.$year";
			$dt="30.06.$year";
		}
		elseif($period_ric[1]=='U'){
			$df="01.07.$year";
			$dt="30.09.$year";
		}
		elseif($period_ric[1]=='Z'){
			$df="01.10.$year";
			$dt="31.12.$year";
		}
	}
}
$data[index]=$index;
$data[df]=$df;
$data[dt]=$dt;
return $data;