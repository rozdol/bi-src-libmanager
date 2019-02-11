<?php
$mobile='+35799357429';
$status=$this->comm->sendsms($mobile, "Test for SMS $rnd");
echo $this->html->pre_display($status,"status of sendsms to $mobile ($rnd)");
