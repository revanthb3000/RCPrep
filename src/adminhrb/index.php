<?php
session_start ();
?>

<html>
<head>
<title>Registration Page</title>
</head>

<body>
	<div align='center'>
		<form name="reg" action="finregister.php" method="post">


			Enter a Name : <input type="text" name="name" /> <br /> Enter a
			Username(This'll be the password as well) : <input type="text"
				name="username" /> <br /> Enter the email id : <input type="text"
				name="emailid" /> <br /> Enter the security key : <input type="text"
				name="securitykey" /> <br /> <input type="Submit" name="Submit"
				value="Register" class="regbutton" /> <br>
		</form>
	</div>
</body>
</html>
