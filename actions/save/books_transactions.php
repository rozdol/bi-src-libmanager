<?php
//Save books_transactions
$id=$this->html->readRQn('id');
$name=$this->html->readRQ('name');

if($name=='')$name = $this->data->get_new_name($what, '','','BTR-');

// $date=$this->html->readRQ('date');


//=== Andrew: don't add user-id:
// $user_id=$this->html->readRQn('user_id');
//=== Andrew: need to determine the actor:

$entity_id=$this->html->readRQn('entity_id');
$type_id=$this->html->readRQn('type_id');
$book_id=$this->html->readRQn('book_id');


//=== Andrew: add now() as default ( from',1):
$date_from=$this->html->readRQd('date_from',1);
$date_to=$this->html->readRQd('date_to',1);

$rating=$this->html->readRQn('rating');
$active=$this->html->readRQn('active');
$descr=$this->html->readRQ('descr');


//=== Andrew:  if books_transaction exists, then take user_id from row id from books_transaction:
// otherwise take user id from GLOBALS ($GLOBALS[uid].  Or use $GLOBALS[gid]) : 
if($id>0){
	$user_id=$this->data->get_val($what, 'user_id', $id);
} else {
	$user_id=$GLOBALS[uid];
}

    
    $vals=array(
	'name'=>$name,
	// 'date'=>$date,
	'user_id'=>$user_id,
	'entity_id'=>$entity_id,
	'type_id'=>$type_id,
	'book_id'=>$book_id,
	'date_from'=>$date_from,
	'date_to'=>$date_to,
	'rating'=>$rating,
	'active'=>$active,
	'descr'=>$descr
);
    echo $this->html->pre_display($_POST,'Post'); 
    echo $this->html->pre_display($vals,'Vals');
    // exit;
    
    if($id==0){$id=$this->db->insert_db($what,$vals);}else{$id=$this->db->update_db($what,$id,$vals);}
    $body.=$out;
    