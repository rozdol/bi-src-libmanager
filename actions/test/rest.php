<?php
$base='EUR';
$source="https://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml";
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL             => $source,
    CURLOPT_RETURNTRANSFER  => 1,
    CURLOPT_TIMEOUT         => 2
));
$result = curl_exec($curl);
//echo $this->html->pre_display($result,"result");
//exit;
$http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);
// No HTTP error authorized
if ($http_code != 200) {
    echo $this->html->message('HTTP status code ' . $http_code." <br>$curl ",__FUNCTION__,'alert-error');
    return null;
}

//echo $this->html->pre_display($result,"result");

$xml = simplexml_load_string($result);
//echo $this->html->pre_display($xml,"xml");

$json = json_encode($xml);
//echo $this->html->pre_display($json,"json");
$array = json_decode($json,TRUE);
//echo $this->html->pre_display($array,"array");
//echo $this->html->pre_display($array,"array");
$time=$array[Cube][Cube]['@attributes'][time];
//echo $this->html->pre_display($time,"time");
$date=$this->dates->F_date($time);
//echo $this->html->pre_display($time,"time3");
// Converting to an array
$pattern = "{<Cube\s*currency='(\w*)'\s*rate='([\d\.]*)'/>}is";
preg_match_all($pattern, $result, $xml_rates);
echo $this->html->pre_display($xml_rates,"xml_rates");
array_shift($xml_rates);
// Returning associative array (currencies -> rates)
$result = array_combine($xml_rates[0], $xml_rates[1]);
// Checking for Error
if (empty($result)) {
    echo $this->html->message('empty result',__FUNCTION__,'alert-error');
    return null;
}
// Adding EUR = 1
$result = array('EUR' => 1) + $result;
if ($base!='EUR') {
    $rate=($result[$base]==0)?$rate=1:$rate=$result[$base];
    foreach ($result as $key => $value) {
        $result[$key]=round($value/$rate, 4);
    }
}
$res[date]=$date;
$res[rates]=$result;

echo $this->html->pre_display($res,"result");
