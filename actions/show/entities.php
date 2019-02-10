<?php
    //Show entities
    if($sortby==''){$sortby="id asc";}

    $tmp=$this->html->readRQcsv('ids');
    if ($tmp!=''){$sql.=" and id in ($tmp)";}

    $tmp=$this->html->readRQn('list_id');
    if ($tmp>0){$sql.=" and list_id=$tmp";}

    $sql1="select *";
    $sql=" from $what a where id>0 $sql";
    $sqltotal=$sql;
    $sql = "$sql order by $sortby";
    $sql2=" limit $limit offset $offset;";
    $sql=$sql1.$sql.$sql2;
    //$out.= $sql;


    // === Andrew. Limit columns for html output:
    $fields=array('id','salutation','name','surname','active','type_id','physical','email','mobile','tel','address','country_id','birth_date','passport',);
    // $fields=array('id','name','date','active','descr','surname','salutation','type_id','physical','email','mobile','tel','address','passport','country_id','birth_date',);



    //$sort= $fields;
    //=== Andrew: change column names (differ from $fields):
    $headers=array('id','salutation','name','surname','active','type','physical','email','mobile','tel','address','country','birth date','passport',);
    $out=$this->html->tablehead($what,$qry, $order, 'no_addbutton', $headers,$sort);

    if (!($cur = pg_query($sql))) {$this->html->HT_Error( pg_last_error()."<br><b>".$sql."</b>" );}
    $rows=pg_num_rows($cur);if($rows>0)$csv.=$this->data->csv($sql);
    while ($row = pg_fetch_array($cur)) {
        $i++;
        $class='';
        //$type=$this->data->get_name('listitems',$row[type]);
        if($row[id]==0)$class='d';
        $out.= "<tr class='$class'>";
        $out.= $this->html->edit_rec($what,$row[id],'ved',$i);
        $out.= "<td id='$what:$row[id]' class='cart-selectable' reference='$what'>$row[id]</td>";
        $out.= "<td>$row[salutation]</td>";
        $out.= "<td onMouseover=\"showhint('$row[descr]', this, event, '400px');\">$row[name]</td>";
        $out.= "<td>$row[surname]</td>";
        $out.= "<td>$row[active]</td>";

        //=== Andrew: instead of entity type id, need to get entity type Name:
        // $out.= "<td>$row[type_id]</td>";
        $entityTypeName = $this->data->get_name('listitems', $row[type_id]);
        $out.= "<td>$entityTypeName</td>";
 


        $out.= "<td>$row[physical]</td>";
        $out.= "<td>$row[email]</td>";
        $out.= "<td>$row[mobile]</td>";
        $out.= "<td>$row[tel]</td>";
        $out.= "<td>$row[address]</td>";

        // $out.= "<td>$row[country_id]</td>";
        $out.= "<td>" . $this->data->get_name('listitems', $row[country_id]) . "</td>";

        $out.= "<td>$row[birth_date]</td>";
        $out.= "<td>$row[passport]</td>";




        // $out.= "<td>$type</td>";
        // $out.= "<td class='n'>".$this->html->money($row[amount])."</td>";
        $out.= "</tr>";
        $totals[2]+=$row[qty];
        if ($allids) $allids.=','.$what.':'.$row[id]; else $allids.=$what.':'.$row[id];
        $this->livestatus(str_replace("\"","'",$this->html->draw_progress($i/$rows*100)));
    }
    $this->livestatus('');
    include(FW_DIR.'/helpers/end_table.php');
    