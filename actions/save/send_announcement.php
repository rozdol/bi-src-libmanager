<?php
$id=$this->html->readRQn('id');
$type=$this->html->readRQs('type');
if($type=='mail_alert'){
	$this->comm->send_announcement($email, $from, $subject, $description, $body);
}

if($type=='sms_alert'){
	$mobile='+35799357429';
	$status=$this->comm->sendsms($mobile, "Test for SMS $rnd");
	echo $this->html->pre_display($status,"status of sendsms to $mobile ($rnd)");
}

if($type=='sendgrid_alert'){
	$rnd = md5(uniqid(rand(), true));
	$status=$this->comm->sendgrid('FastConsent:fastconsent@gmail.com', "alex Titov:rozdol@gmail.com", "Testing2", "Test2 $rnd");
	echo $this->html->pre_display($status,"status of sendgrid ($rnd)");
}


exit;