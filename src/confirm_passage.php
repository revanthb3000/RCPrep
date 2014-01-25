<?php
session_start ();
?>

<?php
if (! isset ( $_SESSION ["username"] )) {
	?>
<title>Author Section - Prepare for GMAT GRE TOEFL SAT CAT</title>
<div align='center'>
	<p style='font-family: arial; font-size: 15px;'>You have to be logged
		in to access this feature.</p>
</div>
<?php
	exit ();
}
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

<title>Submit a passage</title>

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
<script language="javaScript" type="text/javascript"
	src="datavalidation.js"></script>

<?php
printmenu ( "author" );
?>

</head>
</br>

<div class="CSSTableGenerator">
	<table>
		<tr>
			<td>Submit a passage</td>
		</tr>
	</table>
</div>

<br />
<br />

<?php
if (isset ( $_POST ["dbaction"] )) {
	$passage = $_POST ["passage"];
	$passage = mysql_real_escape_string ( $passage );
	$result = mysql_query ( "INSERT INTO passages(content) VALUES('" . $passage . "')", $con );
	$result = mysql_query ( "Select LAST_INSERT_ID();" );
	$pid = 0;
	if ($row = mysql_fetch_array ( $result )) {
		$pid = $row [0];
	}
	$username = $_SESSION ["username"];
	$result = mysql_query ( "INSERT INTO authors(username,passage_id) VALUES('" . $username . "'," . $pid . ")", $con );
	$num_questions = $_POST ["num_questions"];
	$i = 1;
	while ( $i <= $num_questions ) {
		$question = $_POST ["question" . $i];
		$question = mysql_real_escape_string ( $question );
		
		$optionA = $_POST ["A" . $i];
		$optionA = mysql_real_escape_string ( $optionA );
		
		$optionB = $_POST ["B" . $i];
		$optionB = mysql_real_escape_string ( $optionB );
		
		$optionC = $_POST ["C" . $i];
		$optionC = mysql_real_escape_string ( $optionC );
		
		$optionD = $_POST ["D" . $i];
		$optionD = mysql_real_escape_string ( $optionD );
		
		$optionE = $_POST ["E" . $i];
		$optionE = mysql_real_escape_string ( $optionE );
		
		$answer = $_POST ["answer" . $i];
		$answer = mysql_real_escape_string ( $answer );
		
		$result = mysql_query ( " INSERT INTO `questions`(`passage_id`, `question`, `optionA`, `optionB`, `optionC`, `optionD`, `optionE`, `answer`) VALUES (" . $pid . ", '" . $question . "' , '" . $optionA . "' , '" . $optionB . "' , '" . $optionC . "' , '" . $optionD . "' , '" . $optionE . "', '" . $answer . "' ); ", $con );
		$i ++;
	}
	echo ("<div align='center'><p style='font-family:arial;font-size:15px;'>Your passage has been added. Thank you !! <br/><br/><a href='login.php'>Click here to go to the author home page.<a/></p></div></html>");
	exit ();
}
?>

<?php
if (isset ( $_POST ["num_questions"] )) {
	$passage = $_POST ["passage"];
	?>
	<form action="" method="post">
	<div id="Analysis" class="CSSTableGenerator">
		<table>
			<tr>
				<td>Passage</td>
				<td>Questions</td>
			</tr>
			<tr>
				<td>
					<div style="overflow: auto; height: 500px;"><?php echo $passage; ?></div>
				</td>
				<td>
					<div style="overflow: auto; height: 500px;">
	<?php
	$num_questions = $_POST ["num_questions"];
	$i = 1;
	echo ("<input name='passage' type='hidden' value='$passage'/>");
	echo ("<input name='num_questions' type='hidden' value='$num_questions'/>");
	echo ("<input name='dbaction' type='hidden' value='insert'/>");
	while ( $i <= $num_questions ) {
		$question = $_POST ["question" . $i];
		$optionA = $_POST ["A" . $i];
		$optionB = $_POST ["B" . $i];
		$optionC = $_POST ["C" . $i];
		$optionD = $_POST ["D" . $i];
		$optionE = $_POST ["E" . $i];
		$answer = $_POST ["answer" . $i];
		
		echo ("<input name='question$i' type='hidden' value='$question'/>");
		echo ("<input name='A$i' type='hidden' value='$optionA'/>");
		echo ("<input name='B$i' type='hidden' value='$optionB'/>");
		echo ("<input name='C$i' type='hidden' value='$optionC'/>");
		echo ("<input name='D$i' type='hidden' value='$optionD'/>");
		echo ("<input name='E$i' type='hidden' value='$optionE'/>");
		echo ("<input name='answer$i' type='hidden' value='$answer'/>");
		echo ("" . $i . ". $question<br/>");
		
		echo ("<b>(A) </b>$optionA<br/>");
		echo ("<b>(B) </b>$optionB<br/>");
		echo ("<b>(C) </b>$optionC<br/>");
		echo ("<b>(D) </b>$optionD<br/>");
		echo ("<b>(E) </b>$optionE<br/>");
		echo ("Answer is :  $answer<br/><br/>");
		$i ++;
	}
	?>
			<br /> <br />
					</div>
				</td>
			</tr>
		</table>
	</div>

	<div align='center'>
		<br /> <input class="SmallButton" type="submit" value="Confirm" />

</form>
<br />
<br />
<form action="submit_passage.php" method="post">
			<?php
	$num_questions = $_POST ["num_questions"];
	$i = 1;
	echo ("<input name='passage' type='hidden' value='$passage'/>");
	echo ("<input name='num_questions' type='hidden' value='$num_questions'/>");
	while ( $i <= $num_questions ) {
		$question = $_POST ["question" . $i];
		$optionA = $_POST ["A" . $i];
		$optionB = $_POST ["B" . $i];
		$optionC = $_POST ["C" . $i];
		$optionD = $_POST ["D" . $i];
		$optionE = $_POST ["E" . $i];
		$answer = $_POST ["answer" . $i];
		
		echo ("<input name='question$i' type='hidden' value='$question'/>");
		echo ("<input name='A$i' type='hidden' value='$optionA'/>");
		echo ("<input name='B$i' type='hidden' value='$optionB'/>");
		echo ("<input name='C$i' type='hidden' value='$optionC'/>");
		echo ("<input name='D$i' type='hidden' value='$optionD'/>");
		echo ("<input name='E$i' type='hidden' value='$optionE'/>");
		echo ("<input name='answer$i' type='hidden' value='$answer'/>");
		$i ++;
	}
	?>
		<input class="SmallButton" type="submit" value="Edit and update" />
</form>
</div>

<?php
} else {
	?>
<div align='center'>
	<p style='font-family: arial; font-size: 15px;'>Nothing was submitted.</p>
</div>
<?php
}
mysql_close ( $con );
?>

<?php include("includes/footer.html"); ?>
</html>
