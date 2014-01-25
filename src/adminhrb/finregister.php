<?php
session_start ();

include "../includes/credentials.php";
$con = mysql_connect ( $server, $username, $password );
if (! $con) {
	die ( 'Could not connect: ' . mysql_error () );
}

mysql_select_db ( $database, $con );

?>

<html>
<title>That's all for now !!</title>

<body>
	<div align='center'>
<?php

$username = $_POST ["username"];
$password = md5 ( $username );
$name = $_POST ["name"];
$email = $_POST ["emailid"];
$security = $_POST ["securitykey"];
if ($security != "revanthb3000@gmail.com") {
	echo "Wrong security key";
} else {
	$result = mysql_query ( "SELECT * from users where username='" . $username . "';" );
	
	if ($row = mysql_fetch_array ( $result )) {
		echo ("Username is taken.");
	} else {
		$result = mysql_query ( "INSERT INTO users (username,password,name,email) VALUES ('$username','$password','$name','$email')", $con );
		if (! $result) {
			echo "No new entries made !!!";
		}
		
		echo "User has been registered.";
	}
}
?>
</div>
</body>
</html>
