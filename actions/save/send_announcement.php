<?php
$id=$this->html->readRQn('id');
$type=$this->html->readRQs('type');
if($type=='mail_alert'){
	$book_transaction_id=$this->html->readRQn('book_transaction_id');

	$book_transaction=$this->data->get_row('books_transactions',$book_transaction_id);
	//echo $this->html->pre_display($book_transaction,"book_transaction");

	$email=$this->data->get_val('entities','email',$book_transaction[entity_id]);
	$book=$this->data->get_name('books',$book_transaction[book_id]);
	$user=$this->data->get_name('entities',$book_transaction[entity_id]);


	$from='it@szcmail.com';
	$subject='Return book '.$book;;

	$body="Dear $user, Please return $book!!!";

	echo $this->html->pre_display("$email\n$subject\n$body","result");
	exit;

	echo $this->comm->send_announcement($email, $from, $subject, $description, $body);
}

if($type=='sms_alert'){
	$mobile='+35799357429';
	$status=$this->comm->sendsms($mobile, "Test for SMS $rnd");
	echo $this->html->pre_display($status,"status of sendsms to $mobile ($rnd)");
}

if($type=='sendgrid_alert'){
	$rnd = md5(uniqid(rand(), true));

	$book_transaction_id=$this->html->readRQn('book_transaction_id');

	$book_transaction=$this->data->get_row('books_transactions',$book_transaction_id);
	//echo $this->html->pre_display($book_transaction,"book_transaction");

	$email=$this->data->get_val('entities','email',$book_transaction[entity_id]);
	$book=$this->data->get_name('books',$book_transaction[book_id]);
	$user=$this->data->get_name('entities',$book_transaction[entity_id]);


	$from='it@szcmail.com';
	$subject='Return book '.$book;;

	$body="Dear $user, Please return $book!!!";

	$status=$this->comm->sendgrid('FastConsent:fastconsent@gmail.com', "$user:rozdol@gmail.com", $subject, $body);
	//echo $this->html->pre_display($status,"status of sendgrid ($rnd)");

	if($status==1){
		$name = $this->data->get_new_name('alerts_history', '','','ALRT-');
		    $vals=array(
			'name'=>$name,

			'user_id'=>$GLOBALS[uid],
			'entity_id'=>$book_transaction[entity_id],
			'books_transaction_id'=>$book_transaction_id,
			'type_id'=>6,
			'descr'=>$subject,
			'text'=>$body
		);


		   $this->db->insert_db('alerts_history',$vals);

		   echo $this->html->message("Email sent to $user");
	}else{
		$this->html->error("Could not send via SendGrid<hr>Status:$status");
	}


}


exit;