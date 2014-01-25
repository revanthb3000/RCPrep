<?php
session_start ();
?>

<?php

include "includes/credentials.php";
include "includes/menu_bar.php";
$con = mysql_connect ( $server, $username, $password );
if (! $con) {
	die ( 'Could not connect: ' . mysql_error () );
}

mysql_select_db ( $database, $con );

?>
<!DOCTYPE html>
<html>
<title>Author Section - Prepare for GMAT GRE TOEFL SAT CAT</title>
<head>
<link rel="icon" type="image/png" href="images/favicon.png">
<script type="text/javascript">

		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-37189997-1']);
		  _gaq.push(['_trackPageview']);

		  (function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();

		</script>
<?php include("includes/fb_likes.php"); ?>
		<link rel="stylesheet" href="table.css" type="text/css" />
<link rel="stylesheet" href="result.css" type="text/css" />
<link rel="stylesheet" href="menu.css" type="text/css" />
<script type="text/javascript">
			function passcheck()
			{
				var pass1=document.getElementById("newpasswd1");
				var pass2=document.getElementById("newpasswd2");
				if(pass1.value==pass2.value)
				{
					if(pass1.value!="")
					{		
					document.getElementById('passmatch').innerHTML = 'Passwords Match';
					document.getElementById('passmatch').style.color = '#1DA237';
					}
					else
					{
					document.getElementById('passmatch').innerHTML = '';		
					}
					
				}
				else
				{
					document.getElementById('passmatch').innerHTML = "Passwords Don't Match";
					document.getElementById('passmatch').style.color = '#FF0000';
				}
			};
        
</script>
<?php
printmenu ( "author" );
?>

</head>
</br>

<?php
if (isset ( $_SESSION ["username"] )) {
	?>

<div class="CSSTableGenerator">
	<table>
		<tr>
			<td>Change Password</td>
		</tr>
	</table>
</div>
<br />
<br />
<div align='center'>
<?php
	if (! (isset ( $_POST ["password"] ))) {
		?>
<form action="" method="post">
		<p style='font-family: arial; font-size: 15px;'>
			Current Password : <input type="password" name="password" />
		</p>
		<p style='font-family: arial; font-size: 15px;'>
			New Password : <input id="newpasswd1" name="newpasswd1"
				type="password" />
		</p>
		<p style='font-family: arial; font-size: 15px;'>
			Confirm New Password : <input id="newpasswd2" name="newpasswd2"
				onkeyup="passcheck()" type="password" />
		</p>
		<b><p id="passmatch"></p></b> <input class="SmallButton" type="submit"
			value="Change" />
	</form>
<?php
	} else {
		$username = $_SESSION ["username"];
		$password = $_POST ["password"];
		$newpasswd1 = $_POST ["newpasswd1"];
		$newpasswd2 = $_POST ["newpasswd2"];
		$hashed = md5 ( $password );
		$result = mysql_query ( "SELECT * from users where username='" . $username . "' AND password='" . $hashed . "';" );
		
		if ($row = mysql_fetch_array ( $result )) {
			if ($newpasswd1 != $newpasswd2) {
				echo ("<p style='font-family:arial;font-size:15px;'>Passwords don't match.<br/><br/><a href='change_password.php'>Click here to try again.<a/></p>");
			} else if (strlen ( $newpasswd1 ) <= 6) {
				echo ("<p style='font-family:arial;font-size:15px;'>New password is too short.<br/><br/><a href='change_password.php'>Click here to try again.<a/></p>");
			} else {
				$hashed = md5 ( $newpasswd1 );
				$result = mysql_query ( "UPDATE users SET password='$hashed' WHERE username='$username' ", $con );
				if (! $result) {
					echo "No new entries made !!!";
				} else {
					echo ("<p style='font-family:arial;font-size:15px;'>Password has been changed.<br/><br/></p>");
				}
			}
		} else {
			echo ("<p style='font-family:arial;font-size:15px;'>Password is incorrect.<br/><br/><a href='change_password.php'>Click here to try again.<a/></p>");
		}
		?>
<?php
	}
	?>
	</div>
<?php
} else {
	?>


<div align='center'>
	<p style='font-family: arial; font-size: 15px;'>You have to be logged
		in to access this feature.</p>
</div>

<?php
}
?>

<?php include("includes/footer.html"); ?>
</html>
