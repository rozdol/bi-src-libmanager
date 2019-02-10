<?php
    //Show books_transactions
    if($sortby==''){$sortby="id asc";}

    $tmp=$this->html->readRQcsv('ids');
    if ($tmp!=''){$sql.=" and id in ($tmp)";}

    $tmp=$this->html->readRQn('list_id');
    if ($tmp>0){$sql.=" and list_id=$tmp";}


    //=== Andrew.
    $tmp=$this->html->readRQn('client_id');
    if ($tmp>0){$sql.=" and entity_id=$tmp";}

    $tmp=$this->html->readRQn('employee_id');
    if ($tmp>0){$sql.=" and user_id=$tmp";}



    $sql1="select *";
    $sql=" from $what a where id>0 $sql";
    $sqltotal=$sql;
    $sql = "$sql order by $sortby";
    $sql2=" limit $limit offset $offset;";
    $sql=$sql1.$sql.$sql2;
    //$out.= $sql;


    //=== Andwer. Change columns order:
    $fields=array('id','name','date','user_id','entity_id','book_id','type_id','date_from','date_to','rating',);
    // $fields=array('id','name','date','user_id','entity_id','type_id','book_id','date_from','date_to','rating','active','descr',);
    


    $fields=array('id','name','date','user','client','book','transaction','date from','date to','rating',);
    //$sort= $fields;
    $out=$this->html->tablehead($what,$qry, $order, 'no_addbutton', $fields,$sort);

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
        $out.= "<td onMouseover=\"showhint('$row[descr]', this, event, '400px');\">$row[name]</td>";


        // $out.= "<td>$row[date]</td>";
        $dateFormated = $this->dates->F_date($row[date]);
        $out.=$this->html->tag($dateFormated,'td','class');


        // $out.= "<td>$row[user_id]</td>";
        $userName = $this->data->get_val('users', 'username', $row[user_id]);
        $out.= "<td>$userName</td>";





        // $out.= "<td>$row[entity_id]</td>";
        $ClientName = $this->db->getval("SELECT name||' '||surname from entities where id = $row[entity_id] ");
        $ClientName=$this->html->href("?act=details&what=entities&id=$row[entity_id]",$ClientName);

        //$ClientName=$this->data->detalize('entities', $row[entity_id]);
        $out.= "<td>$ClientName</td>";



        // $out.= "<td>$row[book_id]</td>";
        //=== Andrew: take value from only comlumn 'name':
        // $BookName = $this->data->get_name('books', $row[book_id]);
        //=== Andrew: take value from any comlumn
        // $BookName = $this->data->get_val('books', 'name', $row[book_id]);
        //=== Andew: add URL to book table:
        $BookName = $this->data->detalize('books', $row[book_id]);
        $out.= "<td>$BookName</td>";

        
        // $out.= "<td>$row[type_id]</td>";
        $entityTypeName = $this->data->get_name('listitems', $row[type_id]);
        $out.= "<td>$entityTypeName</td>";
        
        
        // $out.= "<td>$row[date_from]</td>";
        // $out.= "<td>$row[date_to]</td>";
        $dateFrom = $this->dates->F_date($row[date_from]);
        $dateTo = $this->dates->F_date($row[date_to]);
        $out.=$this->html->tag($dateFrom,'td','class');
        $out.=$this->html->tag($dateTo,'td','class');
        


        $out.= "<td>$row[rating]</td>";
        // $out.= "<td>$type</td>";
        // $out.= "<td class='n'>".$this->html->money($row[amount])."</td>";
        $out.= "</tr>";
        $totals[2]+=$row[qty];
        if ($allids) $allids.=','.$what.':'.$row[id]; else $allids.=$what.':'.$row[id];
        $this->livestatus(str_replace("\"","'",$this->html->draw_progress($i/$rows*100)));
    }
    $this->livestatus('');
    include(FW_DIR.'/helpers/end_table.php');



    