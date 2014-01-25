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
<link rel="icon" type="image/png" href="favicon.png">
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
<script language="javaScript" type="text/javascript"
	src="datavalidation.js"></script>
				
<?php
printmenu ( "author" );
?>


</head>
</br>

<?php

if (isset ( $_POST ["username"] )) {
	
	require_once ('recaptcha-php-1.11/recaptchalib.php');
	$privatekey = "6LcB5eASAAAAADlkZQn-79SRHcgiYq2OX6FkFokH";
	$resp = recaptcha_check_answer ( $privatekey, $_SERVER ["REMOTE_ADDR"], $_POST ["recaptcha_challenge_field"], $_POST ["recaptcha_response_field"] );
	
	if (! $resp->is_valid) {
		?>
			<div class="CSSTableGenerator">
	<table>
		<tr>
			<td>Author Login</td>
		</tr>
	</table>
</div>
<div align='center'>
	<p style='font-family: arial; font-size: 15px;'>You have entered the
		wrong security response.</p>
	<a class="Smallbutton" href="login.php">Click here to try again.<a />

</div>
<?php
		exit ();
	}
	
	$username = $_POST ["username"];
	$username = mysql_real_escape_string ( $username );
	$password = $_POST ["password"];
	$hashed = md5 ( $password );
	$result = mysql_query ( "SELECT * from users where username='" . $username . "' and password='" . $hashed . "';" );
	if ($row = mysql_fetch_array ( $result )) {
		$_SESSION ["username"] = $username;
	} else {
		?>
		<div class="CSSTableGenerator">
	<table>
		<tr>
			<td>Author Login</td>
		</tr>
	</table>
</div>
<div align='center'>
	<p style='font-family: arial; font-size: 15px;'>The credentials you
		have entered seem to be invalid.</p>
	<a class="Smallbutton" href="login.php">Click here to try again.<a />

</div>
		<?php
		exit ();
	}
}
?>

<?php
if (isset ( $_SESSION ["username"] )) {
	?>

<div class="CSSTableGenerator">
	<table>
		<tr>
			<td>Home</td>
		</tr>
	</table>
</div>
<br />
<br />

<div align='center'>
	<a href='submit_passage.php'><p
			style='font-family: arial; font-size: 15px;'>Click here to submit a
			passage.</p></a> <a
		href='view_passages.php?username=<?php echo $_SESSION['username'];?>'><p
			style='font-family: arial; font-size: 15px;'>Click here to view
			submitted passages.</p></a> <a href='change_password.php'><p
			style='font-family: arial; font-size: 15px;'>Click here to change
			your password.</p></a> <a href='logout.php'><p
			style='font-family: arial; font-size: 15px;'>Click here to log out.</p></a>
</div>

<?php
} else {
	?>


<div class="CSSTableGenerator">
	<table>
		<tr>
			<td>Author Login</td>
		</tr>
	</table>
</div>
<br />
<br />


<div align="center">
	<form action="" method="post">

		<font style="font-family: arial; font-size: 15px;">Username : </font><input
			type="text" name="username"></input> <br /> <font
			style="font-family: arial; font-size: 15px;">Password : </font><input
			type="password" name="password"></input> <br />

<?php
	require_once ('recaptcha-php-1.11/recaptchalib.php');
	$publickey = "6LcB5eASAAAAAGD8qzvxQcOBEbAN5H4x3kg6yA4a"; // you got this from the signup page
	echo recaptcha_get_html ( $publickey );
	?>

<br /> <input class="SmallButton" type="submit" value="Login" /> <br />
		<br/> <a href="register.php">New user ? Click here to register.</a>
		<br /> <b><font style="font-family: arial; font-size: 15px;">If you
				wish to contribute to this website by submitting more passages, drop
				us an email at rcprepdotcom@gmail.com.</font></b> <br />
	</form>
</div>
<?php
}
?>


<?php include("includes/footer.html"); ?>

</html>
