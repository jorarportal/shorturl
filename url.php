<?php 
header('Content-type: application/json');
require_once 'inc.php';
$url = urlencode($_GET['url']);
$api_token = $_GET['token'];

if(empty($url) || empty($api_token)){
	$returnArray = array
	(
		"status"=>0,
		"msg"=>"Missing API Token or URL",
		"timestamp"=>time()
	);
	echo json_encode($returnArray);
}else{
	$returnArray = array();
	if(checkToken($db,$api_token)==false){
		$returnArray = array
		(
			"status"=>0,
			"msg"=>"The API Token was not found in the system",
			"timestamp"=>time()
		);
		echo json_encode($returnArray);
	}else{
		$hashKey = generateHash();
		$sqlInsetLink = $db->prepare("INSERT INTO urls (uniqid,url,record_date) VALUES (?,?,?)");
		if($sqlInsetLink->execute([$hashKey,urldecode($url),time()])){
			$returnArray = array
			(
				"status"=>1,
				"shorturl"=>"$site_url/l/$hashKey",
				"timestamp"=>time()
			);
			echo json_encode($returnArray);
		}else{
			$returnArray = array
			(
				"status"=>0,
				"msg"=>"No short url returned",
				"timestamp"=>time()
			);
			echo json_encode($returnArray);
		}
	}
}

 ?>