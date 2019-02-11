<?php 
//function update_reuters_quotes($indexes)
$df=$this->dates->F_date($date);
$year=$this->dates->F_thisyear();
$month=$this->dates->F_thismonth();
$df="01.$month.$year";
$year+=2;

$day=$this->dates->lastday_in_month("01.$month.$year");
$dt="$day";
//echo "$df - $dt<br>";

foreach ($indexes as $index) {
	//echo "$index<br>";
	$this->livestatus("<img src='".APP_URI."/assets/img/ajax-loader-bar.gif'> Updating $index from Reuters...");
	$value=$this->get_reuters_quote($index,$df,$dt);
	$res.=$value[debug];
}
$this->livestatus("");
return $res;