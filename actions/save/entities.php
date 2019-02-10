<?php
//Save entities
$id=$this->html->readRQn('id');
$name=$this->html->readRQ('name');
$date=$this->html->readRQ('date');
$active=$this->html->readRQn('active');
$descr=$this->html->readRQ('descr');
$surname=$this->html->readRQ('surname');
$salutation=$this->html->readRQ('salutation');
$type_id=$this->html->readRQn('type_id');
$physical=$this->html->readRQn('physical');
$email=$this->html->readRQ('email');
$mobile=$this->html->readRQ('mobile');
$tel=$this->html->readRQ('tel');
$address=$this->html->readRQ('address');
$passport=$this->html->readRQ('passport');
$country_id=$this->html->readRQn('country_id');
$birth_date=$this->html->readRQd('birth_date',1);

    
    $vals=array(
	'name'=>$name,
	'date'=>$date,
	'active'=>$active,
	'descr'=>$descr,
	'surname'=>$surname,
	'salutation'=>$salutation,
	'type_id'=>$type_id,
	'physical'=>$physical,
	'email'=>$email,
	'mobile'=>$mobile,
	'tel'=>$tel,
	'address'=>$address,
	'passport'=>$passport,
	'country_id'=>$country_id,
	'birth_date'=>$birth_date
);
    echo $this->html->pre_display($_POST,'Post'); 
    echo $this->html->pre_display($vals,'Vals');
    // exit;
    
    if($id==0){$id=$this->db->insert_db($what,$vals);}else{$id=$this->db->update_db($what,$id,$vals);}
    $body.=$out;
    