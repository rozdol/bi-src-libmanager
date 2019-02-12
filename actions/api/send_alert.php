<?php
$email=$this->html->readRQ('_email');
$entity_id=$this->html->readRQn('entity_id');

$JSONData=array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => $email, 'entity_id'=>$entity_id);