<?php
    //Edit books_transactions
    if ($act=='edit'){
        $sql="select * from $what WHERE id=$id";
        $res=$this->db->GetRow($sql);
    }else{
        $sql="select * from $what WHERE id=$refid";
        $res2=$this->db->GetRow($sql);
        $res[active]='t';

        //=== Andrew: show user hint for record name:
        $place_holder = $this->data->get_new_name($what, '','','BTR-');
        
        // unction get_new_name($table='', $date='', $addsql='', $prefix='', $opt='')
    }

    $form_opt['well_class']="span11 columns form-wrap";

    $out.=$this->html->form_start($what,$id,'',$form_opt);
    $out.="<hr>";

    $out.=$this->html->form_hidden('reflink',$reflink);
    $out.=$this->html->form_hidden('id',$id);
    $out.=$this->html->form_hidden('reference',$reference);
    $out.=$this->html->form_hidden('refid',$refid);


    //=== Andrew: show user hint for record name (see $place_holder):
    $out.=$this->html->form_text('name',$res[name],'Name',$place_holder,0,'span12');


// $out.=$this->html->form_date('date',$res[date],'Date','',0,'span12');

    //=== Andrew: don't show user-id :
    // $user_id=$this->data->listitems('user_id',$res[user_id],'user','span12');
    //     $out.= "<label>User</label>$user_id";

    // $entity_id=$this->data->listitems('entity_id',$res[entity_id],'entity','span12');
    //     $out.= "<label>Entity</label>$entity_id";

    
    //=== Andrew: prepare SQL request:
    $sql = "SELECT id, name||' '||surname as username from entities where active = '1' ";
    //=== Andrew: add html list (htlist) into element 'entity_id', with placeholder = 'Select'
    $htmlListOfClients =$this->html->htlist('entity_id',$sql, $res[entity_id], 'Select client');
    $out.= "<label>Client</label>$htmlListOfClients";



    // $type_id=$this->data->listitems('type_id',$res[type_id],'type','span12');
    //     $out.= "<label>Type</label>$type_id";

    $type_id=$this->data->listitems('type_id',$res[type_id],'transactions','span12');
        $out.= "<label>Type</label>$type_id";





    //=== Andrew:  select books for 
    // $book_id=$this->data->listitems('book_id',$res[book_id],'books','span12');
    //     $out.= "<label>Book</label>$book_id";

    $sql = "SELECT id, name from books where active = '1' ";
    $htmlListOfClients =$this->html->htlist('book_id',$sql, $res[book_id], 'Select book');
    $out.= "<label>Book</label>$htmlListOfClients";




$out.=$this->html->form_date('date_from',$res[date_from],'Date from','',0,'span12');
$out.=$this->html->form_date('date_to',$res[date_to],'Date to','',0,'span12');
$out.=$this->html->form_text('rating',$res[rating],'Rating','',0,'span12');

$out.=$this->html->form_textarea('descr',$res[descr],'Descr','',0,'','span12');
$out.=$this->html->form_chekbox('active',$res[active],'Active','',0,'span12');


    $out.=$this->html->form_confirmations();
    $out.=$this->html->form_submit('Save');
    $out.=$this->html->form_end();
    
    $body.=$out;

/*
Acquisition;acquisition
Check-in;check-in
Check-out;check-out
Dispose;dispose
*/