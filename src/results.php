<?php session_start(); ?>

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
<title>Result</title>
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

<?php
printmenu ( "passages" );
?>
</head>
</br>

<div class="CSSTableGenerator">
	<table>
		<tr>
			<td>Result</td>
		</tr>
	</table>
</div>

<br />
<br />

<div align="center">

<?php
if (! (isset ( $_POST ["pid"] ))) {
	echo ("<p style='font-family:arial;font-size:15px;'>Nothing was submitted.</p>");
} else {
	if (! isset ( $_SESSION ["timeelapsed"] )) {
		$timeelapsed = time () - $_POST ["time"];
		$_SESSION ['timeelapsed'] = $timeelapsed;
	} else {
		$timeelapsed = $_SESSION ['timeelapsed'];
	}
	?>
	<p style="font-family: arial; font-size: 15px;">Total time taken  : <?php
	$seconds = $timeelapsed % 60;
	$minutes = $timeelapsed / 60;
	if ($minutes != 0) {
		echo ( int ) $minutes . " min ";
	}
	echo $seconds . " sec."?>

	 </p>
	<form action="analysis.php" method="post">
		<table class="ResultTable">
			<tr>
				<td>Question</td>
				<td>Your Answer</td>
				<td>Correct Answer</td>
				<td>Result</td>
			</tr>
<?php
	$pid = $_POST ["pid"];
	echo ("<input type='hidden' name='pid' value='$pid'/>");
	
	$pid = mysql_real_escape_string ( $pid );
	$result = mysql_query ( "SELECT content from passages where id=" . $pid );
	$passage = "";
	while ( $row = mysql_fetch_array ( $result ) ) {
		// echo ("Passage is : <br/><br/>".$row['content'] );
		$passage = $row ['content'];
	}
	$query = "SELECT * from questions where passage_id=" . $pid . " ORDER BY question_id ASC;";
	$result = mysql_query ( $query );
	$i = 1;
	$total_score = 0;
	while ( $row = mysql_fetch_array ( $result ) ) {
		echo ("<tr> <td>" . $i . "</td>");
		$useranswer = "Not Answered";
		if (isset ( $_POST [( string ) $i] )) {
			$useranswer = $_POST [( string ) $i];
		}
		echo ("<input type='hidden' name='$i' value='$useranswer'/>");
		$correctanswer = $row ["answer"];
		$score = "<img src='images/wrong.png'/>";
		if ($useranswer == $correctanswer) {
			$score = "<img src='images/correct.png'/>";
			$total_score ++;
		}
		echo ("<td>" . $useranswer . "</td>");
		echo ("<td>" . $correctanswer . "</td>");
		echo ("<td>" . $score . "</td> </tr>");
		$i ++;
	}
	$i --;
	?>
    </table>
		<br />
		<p style="font-family: arial; font-size: 16 px;">Your total score is : <?php echo $total_score."/".$i."."; ?> </p>
		<p style="font-family: arial; font-size: 16 px;">Here's an analysis :
		</p>
	</form>
</div>

<div id="Analysis" class="CSSTableGenerator">
	<table>
		<tr>
			<td>Passage</td>
			<td>Questions</td>
		</tr>
		<tr>
			<td>
				<div style="overflow: auto; height: 500px;"> <?php  echo $passage;  ?>	</div>
			</td>
			<td>
				<div style="overflow: auto; height: 500px;">
<?php
	$result = mysql_query ( "SELECT * from questions where passage_id=" . $pid . " ORDER BY question_id ASC;" );
	$i = 1;
	
	$colors [0] = "";
	$colors [1] = "#F7E259";
	$colors [2] = "#ED534F";
	$colors [3] = "#73D549";
	
	while ( $row = mysql_fetch_array ( $result ) ) {
		echo ("" . $i . ". " . $row ['question'] . "<br/>");
		$useranswer = "";
		if (isset ( $_POST [( string ) $i] )) {
			$useranswer = $_POST [( string ) $i];
		}
		$correctanswer = $row ["answer"];
		$acolor = 0;
		$bcolor = 0;
		$ccolor = 0;
		$dcolor = 0;
		$ecolor = 0;
		if ($correctanswer == "A") {
			$acolor = 1;
		} else if ($correctanswer == "B") {
			$bcolor = 1;
		} else if ($correctanswer == "C") {
			$ccolor = 1;
		} else if ($correctanswer == "D") {
			$dcolor = 1;
		} else if ($correctanswer == "E") {
			$ecolor = 1;
		}
		
		if ($useranswer == "A") {
			$acolor = 2;
			if ($useranswer == $correctanswer) {
				$acolor = 3;
			}
		} else if ($useranswer == "B") {
			$bcolor = 2;
			if ($useranswer == $correctanswer) {
				$bcolor = 3;
			}
		} else if ($useranswer == "C") {
			$ccolor = 2;
			if ($useranswer == $correctanswer) {
				$ccolor = 3;
			}
		} else if ($useranswer == "D") {
			$dcolor = 2;
			if ($useranswer == $correctanswer) {
				$dcolor = 3;
			}
		} else if ($useranswer == "E") {
			$ecolor = 2;
			if ($useranswer == $correctanswer) {
				$ecolor = 3;
			}
		}
		
		echo ("<b>(A) </b><font style='BACKGROUND-COLOR: $colors[$acolor]'>" . $row ['optionA'] . "</font><br/>");
		echo ("<b>(B) </b><font style='BACKGROUND-COLOR: $colors[$bcolor]'>" . $row ['optionB'] . "</font><br/>");
		echo ("<b>(C)</b><font style='BACKGROUND-COLOR: $colors[$ccolor]'>" . $row ['optionC'] . "</font><br/>");
		echo (" <b>(D)</b> <font style='BACKGROUND-COLOR: $colors[$dcolor]'>" . $row ['optionD'] . "</font><br/>");
		echo ("<b>(E)</b> <font style='BACKGROUND-COLOR: $colors[$ecolor]'>" . $row ['optionE'] . "</font><br/><br/>");
		$i ++;
	}
	?>
		<br /> <br />
<?php
}
mysql_close ( $con );
?>
</div>
			</td>
		</tr>
	</table>
</div>


<br />
<br />
<div align='center'>
	<p style='font-family: arial; font-size: 15px;'>
		<font style='BACKGROUND-COLOR: #ED534F'> &nbsp &nbsp </font>&nbsp -
		represents your answer which was wrong.
	</p>
	<p style='font-family: arial; font-size: 15px;'>
		<font style='BACKGROUND-COLOR: #73D549'> &nbsp &nbsp </font> &nbsp -
		represents your answer which was correct.
	</p>
	<p style='font-family: arial; font-size: 15px;'>
		<font style='BACKGROUND-COLOR: #F7E259'> &nbsp &nbsp </font> &nbsp -
		represents the correct answer.
	</p>
	<br /> <a class="SmallButton" href="passages.php">Click here to solve
		another passage<a />

</div>
<br />
<br />
<?php include("includes/footer.html"); ?>
</html>
