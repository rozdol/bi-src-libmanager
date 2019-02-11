<?php 
//function get_reuters_quote($index,$df,$dt)
$df=$this->dates->F_date($df,1);
$dt=$this->dates->F_date($dt);
if($dt=='')$dt=$df;

$last_update=$this->db->getval("SELECT date_part('epoch',age(now(),min(date))) FROM quote_values WHERE index='$index' and
((date_from>='$df' 
	    	and date_to<='$dt')
	    or
	    (date_from<='$df' 
	    	and date_to>='$dt')) ");
//echo "last_update $last_update<br>";
if($last_update>=43200){ //12hours
//if($last_update>=300){ //5min
	$d1 = strtotime($df);
	$d2 = strtotime($dt);
	$min_date = min($d1, $d2);
	$max_date = max($d1, $d2);
	$i = 0;

	//include 1st month
	$min_date = strtotime("-1 MONTH", $min_date);

	//loop through period
	$data=[];
	while (($min_date = strtotime("+1 MONTH", $min_date)) <= $max_date) {
		$date=date('d.m.Y', $min_date);
		$date_to=$this->dates->F_dateadd($this->dates->F_dateadd_month($date,1),-1);
		$date_from=$date;
		$ric=$this->ric_encode($index,$date_from,$date_to);
		//echo "$ric: $date_from - $date_to<br>";
		$data[]=$ric;

	}
	//echo $this->html->pre_display($data,"data");

	$result=$this->reuters_import($data); 
	//echo $this->html->pre_display($result,"result");
	//exit;
	if($result[info])echo $this->html->message($result[info]);
	if($result[error])$this->html->error($result[error]);
	foreach ($result as $ric => $value) {
		$count=$this->db->getval("SELECT count(*) from quote_values where name='$ric'");
		$value=$this->utils->cleannumber($value);
		if(($count==0)&&($value>0)){
			$index_data=$this->ric_decode($ric); 
			$vals=array(
				'name'=>$ric,
				'ric'=>$ric,
				'index'=>$index_data[index],
				'value'=>$value,
				'date_from'=>$this->dates->F_date($index_data[df],1),
				'date_to'=>$this->dates->F_date($index_data[dt],1),
			);
			$this->db->insert_db('quote_values',$vals);
		}else{
			$this->db->GetVal("update quote_values set value='$value', date=now() where name='$ric'");
		}
	}
}
	
//$result[value]=$this->db->getval("SELECT avg(value) from quote_values")*1;
$i=0;
$items=0;
$sql="SELECT * FROM quote_values WHERE index='$index' and
((date_from>='$df' 
	    	and date_to<='$dt')
	    or
	    (date_from<='$df' 
	    	and date_to>='$dt'))
order by date_from asc";
if (!($cur = pg_query($sql))) {$this->html->SQL_error($sql);}	
$rows=pg_num_rows($cur);$start_time=$this->utils->get_microtime();
while ($row = pg_fetch_array($cur,NULL,PGSQL_ASSOC)){
	$i++;
	if($row[value]>0)$items++;
	$total_value+=$row[value];
	$period=$this->dates->F_extractmonthyaer($row[date_from]);
	$debug[$i][period]=$period;
	$debug[$i][value]=$row[value];
	//echo $this->html->pre_display($row,"row $i");
	

}
//$debug=implode("<br>", $debug);
$debug=$this->html->array_display($debug);
if($items>0)$result[value]=$total_value/$items;
$debug="$debug<hr>$total_value / $items = ".round($result[value],2);
$result[debug]=$debug;
//echo $this->html->pre_display($result,"result");
$out=$this->html->message('Resfreshed');

return $result;