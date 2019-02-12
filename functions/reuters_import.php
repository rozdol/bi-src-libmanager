<?php
//function reuters_import($data=[])
$debug=0;
$wait="<img src=".APP_URI."/assets/img/ajax-loader-bar.gif> Quering Reuters...<br>";
//$this->livestatus($wait);
if(!$data)return ['error'=>'No data'];
//require_once FW_DIR.'/vendor/unirest/Unirest.php';

$param='reuters_auth_token';
$count=$this->db->getval("SELECT count(*) from config where name='$param'");
if($count==0)$this->db->getval("INSERT INTO config (name, value) values ('$param','')");
if($debug)echo $this->html->pre_display($response,"response");
$auth_token=$this->db->GetVal("select value from config where name='$param'");

$auth_token2='_CNUv_BRHvBbsokVqVlJEubfaWr3_7aBGdtRgYAP1MjbOnEj_pCSmMSs3OfIy3uiQuvK3WWamXEo1r5ma-tvon3jdtrrLdaROw13Vy75L6KHfSjr5CcNRpGllOR8wICcLqzGMftO5gKaeQBbhvvx0QRYIc_yNxJjU1A85NahDwBftwRxPoi0kW-RP3hk_BapIYmscXGmn4IbuwN6Ms7RNSPtvF-nKtQU2f3s1aLfg31ar8GRBZKVyu3uuNM3RtbndDRMBuA_pHknDYRlGpYz_7x2w8YZ1_AyviMRJESkdpco';

//if(($response->code=='200')&&($auth_token!='')){

$headers = [
'Authorization'=> 'Token '.$auth_token,
'Accept' => 'application/json',
'Content-Type'=>'application/json; odata=minimalmetadata',
'Prefer'=> 'respond-async; wait=15'
];

	//$response = Unirest\Request::get('https://hosted.datascopeapi.reuters.com/RestApi/v1/Users/Users(9011839)', $headers, null);
	//echo $this->html->pre_display($response,"response");

	//$body = Unirest\Request\Body::json($data);


//$body = Unirest\Request\Body::json($data);
//echo $this->html->pre_display($body,"body");

foreach ($data as $identifier) {
	$InstrumentIdentifiers[]=['Identifier' => $identifier,'IdentifierType' => 'Ric'];
}


$data=array (
	'ExtractionRequest' => 
	array (
		'@odata.type' => '#ThomsonReuters.Dss.Api.Extractions.ExtractionRequests.EndOfDayPricingExtractionRequest',
		'ContentFieldNames' => 
		array (
			0 => 'Asset Category Description',
			1 => 'Currency Code Scaled',
			2 => 'Expiration Date',
			3 => 'Security Description',
			4 => 'Universal Close Price',
			//5 => 'Close Price',
			),
		'IdentifierList' => 
		array (
			'@odata.type' => '#ThomsonReuters.Dss.Api.Extractions.ExtractionRequests.InstrumentIdentifierList',
			'InstrumentIdentifiers' => $InstrumentIdentifiers,
			'ValidationOptions' => NULL,
			'UseUserPreferencesForValidationOptions' => false,
			),
		'Condition' => NULL,
		),
	);
$data = Unirest\Request\Body::json($data);

$response = Unirest\Request::post('https://hosted.datascopeapi.reuters.com/RestApi/v1/Extractions/ExtractWithNotes', $headers,$data);

if($response->code=='401'){
	$headers = [
	'Accept' => 'application/json',
	'Content-Type'=>'application/json; odata=minimalmetadata',
	'Prefer'=> 'respond-async'

	];
	$credentials=['Credentials'=>[
	'Username' => getenv('REUTERS_USER'),
	'Password' => getenv('REUTERS_PASS')];
	$data = $credentials;

	//$body = Unirest\Request\Body::form($data);
	$body = Unirest\Request\Body::json($data);

	$response = Unirest\Request::post('https://hosted.datascopeapi.reuters.com/RestApi/v1/Authentication/RequestToken', $headers, $body);
	if($response->code=='200'){
		$auth_token=$response->body->value;
		$this->db->GetVal("update config set value='$auth_token' where name='$param'");
		$result['info']='New auth token received';
	}else{
		$result['error']='New auth token received';
		$result['debug']=$response;
	}

		if($debug)echo $this->html->pre_display($response,"response2");
}

if($response->code=='200'){
		if($debug)echo $this->html->pre_display($response,"response2");
	$ok=1;
}
if($response->code=='202'){
	$ExtractionId=$response->headers[Location];
		if($debug)echo "L:$ExtractionId<br>";
	$response = Unirest\Request::get($ExtractionId, $headers, null);
		if($debug)echo $this->html->pre_display($response,"response3");
	$ok=1;
}
if($ok){
		if($debug)echo $this->html->pre_display($response,"Success");
	$data=$response->body->Contents;
		if($debug)echo $this->html->pre_display($data,"data");
	foreach ($data as $object) {
		$Identifier=$object->{'Identifier'};
		$Price=$object->{'Universal Close Price'};
		if($debug)echo "$Identifier = $Price<br>";
		$result[$Identifier]=$Price;
		//if($debug)echo $this->html->pre_display($object,"object ".$object->{Universal Close Price});
	}
}else{
	if($debug)echo $this->html->pre_display($response,"ERROR");
	$error="Code:".$response->code." Message:".$response->body->error->message;
	$result['error']=$error;
}
//$this->livestatus('');

return $result;