<?php
//Save alerts_history
$id=$this->html->readRQn('id');
$name=$this->html->readRQ('name');
$date=$this->html->readRQ('date');
$user_id=$this->html->readRQn('user_id');
$entity_id=$this->html->readRQn('entity_id');
$books_transaction_id=$this->html->readRQn('books_transaction_id');
$type_id=$this->html->readRQn('type_id');
$active=$this->html->readRQn('active');
$descr=$this->html->readRQ('descr');
$text=$this->html->readRQ('text');

    
    $vals=array(
	'name'=>$name,
	'date'=>$date,
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
    