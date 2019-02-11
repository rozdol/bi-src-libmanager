<?php
    //Edit alerts_history
    if ($act=='edit'){
        $sql="select * from $what WHERE id=$id";
        $res=$this->db->GetRow($sql);
    }else{
        $sql="select * from $what WHERE id=$refid";
        $res2=$this->db->GetRow($sql);
        $res[active]='t';

        //=== Andrew: show user hint for record name:
        $placeHolder=$this->data->get_new_name($what,'','','ALRT-' );


    }

    $form_opt['well_class']="span11 columns form-wrap";

    $out.=$this->html->form_start($what,$id,'',$form_opt);
    $out.="<hr>";

    $out.=$this->html->form_hidden('reflink',$reflink);
    $out.=$this->html->form_hidden('id',$id);
    $out.=$this->html->form_hidden('reference',$reference);
    $out.=$this->html->form_hidden('refid',$refid);



    //=== Andrew: show user hint for record name (see $placeHolder):
    $out.=$this->html->form_text('name',$res[name],'Name',$placeHolder,0,'span12');



    //=== Andrw: hide field 'date'. Will assign the value at Save action:
    // $out.=$this->html->form_date('date',$res[date],'Date','',0,'span12');

    //=== Andrew: don't show user-id :
    // $user_id=$this->data->listitems('user_id',$res[user_id],'user','span12');
    //     $out.= "<label>User</label>$user_id";





    // $entity_id=$this->data->listitems('entity_id',$res[entity_id],'entity','span12');
    //     $out.= "<label>Entity</label>$entity_id";

    

    //=== Andrew: prepare SQL request:
    $sql = "SELECT id, name||' '||surname as username from entities where active = '1' ";
    //=== Andrew: add html list (htlist) into element 'entity_id', with placeholder = 'Select'
    //function htlist($lname = '', $sql = '', $sell = '', $all = '', $opts = '', $def = '', $class = '')
    $htmlListOfClients =$this->html->htlist('entity_id',$sql, $res[entity_id], 'Select client');
    $out.= "<label>Client</label>$htmlListOfClients";




    // $books_transaction_id=$this->data->listitems('books_transaction_id',$res[books_transaction_id],'books_transaction','span12');
    //     $out.= "<label>Books transaction</label>$books_transaction_id";
    //=== Andrew: prepare SQL request:
    $sql = "
    select 
        tr.id, 
        '('||users.username||' '||tr.date::date||') '||listitems.name||' : \"'||books.name||'\"   => '||entities.name||' '||entities.surname as whowhen

        from 
            users,
            books_transactions as tr, 
            books, 
            listitems,
            entities 
        WHERE
            tr.book_id      = books.id
            and
            tr.entity_id    = entities.id
            and
            tr.user_id      = users.id
            and
            tr.type_id      = listitems.id
            and 
            tr.active = '1'
    ";

    //$sql = "SELECT id, book_id||' '||type_id||' '||date::date as name from books_transactions where active = '1' ";
    $htmlListOfTransactions =$this->html->htlist('books_transaction_id',$sql, $res[books_transaction_id], 'Select transaction');
    $out.= "<label>Transactions</label>$htmlListOfTransactions";

    

    



    //=== Andrew: add drop-down from list items:
    $type_id=$this->data->listitems('type_id',$res[type_id],'alerts','span12');
        $out.= "<label>Alert type</label>$type_id";

$out.=$this->html->form_textarea('descr',$res[descr],'Descr','',0,'','span12');

$out.=$this->html->form_text('text',$res[text],'Text','',0,'span12');
$out.=$this->html->form_chekbox('active',$res[active],'Active','',0,'span12');
$out.="<br/>";


    $out.=$this->html->form_confirmations();
    $out.=$this->html->form_submit('Save');
    $out.=$this->html->form_end();
    
    $body.=$out;
    