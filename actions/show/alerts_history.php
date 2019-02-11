<?php
    //Show alerts_history
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


    //=== Andrew. Add debug table with prepared SQL request (what2display, div header):
    echo $this->html->pre_display($sql, "SQL input");


    //=== Andrew. Modify list of columns in output html table:
    $fields=array('id','name','date','user','client','transaction','transaction type',);
    // $fields=array('id','name','date','user_id','entity_id','books_transaction_id','type_id','active','descr','text',);


    
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

        //=== Andrew: change format form timestamp to date:
        // $out.= "<td>$row[date]</td>";
        $dateFormated = $this->dates->F_date($row[date]);
        $out.=$this->html->tag($dateFormated,'td','class');
        

        // $out.= "<td>$row[user_id]</td>";
        // $userName = $this->data->get_name('users', $row[user_id]);
        $userName = $this->data->get_val('users', 'username', $row[user_id]);
        $out.= "<td>$userName</td>";



        // $out.= "<td>$row[entity_id]</td>";
        $clientName = $this->db->getval("SELECT name||' '||surname from entities where id = $row[entity_id] ");
        $clientName=$this->html->href("?act=details&what=entities&id=$row[entity_id]",$clientName);
        $out.= "<td>$clientName</td>";



        // $out.= "<td>$row[books_transaction_id]</td>";
        //=== Andrew: prepare SQL request:
        $sql = "
        select 
            '\"'||books.name||'\"   => '||entities.name||' '||entities.surname as whowhen

            from 
                books_transactions as tr, 
                books, 
                entities 
            WHERE
                tr.book_id      = books.id
                and
                tr.entity_id    = entities.id
                and 
                tr.id = $row[books_transaction_id]
        ";

        $transactionName = $this->db->getval($sql);
        $transactionName=$this->html->href("?act=details&what=books_transactions&id=$row[books_transaction_id]",$transactionName);
        $out.= "<td>$transactionName</td>";





        // $out.= "<td>$row[type_id]</td>";
        $transactionTypeName = $this->data->get_name('listitems', $row[type_id]);
        $out.= "<td>$transactionTypeName</td>";




        $out.= "</tr>";
        $totals[2]+=$row[qty];
        if ($allids) $allids.=','.$what.':'.$row[id]; else $allids.=$what.':'.$row[id];
        $this->livestatus(str_replace("\"","'",$this->html->draw_progress($i/$rows*100)));
    }
    $this->livestatus('');
    include(FW_DIR.'/helpers/end_table.php');
    