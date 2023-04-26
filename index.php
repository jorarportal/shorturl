<?php 
require_once 'inc.php';
$uniqid = $_GET['id'];


if(empty($uniqid)){
    header("Location:your_404_error_page");
}else{
    if(checkIfURLExists($db,$uniqid)==false){
        header("Location:https://hubtut.com/lost");
    }else if(checkIfURLExists($db,$uniqid)==true){
        getHits($db,$uniqid,getIp());
        $redirectUrl = checkIfURLExists($db,$uniqid);
        header("Location:$redirectUrl");
    }
}

 ?>
