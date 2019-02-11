<?php
$JSONData='{
      "nodes": [
        { "name": "startA" },
        { "name": "startB" },
        { "name": "process1" },
        { "name": "process2" },
        { "name": "process3" },
        { "name": "process4" },
        { "name": "process5" },
        { "name": "process6" },
        { "name": "process7" },
        { "name": "process8" },
        { "name": "process9" },
        { "name": "process10" },
        { "name": "process11" },
        { "name": "process12" },
        { "name": "process13" },
        { "name": "process14" },
        { "name": "process15" },
        { "name": "process16" },
        { "name": "finishA" },
        { "name": "finishB" }
      ],
      "links": [
        { "source": "startA", "target": "process8", "value": 20, "optimal": "yes" },
        { "source": "startA", "target": "process5", "value": 20, "optimal": "yes" },
        { "source": "startA", "target": "process6", "value": 20, "optimal": "yes" },
        { "source": "startB", "target": "process1", "value": 15, "optimal": "yes" },
        { "source": "startB", "target": "process5", "value": 15, "optimal": "yes" },
        { "source": "process1", "target": "process4", "value": 30, "optimal": "yes" },
        { "source": "process4", "target": "process1", "value": 10, "optimal": "yes" },
        { "source": "process2", "target": "process7", "value": 35, "optimal": "yes" },
        { "source": "process1", "target": "process3", "value": 20, "optimal": "yes" },
        { "source": "process5", "target": "process1", "value": 20, "optimal": "yes" },
        { "source": "process6", "target": "startA", "value": 5, "optimal": "yes" },
        { "source": "process4", "target": "process2", "value": 5, "optimal": "yes" },
        { "source": "process6", "target": "process8", "value": 15, "optimal": "yes" },
        { "source": "process4", "target": "startB", "value": 5, "optimal": "yes" },
        { "source": "process3", "target": "process2", "value": 15, "optimal": "yes" },
        { "source": "process3", "target": "startB", "value": 5, "optimal": "yes" },
        { "source": "process15", "target": "process13", "value": 10, "optimal": "yes" },
        { "source": "process13", "target": "process9", "value": 10, "optimal": "yes" },
        { "source": "process7", "target": "startB", "value": 20, "optimal": "yes" },
        { "source": "process8", "target": "process1", "value": 10, "optimal": "yes" },
        { "source": "process8", "target": "process16", "value": 10, "optimal": "yes" },
        { "source": "process16", "target": "process9", "value": 10, "optimal": "yes" },
        { "source": "process8", "target": "process11", "value": 25, "optimal": "yes" },
        { "source": "process11", "target": "process10", "value": 20, "optimal": "yes" },
        { "source": "process4", "target": "process12", "value": 10, "optimal": "yes" },
        { "source": "process12", "target": "process11", "value": 10, "optimal": "yes" },
        { "source": "process7", "target": "process15", "value": 15, "optimal": "yes" },
        { "source": "process15", "target": "process14", "value": 10, "optimal": "yes" },
        { "source": "process10", "target": "process13", "value": 10, "optimal": "yes" },
        { "source": "process10", "target": "process16", "value": 10, "optimal": "yes" },
        { "source": "process14", "target": "finishB", "value": 10, "optimal": "yes" },
        { "source": "process9", "target": "finishA", "value": 10, "optimal": "yes" },
        { "source": "process16", "target": "process8", "value": 10, "optimal": "yes" },
        { "source": "process9", "target": "finishB", "value": 10, "optimal": "yes" },
        { "source": "process15", "target": "finishB", "value": 10, "optimal": "yes" },
        { "source": "process15", "target": "finishA", "value": 10, "optimal": "yes" },
        { "source": "process11", "target": "process15", "value": 25, "optimal": "yes" }
      ]
    }
';
/*
$df=$this->html->readRQd('df',5);
$dt=$this->html->readRQd('dt',1);
$sql="select t.sender as source, t.receiver as target, (round(t.amount_usd/100)*100) as value, 'yes' as optimal, type
from transactions t
where t.sender!=t.receiver
and t.amount_usd>1000
and not (t.amount_usd<500 and t.receiver=2)
and t.valuedate>='$df'
and t.valuedate<='$dt'
order by t.valuedate asc, t.sender asc, t.receiver asc limit 100";

$nodes_ids=[];

if (!($cur = pg_query($sql))) {$this->html->SQL_error($sql);}
$rows=pg_num_rows($cur);
while ($row = pg_fetch_array($cur,NULL,PGSQL_ASSOC)){
	//echo $this->html->pre_display($row,"row");
	$links[]=$row;
	if(!in_array($row[source], $nodes_ids))$nodes_ids[]=$row[source];
	if(!in_array($row[target], $nodes_ids))$nodes_ids[]=$row[target];
}
foreach ($nodes_ids as $nodes_ids) {
	$nodes[]=['name'=>$nodes_ids];
}
$data=['nodes'=>$nodes,'links'=>$links];
//echo $this->html->pre_display($data,"data");
//exit;
$JSONData=json_encode($data);
//echo $this->html->pre_display($sql,"sql"); exit;
//
*/
header('Content-type: application/json');
echo $JSONData; exit;


