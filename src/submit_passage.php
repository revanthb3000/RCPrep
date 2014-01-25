<?php
session_start ();
?>

<?php
if (! isset ( $_SESSION ["username"] )) {
	?>
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
if (isset ( $_POST ["num_questions"] )) {
	?>
	<form action="confirm_passage.php" method="post">
	<div id="Analysis" class="CSSTableGenerator">
		<table>
			<tr>
				<td>Passage</td>
				<td>Questions</td>
			</tr>
			<tr>
				<td>
					<div style="overflow: auto; height: 500px;">
						<textarea name="passage" style="width: 100%; height: 99%"
							onFocus="if(this.value=='Your passage goes here')this.value=''; return false;"><?php if(isset($_POST["passage"])){ echo $_POST["passage"]; }else { echo ("Your passage goes here");}?></textarea>
					</div>
				</td>
				<td>
					<div style="overflow: auto; height: 500px;">
<?php
	$num_questions = $_POST ["num_questions"];
	echo ("<input type='hidden' value='$num_questions' name='num_questions'/>");
	$i = 1;
	
	while ( $i <= $num_questions ) {
		echo ("" . $i . "<textarea name='question$i' style='width:93%;height:20px' onFocus=\"if(this.value=='Enter the question here')this.value=''; return false;\">");
		if (isset ( $_POST ["question" . $i] )) {
			echo $_POST ["question" . $i];
		} else {
			echo ("Enter the question here");
		}
		echo ("</textarea><br/>");
		
		echo ("<b>(A) </b><textarea name='A$i' style='width:93%;height:20px'>");
		if (isset ( $_POST ["A" . $i] )) {
			echo $_POST ["A" . $i];
		}
		echo ("</textarea><br/>");
		
		echo ("<b>(B) </b><textarea name='B$i' style='width:93%;height:20px'>");
		if (isset ( $_POST ["B" . $i] )) {
			echo $_POST ["B" . $i];
		}
		echo ("</textarea><br/>");
		
		echo ("<b>(C) </b><textarea name='C$i' style='width:93%;height:20px'>");
		if (isset ( $_POST ["C" . $i] )) {
			echo $_POST ["C" . $i];
		}
		echo ("</textarea><br/>");
		
		echo ("<b>(D) </b><textarea name='D$i' style='width:93%;height:20px'>");
		if (isset ( $_POST ["D" . $i] )) {
			echo $_POST ["D" . $i];
		}
		echo ("</textarea><br/>");
		
		echo ("<b>(E) </b><textarea name='E$i' style='width:93%;height:20px'>");
		if (isset ( $_POST ["E" . $i] )) {
			echo $_POST ["E" . $i];
		}
		echo ("</textarea><br/>");
		
		$myanswer = "None";
		if (isset ( $_POST ["answer" . $i] )) {
			$myanswer = $_POST ["answer" . $i];
		}
		
		echo ("Answer :  <select name='answer$i' >
			<option value='A' ");
		if ($myanswer == "A") {
			echo ("selected='selected'");
		}
		echo (">A</option>
			<option value='B' ");
		if ($myanswer == "B") {
			echo ("selected='selected'");
		}
		echo (">B</option>
			<option value='C' ");
		if ($myanswer == "C") {
			echo ("selected='selected'");
		}
		echo (">C</option>
			<option value='D' ");
		if ($myanswer == "D") {
			echo ("selected='selected'");
		}
		echo (">D</option>
			<option value='E' ");
		if ($myanswer == "E") {
			echo ("selected='selected'");
		}
		echo (">E</option>
			</select><br/><br/>");
		$i ++;
	}
	?>
			<br /> <br />
<?php
	mysql_close ( $con );
	?>
	</div>
				</td>
			</tr>
		</table>
	</div>
	<div class="SubmitButton">
		<input type="submit" value="Submit" />
	</div>
</form>
<?php
} else {
	?>
<div align='center'>
	<form action="" method="post">
		<font style="font-family: arial; font-size: 15px;">Enter the number of
			questions : </font><input id='questions' type="text"
			name="num_questions"
			onkeypress="return checkifint(event,'questions')"></input> <br /> <br />
		<input class="SmallButton" type="submit" value="Next" />

	</form>
</div>
<?php
}
?>
<?php include("includes/footer.html"); ?>
</html>
