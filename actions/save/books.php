<?php
//Save books
$id=$this->html->readRQn('id');
$name=$this->html->readRQ('name');
// $date=$this->html->readRQ('date');
$isbn=$this->html->readRQ('isbn');
$link=$this->html->readRQ('link');
$active=$this->html->readRQn('active');
$descr=$this->html->readRQ('descr');

    
    $vals=array(
	'name'=>$name,
	// 'date'=>$date,
	'date'=>$this->dates->F_date('', 1),
	'isbn'=>$isbn,
	'link'=>$link,
	'active'=>$active,
	'descr'=>$descr
);
    echo $this->html->pre_display($_POST,'Post'); 
    echo $this->html->pre_display($vals,'Vals');
    // exit;

    if($id==0){$id=$this->db->insert_db($what,$vals);}else{$id=$this->db->update_db($what,$id,$vals);}
    $body.=$out;
    