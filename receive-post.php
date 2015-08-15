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

include 'got-it.php';


$servername = "localhost";
$username = "abacuz_abacuz";
$dbname = "abacuz_menucontrol";
//$frompage = basename($_SERVER[ "SCRIPT_NAME"],'.php') ;
$datetime = date_create()->format('Y-m-d H:i:s');

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	
		$sql = "SELECT sub, source FROM Logins where sub = '{$obj->{'sub'}}'";
	
	echo $sql;
	
		$stmt = $conn->query($sql); 
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		while ($result = $stmt->fetch()):
			$SUB = $result['sub'];
			$SOURCE = $result['source'];
 		endwhile;
			echo "before if";
	
		if ($SOURCE != "Google") {
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO Logins (datejoined, email, name, permission, pictureurl, source, sub)
			 VALUES ('{$datetime}', '{$obj->{'email'}}', '{$obj->{'name'}}', 'none', '{$obj->{'picture'}}' , 'Google', '{$obj->{'sub'}}')";
			 // use exec() because no results are returned
			$conn->exec($sql);
			echo "New record created successfully";
		} else {
			echo "record already exists";
		}
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;



 ?>
