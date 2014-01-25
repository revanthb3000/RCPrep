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
<title>Passages - Prepare for GMAT GRE TOEFL SAT CAT</title>
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
<link rel="stylesheet" href="table.css" type="text/css" />
<link rel="stylesheet" href="result.css" type="text/css" />
<link rel="stylesheet" href="menu.css" type="text/css" />			
<?php include("includes/fb_likes.php"); ?>

<?php
printmenu ( "author" );
?>

</head>
</br>

<div class="CSSTableGenerator">
	<table>
		<tr>
			<td>View Passages</td>
		</tr>
	</table>
</div>
<div align='center'>
<?php
if (isset ( $_GET ["username"] )) {
	$username = $_GET ["username"];
	$username = mysql_real_escape_string ( $username );
	$result = mysql_query ( "SELECT * from authors where username='" . $username . "';" );
	$i = 1;
	while ( $row = mysql_fetch_array ( $result ) ) {
		$temp = $row ["passage_id"];
		echo ("<a href='view_specific_passage.php?pid=$temp'><p style='font-family:arial;font-size:15px;'>Passage #$i</p></a>");
		$i ++;
	}
	if ($i == 1) {
		echo ("<br/><p style='font-family:arial;font-size:15px;'>No passages found.</p>");
	}
} else {
	?>
<p style='font-family: arial; font-size: 15px;'>Nothing was submitted.</p>
<?php
}
?>
</div>
<?php include("includes/footer.html"); ?>
</html>
