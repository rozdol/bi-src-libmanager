<?php
$df=$this->html->readRQd('df',5);
$dt=$this->html->readRQd('dt',1);

$out = file_get_contents(APP_DIR.'/helpers/d3.swimlane.html');
$out=str_replace("<%json_url%>","?act=json&what=swimlane",$out);
$out=str_replace("<%title%>","Transactions analysis $df - $dt",$out);
echo $out;

//echo $this->html->pre_display($out,"result");
?>