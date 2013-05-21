<?php

include "hicloudpaas_sdk.php";

//authentication parameters
$serviceid="14";
$isvid="";
$isvkey="";

//sms parameters
$phone="09xxyyyzzz";
$msg="testtest for sms";

//get the token and sign
$a=get_auth($isvid,$isvkey,$serviceid);
$token=$a[0];
$sign=$a[1];

$smsserver="http://hiair-api.hicloud.net.tw/hisms/servlet/send";
$ch=curl_init();
curl_setopt($ch, CURLOPT_URL, $smsserver);
curl_setopt($ch,CURLOPT_POST,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "isvAccount=$isvid&token=$token&sign=$sign&msisdn=$phone&msg=$msg"); 
curl_exec($ch);


?>
