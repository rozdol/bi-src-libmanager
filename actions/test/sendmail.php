<?php

$mail_btn=$this->html->link_button('Send alert by mail',"?csrf=$GLOBALS[csrf]&act=save&what=send_announcement&type=mail_alert&book_transaction_id=1","btn btn-small btn-info","Are you sure?");

$sms_btn=$this->html->link_button('Send alert by SMS',"?csrf=$GLOBALS[csrf]&act=save&what=send_announcement&type=sms_alert&book_transaction_id=1","btn btn-small btn-info","Are you sure?");

$sendgrid_btn=$this->html->link_button('Send alert via SendGrid',"?csrf=$GLOBALS[csrf]&act=save&what=send_announcement&type=sendgrid_alert&book_transaction_id=1","btn btn-small btn-info","Are you sure?");
echo "$mail_btn<br>
$sms_btn<br>
$sendgrid_btn<br>
";
?>