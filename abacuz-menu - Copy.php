<?php include 'got-it.php';?>

<?php 
$servername = "localhost";
$username = "abacuz_abacuz";
$dbname = "abacuz_menucontrol";
$frompage = basename($_SERVER[ "SCRIPT_NAME"],'.php') ;

// echo $password;

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  //  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // $stmt = $conn->query("SELECT ref, id, home FROM Menu where id = 'home'"); 
	$sql = "SELECT ref, id, home, one, two, eight FROM Menu where id = '".$frompage."'";
		$stmt = $conn->query($sql); 
		$stmt->setFetchMode(PDO::FETCH_ASSOC);  
	
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

//echo "here ".$sql;


$HOME='	<li class="active"><a href="#">' ; $ONE='<li class="dropdown">' ; $TWO='<li><a href="abacuz-testing-page.php">';
while ($result = $stmt->fetch()):
  $HOME = $result['home'];
  $ONE = $result['one'];
  $TWO = $result['two'];
  $EIGHT = $result['eight'];
endwhile;
?>

<?php //$result = $stmt->fetch(); ?>
<?php //while ($result = $stmt->fetch()): ?>
 <tr>
   <td><?php // echo htmlspecialchars($result['ref']);  ?></td>
   <td><?php //echo htmlspecialchars($result['id']);   ?></td>
   <td><?php //echo htmlspecialchars($result['home']); ?></td>
	 <td><?php //echo htmlspecialchars($result['one']); ?></td>
	 <td><?php //echo htmlspecialchars($result['two']); ?></td>
 </tr>
<?php //endwhile; ?>

				<?php //echo basename(__FILE__, '.php'); ?>
        <?php //echo basename($_SERVER[ "SCRIPT_NAME"],'.php') ; ?>
				<?php //echo basename($_SERVER[ "REQUEST_URI"],'.php')."Request URI" ; ?>
        <?php //echo $_SERVER[ "REQUEST_URI"] ; ?>

<?php $conn = null; ?>

<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">Abacuz</a>
		</div>
		<div class="collapse navbar-collapse" id="myNavbar">
			<ul class="nav navbar-nav">
				<?php echo $HOME ; ?> Home</a>
				</li>
				<?php echo $ONE ; ?>
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">People<span class="caret"></span></a>
				<ul class="dropdown-menu">
					<?php echo $TWO ; ?>Testing Page</a>
					</li>
				</ul>

			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><?php echo $EIGHT ; ?>
				</li>
				<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a>
					<ul class="dropdown-menu">
						<li>
							<div>
								<center>
									<div class="g-signin2" data-onsuccess="onSignIn">
								</center>
								<!-- <span class="glyphicon glyphicon-log-in"></span> -->
								</div>
						</li>
						<li><a href="#" onclick="signOut();"><span class="glyphicon glyphicon-user"></span> Logout</a>
				    </li>
					</ul>
				</li>
			</ul>

			</div>
		</div>
<script>
function onSignIn(googleUser) {
  var profile = googleUser.getBasicProfile();
  console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
  console.log('Name: ' + profile.getName());
  console.log('Image URL: ' + profile.getImageUrl());
  console.log('Email: ' + profile.getEmail());
	
	var id_token = googleUser.getAuthResponse().id_token;
	
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'https://abacuz.net/receive-post.php');
	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xhr.onload = function() {
  	console.log('Signed in as: ' + xhr.responseText);
	};
	xhr.send('idtoken=' + id_token);
}
</script>
</nav>