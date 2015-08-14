<?php 

//header("Content-type: text/plain");

$url = "https://www.googleapis.com/oauth2/v3/tokeninfo?id_token={$_POST["idtoken"]}";

if (!isset($_GET['foo'])) {
        // Client
        //$ch = curl_init('http://localhost:8080/receive.php?foo=bar');
				$ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT_MS, 2000);
        $data = curl_exec($ch);
        $curl_errno = curl_errno($ch);
        $curl_error = curl_error($ch);
        curl_close($ch);

        if ($curl_errno > 0) {
                echo "cURL Error ($curl_errno): $curl_error\n";
        } else {
                echo "Data received: $data\n";
        }
} else {
        // Server
        sleep(10);
        echo "Done.";
}

$obj = json_decode($data);
print $obj->{'name'}; 
if ($obj->{'aud'} == "640911971946-p4iebvkl43t43ogts9g90iun0gera317.apps.googleusercontent.com"){
	echo "legit";
} else {
        echo "Hack";
}	

 ?>
