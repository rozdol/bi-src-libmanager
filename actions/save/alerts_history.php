<?php
//Save alerts_history
$id=$this->html->readRQn('id');

// $name=$this->html->readRQ('name');
if($name=='')$name = $this->data->get_new_name($what, '','','ALRT-');


//=== Andrew: don't need to paste date into new row in table alerts_history, because  date timestamp DEFAULT now():
// $date=$this->html->readRQ('date');


// $user_id=$this->html->readRQn('user_id');
//=== Andrew:  if books_transaction exists, then take user_id from row id from books_transaction:
// otherwise take user id from GLOBALS ($GLOBALS[uid].  Or use $GLOBALS[gid]) : 
if($id>0){
	$user_id=$this->data->get_val($what, 'user_id', $id);
} else {
	$user_id=$GLOBALS[uid];
}


$entity_id=$this->html->readRQn('entity_id');
$books_transaction_id=$this->html->readRQn('books_transaction_id');
$type_id=$this->html->readRQn('type_id');
$active=$this->html->readRQn('active');
$descr=$this->html->readRQ('descr');
$text=$this->html->readRQ('text');

    
    $vals=array(
	'name'=>$name,
	// 'date'=>$date,
	'user_id'=>$user_id,
	'entity_id'=>$entity_id,
	'books_transaction_id'=>$books_transaction_id,
	'type_id'=>$type_id,
	'active'=>$active,
	'descr'=>$descr,
	'text'=>$text
);
    echo $this->html->pre_display($_POST,'Post'); 
    echo $this->html->pre_display($vals,'Vals');
    // exit;
    
    if($id==0){$id=$this->db->insert_db($what,$vals);}else{$id=$this->db->update_db($what,$id,$vals);}
    $body.=$out;
    