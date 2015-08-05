<?php 

header("Content-type: text/plain");

echo ("https://www.googleapis.com/oauth2/v3/tokeninfo?id_token={$_POST["idtoken"]}");

echo (" FRED");

print_r($_POST["idtoken"]);
//
// console.log ("start");

$response = http_get("https://www.googleapis.com/oauth2/v3/tokeninfo?id_token={$_POST["idtoken"]}", $info);
//$response = http_get("https://www.googleapis.com/oauth2/v3/tokeninfo?id_token=" + $_POST, array("timeout"=>1), $info);
print_r( $info);
//print_r( $info);

//	print_r($info);
print_r($_POST["idtoken"]);

// idtoken received <?php echo $_POST["idtoken"]; 

 ?>
