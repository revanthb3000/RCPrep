<?php
session_start ();
if (isset ( $_SESSION ['timeelapsed'] )) {
	unset ( $_SESSION ['timeelapsed'] );
}
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
<link rel="stylesheet" href="menu.css" type="text/css" />

<script type="text/javascript">
            function check()
            {
                var msg="Are you sure you wish to submit ?";
				var radios = document.getElementsByTagName('input');
				var value=false;
				var cnt=0;
				var crcnt=0;
				for (var i = 0; i < radios.length; i++) 
				{
					if (radios[i].type == 'radio') 
					{
						cnt++;
					}
				}
				
				for (var i = 0; i < radios.length; i++) 
				{
					if (radios[i].type == 'radio' && (radios[i].checked)) 
					{
						crcnt++;
					}
				}
				
				if(cnt/5!=crcnt)
				{
					msg="You haven't answered all the questions.\n"+msg;
				}
                return confirm(msg);
            }
        </script>
<?php include("includes/fb_likes.php"); ?>

<?php
printmenu ( "author" );
?>
	
		
</head>
</br>
<?php
if (! isset ( $_GET ["pid"] )) {
	echo ("
			<div align='center'>
			<p style='font-family:arial;font-size:15px;'>Nothing was submitted.</p>
			</div>");
	exit ();
}
$pid = $_GET ["pid"];
$pid = mysql_real_escape_string ( $pid );
$result = mysql_query ( "SELECT * from passages where id>=" . $pid );
$passage = "";
while ( $row = mysql_fetch_array ( $result ) ) {
	// echo ("Passage is : <br/><br/>".$row['content'] );
	$passage = $row ['content'];
	$pid = $row ["id"];
	break;
}
$passage = str_replace ( "\n", "<br/><br/>", $passage );
?>
<form action="results.php" method="post" onsubmit="return check()">

	<input type="hidden" value="<?php echo $pid;?>" name="pid" /> <input
		type="hidden" value="<?php echo time();?>" name="time" />

	<div class="CSSTableGenerator">
		<table>
			<tr>
				<td>Passage</td>
				<td>Questions<br /> Time Elapsed : <label id="minutes">00</label>:<label
					id="seconds">00</label>
				</td>
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
while ( $row = mysql_fetch_array ( $result ) ) {
	echo ("" . $i . ". " . $row ['question'] . "<br/><input type='radio' name='" . $i . "' value='A'/> <b>(A) </b>" . $row ['optionA'] . "<br/><input type='radio' name='" . $i . "' value='B'/> <b>(B) </b>" . $row ['optionB'] . "<br/><input type='radio' name='" . $i . "' value='C'/> <b>(C)</b>" . $row ['optionC'] . "<br/><input type='radio' name='" . $i . "' value='D'/> <b>(D)</b> " . $row ['optionD'] . "<br/><input type='radio' name='" . $i . "' value='E'/> <b>(E)</b> " . $row ['optionE'] . "<br/><br/>");
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

<script type="text/javascript">
        var minutesLabel = document.getElementById("minutes");
        var secondsLabel = document.getElementById("seconds");
        var totalSeconds = 0;
        setInterval(setTime, 1000);

        function setTime()
        {
            ++totalSeconds;
            secondsLabel.innerHTML = pad(totalSeconds%60);
            minutesLabel.innerHTML = pad(parseInt(totalSeconds/60));
        }

        function pad(val)
        {
            var valString = val + "";
            if(valString.length < 2)
            {
                return "0" + valString;
            }
            else
            {
                return valString;
            }
        }
</script>


<?php include("includes/footer.html"); ?>
</html>
