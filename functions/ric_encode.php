<?php 
//function ric_encode($index,$df,$dt)
$df=$this->dates->F_date($df,1);
$dt=$this->dates->F_date($dt);
if($dt=='')$dt=$df;
//echo "$index: $df-$dt<br>";

$indexes=[
'ATW'=>'API2',
'AFC'=>'API4',
'NCF'=>'NEWC'
];
$indexes=array_flip($indexes);

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
$monthes_num=array_flip($monthes_num);

//echo $this->html->pre_display($indexes,"$indexes");
$index_ric=$indexes[$index];
$year_ric=substr($df, -1,1);

$days=$this->dates->F_datediff($df,$dt);
if($days>360){
	//annual
	$period_ric="YZ";
}elseif($days>70){
	//quarter
	$month=substr($df, 3,2);
	if($month>=10){
		$quarter="Z";
	}elseif($month>=7){
		$quarter="U";
	}
	elseif($month>=4){
		$quarter="M";
	}else{
		$quarter="H";
	}
	$period_ric="Q{$quarter}";
}elseif($days>=0){
	//month
	$month=substr($df, 3,2);
	$month_ric=$monthes_num[$month];
	$period_ric="M{$month_ric}";
	if($index_ric=='')$period_ric="{$month_ric}";
}else{
	$this->html->error("Incorrect date range $df - $dt");
}

$ric="{$index_ric}{$period_ric}{$year_ric}";
return $ric;