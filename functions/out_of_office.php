<?php
if($id==0)$id=574;
$emal_list_arr=$this->data->get_list_array("SELECT email from users where active=1 and email!='' and id not in (SELECT userid from user_group where groupid in (0,1,4,13,16,19,20,21,23,24,25,26,27))");

$vacation=$this->data->get_row('vacations',$id);

$employee=$this->data->get_row('employees',$vacation[emplid]);

$from='info@szcmail.com';
$to='it@szcmail.com';
$subject=$employee[name].' '.$employee[surname].' out of office';//Introducing SZC Management
$description='Automatic message';
$body='Dear All,
<br><br>
Please note that '.$employee[name].' '.$employee[surname].' will be absent from '.$vacation[fromdate].' to '.$vacation[todate].', reason is '.$vacation[name].'.<br><br><br>Best regards,<br>Information System.';

//echo "$body<br>";
//$emal_list_arr=['it@szcmail.com'];
echo "Senging mail to:<hr>";
foreach ($emal_list_arr as $email) {
    $i++;
    echo "$i - $email<br>";
    $this->comm->send_announcement($email, $from, $subject, $description, $body);
}
echo "<hr><b>Done</b><hr>";
return $out;