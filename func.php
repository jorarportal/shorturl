<?php 
function generateHash(): string
{
    $bytes = random_bytes(5);
    $base64 = base64_encode($bytes);
    $randomletter = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz01234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 2);
    return rtrim(strtr($base64, '+/', $randomletter), '=');
}

function getIp(){
	$finalIp = null;
	if (!empty($_SERVER["HTTP_CLIENT_IP"]))
	{
	//check for ip from share internet
	$ip = $_SERVER["HTTP_CLIENT_IP"];
	}
	elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
	{
	// Check for the Proxy User
	$ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
	}
	else
	{
	$ip = $_SERVER["REMOTE_ADDR"];
	}
	// This will print user's real IP Address
	// does't matter if user using proxy or not.
	return $ip;
}

function getHits($db,$url_id,$ip_address){
	$sql = $db->prepare("INSERT INTO hits (url_id,ip_address,record_date) VALUES (?,?,?)");
	if ($sql->execute([$url_id,$ip_address,time()])) {
		return true;
	}else{
		return false;
	}
}


function checkToken($db,$token){
	$sql = $db->prepare("SELECT * FROM tokens WHERE token=? AND is_deleted=0");
	$sql->execute([$token]);

	if($sql->rowCount()>0){
		return true;
	}else{
		return false;
	}
}


function checkIfURLExists($db,$uniqid){
	$sql = $db->prepare("SELECT * FROM urls WHERE uniqid=? AND is_deleted=0");
	$sql->execute([$uniqid]);

	if($sql->rowCount()>0){
		$sqlObj = $sql->fetch(PDO::FETCH_OBJ);
		return $sqlObj->url;
	}else{
		return false;
	}
}

 ?>