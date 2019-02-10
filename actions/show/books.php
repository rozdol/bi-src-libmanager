<?php
    //Show books
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
    // echo $this->html->pre_display($sql, "SQL input");


    //=== Andrew. Modify list of columns in output html table:
    $fields=array('id','name','date','isbn','link',);
    // $fields=array('id','name','date','isbn','link','active','descr',);

    //$sort= $fields;
    $sort = array('name',);
    $out=$this->html->tablehead($what,$qry, $order, 'no_addbutton', $fields,$sort);

    if (!($cur = pg_query($sql))) {$this->html->HT_Error( pg_last_error()."<br><b>".$sql."</b>" );}
    $rows=pg_num_rows($cur);if($rows>0)$csv.=$this->data->csv($sql);




    //=== Andrew. Add html output with output from SQL request, in CSV format:
    // echo $this->html->pre_display($csv, "CSV input");



    while ($row = pg_fetch_array($cur)) {
        $i++;
        $class='';
        //$type=$this->data->get_name('listitems',$row[type]);
        if($row[id]==0)$class='d';
        $out.= "<tr class='$class'>";
        $out.= $this->html->edit_rec($what,$row[id],'ved',$i);
        $out.= "<td id='$what:$row[id]' class='cart-selectable' reference='$what'>$row[id]</td>";
        $out.= "<td onMouseover=\"showhint('$row[descr]', this, event, '400px');\">$row[name]</td>";

        // $shortDate = PROCESS row[date] to convert it to short format;
        //=== Andrew: method 1 (all datetime : 10.02.2019 14:22:08.527541) :
        // $out.= "<td>$row[date]</td>";

        //=== Andrew: method 2:
        $dateFormated = $this->dates->F_date($row[date]);
        // $out.= "<td>$dateFormated</td>";
        $out.=$this->html->tag($dateFormated,'td','class');


        $out.= "<td>$row[isbn]</td>";
        

        //=== Andrew: wrap hlink to nice clikable html element:
        // function link_badge($title = '', $link = '', $class = '', $warn = '')
        // $link = $this->html->link_badge('go to', $row[link] );
        // $out.= "<td>$link</td>";

        //=== Andrew: url to button:
        // $link = $this->html->link_button('go to', $row[link], 'btn' );
        // $link = $this->html->link_button('go to', $row[link], 'btn-mini' );
        // $link = $this->html->link_button('go to', $row[link], 'btn-micro btn-info' );
        // $link = $this->html->link_button('go to', $row[link], 'btn-micro btn-success' );
        $link = $this->html->link_button('go to', $row[link], 'btn-micro btn-danger' );
        $out.= "<td>$link</td>";




        // $out.= "<td class='n'>".$this->html->money($row[amount])."</td>";
        $out.= "</tr>";
        $totals[2]+=$row[qty];
        if ($allids) $allids.=','.$what.':'.$row[id]; else $allids.=$what.':'.$row[id];
        $this->livestatus(str_replace("\"","'",$this->html->draw_progress($i/$rows*100)));
    }
    $this->livestatus('');
    include(FW_DIR.'/helpers/end_table.php');


    $bs = '    
    <div class="btn-group">
      <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
        Action
        <span class="caret"></span>
      </a>
      <ul class="dropdown-menu">
        <!-- dropdown menu links -->
            <li><a href="http://localhost:8000/?act=details&what=books&id=1">Book 1</a class="btn"></a></li>
            <li><a href="http://localhost:8000/?act=details&what=books&id=2">Book 2</a class="btn"></a></li>
      </ul>
    </div>';

$body .=$bs;


    