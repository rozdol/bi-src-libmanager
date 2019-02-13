<?php
$mailbox = '{mail.server.com:993/imap/ssl}INBOX';
$username = 'it';
$password = '';

$imapResource = imap_open($mailbox, $username, $password);


//If the imap_open function returns a boolean FALSE value,
//then we failed to connect.
if($imapResource === false){
    //If it failed, throw an exception that contains
    //the last imap error.
    $this->html->error('Unable to connect to the IMAP server.');
    $this->html->error(imap_last_error());
    //throw new Exception(imap_last_error());
}

$search = 'SINCE "' . date("j F Y", strtotime("-0 days")) . '"';
//$search = 'FROM "user@server.com"';
//$search = 'ALL';
$emails = imap_search($imapResource, $search);
//$messages = imap_search($imapResource, 'ALL');
$count=count($emails);
if ($count>100)$this->html->error("$count messages found");
//If the $emails variable is not a boolean FALSE value or
//an empty array.
if(!empty($emails)){
    //Loop through the emails.
    foreach($emails as $email){
        //Fetch an overview of the email.
        $overview = imap_fetch_overview($imapResource, $email);
        $overview = $overview[0];
        //Print out the subject of the email.
        echo '<b>' . htmlentities($overview->subject) . '</b><br>';
        //Print out the sender's email address / from email address.
        echo 'From: ' . $overview->from . '<br><br>';
        //Get the body of the email.
        //$message = imap_fetchbody($imapResource, $email, 1, FT_PEEK);
    }
}else{
	$this->html->error('No messages found');
}