<?                 
//how to use :
// use includ in you php code 
//
// include "hicloudpaas_sdk.php";
// $a=get_auth($isvid, $isvkey, $serviceid)
// $a=get_token_sign($host);
// $token=$a[0];
// $sign=$a[1];
// 
// then use the $token and $sign to call your service!

function get_auth($isvid, $isvkey, $serviceid){

	$host="api.hicloud.hinet.net";
	//generate sdksign from isvid, isvkey
	$nonce = substr(md5(uniqid('nonce_', true)),0,16);
	$timestamp=round(microtime(true)*1000);
	$sdksign=sha1($isvkey.$nonce.$timestamp);
	
	//get the token and sign from hicloud paas api platform
	$url="http://$host/SrvMgr/requestToken/$isvid/$serviceid/$nonce/$timestamp/$sdksign/";
	$ch = curl_init();
	  
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	$r=curl_exec($ch);
	$jsonresult=json_decode($r);
	$token=$jsonresult->info->token;
	$sign=$jsonresult->info->sign;
	
	return array($token,$sign);

}

?>