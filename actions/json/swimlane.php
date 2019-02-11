<?php
// $date = "18.01.2012 11:30:10";
// $jsdate=$this->dates->F_JSdate($date);
// echo $this->html->pre_display($jsdate, "D:$date");
// echo $this->html->pre_display("Wed Jan 18 2012 11:00:00 GMT+0200 (EET)", "Correct");

// exit;


$lanes=['A','B','C','D'];
$items=[
	[0,'18.01.2012 11:30:10','22.01.2012 11:30:10'],
	[1,'25.01.2012 11:30:10','31.01.2012 11:30:10'],
];
$i=0;
$obj = new stdClass;
foreach ($lanes as $lane) {
	//echo "$name<br>";
	$obj2 = new stdClass;
	$obj2->id=$i;
	$obj2->label=$lane;
	$obj->lanes[]=$obj2;
	unset($obj2);
	$i++;
}
$i=0;
foreach ($items as $item) {
	$date = strtotime('now');

	//echo $this->html->pre_display($link,"link");
	$obj2 = new stdClass;
	$obj2->id=$i;
	$obj2->name="Item $i";
	$obj2->lane=$item[0];
	$obj2->start=$this->dates->F_JSdate($item[1]);
	$obj2->end=$this->dates->F_JSdate($item[2]);
	$obj2->class='past';
	$obj2->desc="This is a description.";
	$obj->items[]=$obj2;
	unset($obj2);
	$i++;
}
$JSONData=json_encode($obj);
//$obj=json_decode($JSONData,TRUE);
//$JSONData=json_encode($obj);
//echo $this->html->pre_display($JSONData,"JSONData","",0);
//var_dump($obj);
//exit;
// id: i * totalWorkItems + j,
// name: 'work item ' + j,
// lane: 'lane ' + i,
// start: dtS,
// end: dt,
// desc: 'This is a description.'
// class: item.end > now ? 'future' : 'past',

//$JSONData=json_encode($obj);

header('Content-type: application/json');
echo $JSONData; exit;