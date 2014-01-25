<?php
ob_start ( "ob_gzhandler" );
session_start ();
session_destroy ();
?>
<!DOCTYPE html>
<html>
<head>
<title>Logged Out</title>
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
include "includes/menu_bar.php";
printmenu ( "author" );
?>
</head>
</br>

<div align='center'>
	<p style='font-family: arial; font-size: 15px;'>You have logged out
		successfully.</p>
</div>
<?php include("includes/footer.html"); ?>
</html>
