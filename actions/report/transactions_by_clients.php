<?php
$tmp=$this->html->readRQcsv('ids');
if ($tmp!=''){$sql.=" and id in ($tmp)";}

$sql="SELECT * FROM entities WHERE id>0 $sql order by name";
$fields=array('#','id','name','acquir','in','out','disp','total','');
//$sort= array('id','name');

$csv_row=['id','name'];
$csv_arr[]=implode("\t",$csv_row);

$out=$this->html->tag('Transactions by Clients','foldered');
$out.=$this->html->tablehead('',$qry, $order, $addbutton, $fields,'autosort');
if (!($cur = pg_query($sql))) {$this->html->SQL_error($sql);}
$rows=pg_num_rows($cur);$start_time=$this->utils->get_microtime();
//if($rows>0)$csv=$this->data->csv($sql);
while ($row = pg_fetch_array($cur,NULL,PGSQL_ASSOC)){
	$i++;
	$this->progress($start_time, $rows, $i, "$what $i / $rows");
	$name=$this->data->detalize('entities',$row[id]);

	$acc_qty = $this->db->getval("SELECT count(*) from books_transactions where type_id=1 and entity_id=$row[id]");

	$in_qty = $this->db->getval("SELECT count(*) from books_transactions where type_id=2 and entity_id=$row[id]");

	$out_qty = $this->db->getval("SELECT count(*) from books_transactions where type_id=3 and entity_id=$row[id]");

	$disp_qty = $this->db->getval("SELECT count(*) from books_transactions where type_id=4 and entity_id=$row[id]");
	$total_qty=$acc_qty+$in_qty+$out_qty+$disp_qty;
	$out.= "<tr>";
	$out.= "<td>$i</td><td><span onClick=\"this.className='blackout';basket_additem('$what:$row[id]')\">$row[id]</span></td>";
	$out.= "<td onMouseover=\"showhint('$row[descr]', this, event, '400px');\">$name</td>";
	$this->html->money($row[price]);
	$out.= "<td class='n'>".$this->html->money($acc_qty)."</td>";
	$out.= "<td class='n'>".$this->html->money($in_qty)."</td>";
	$out.= "<td class='n'>".$this->html->money($out_qty)."</td>";
	$out.= "<td class='n'>".$this->html->money($disp_qty)."</td>";
	$out.= "<td class='n'>".$this->html->money($total_qty)."</td>";
	$out.= "<td class='n'> </td>";
	$out.= "</tr>";

	$totals[2]+=$acc_qty;
	$totals[3]+=$in_qty;
	$totals[4]+=$out_qty;
	$totals[5]+=$disp_qty;
	$totals[6]+=$total_qty;


	$csv_row=[$i,$row[id],$row[name]];
	$csv_arr[]=implode("\t",$csv_row);

	if ($allids) $allids.=','.$what.':'.$row[id]; else $allids.=$what.':'.$row[id];
}
$csv=implode("\n",$csv_arr);
$this->livestatus('');
include(FW_DIR.'/helpers/end_table.php');