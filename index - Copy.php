<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Abacuz</title>
    <meta name="author" content="Gary Carter">
    <meta name="description" content="Abacuz - It is coming">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	  <script src="google-etc.js"></script>

    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <meta name="google-signin-client_id" content="640911971946-p4iebvkl43t43ogts9g90iun0gera317.apps.googleusercontent.com">
	
	<script>	
		$(document).ready(function(){
$("button").click(function(){
    $.post("https://abacuz.net/experiment-receive.php",
    {
        name: "Donald Duck",
        city: "Duckburg"
    },
    function(data, status){
        alert("Data: " + data + "\nStatus: " + status);
    });
});
			});
</script>	
</head>

<body>
	<button>Send an HTTP GET request to a page and get the result back</button>
    <div class="container">
			<?php include 'abacuz-menu.php';?>
			<article>
            <h1>Abacuz.net is coming soon</h1>
            <section id="SectionOne">

                <h2>Watch this space!
									
									

	
<?php
				$fields = array(
    'name' => 'mike',
    'pass' => 'se_ret'
);
$files = array(
    array(
        'name' => 'uimg',
        'type' => 'image/jpeg',
        'file' => './profile.jpg',
    )
);

echo $fields['name'];

//$fred = http_get("https://abacuz.net/experiment-receive.php?firstname=Mickey&lastname=Mouse",array(
//  'headers' => array(
//    'Accept' => 'application/json'
 // )
//), $info);				
									
									
	?>	
									
<form action="https://abacuz.net/experiment-receive.php"  method="get">
First name:<br>
<input type="text" name="firstname" value="Mickey">
<br>
Last name:<br>
<input type="text" name="lastname" value="Mouse">
<br><br>
<input type="submit" value="Submit">
</form>
						
							
							</h2>


                <h3>Countdown</h3>
                <p>10..9... 	<a href="http2.php"> http2.php</a>
							
</p>
							 <h3>After</h3>
						
							

            </section>

        </article>


    </div>
</body>
</html>			