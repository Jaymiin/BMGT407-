<?php

	require_once('mysql_functions.php');
	// start a session, so that we can use the $_SESSION array to store information across pages about a logged in user
	session_start();

	 // check if the form was submitted by checking to see if PHP automatically set the $_POST variable
	 // if the form was submitted, we want to run the code to verify their login.
	 // if not, none of the code inside this block runs --> we skip it and don't do anything
	if (isset($_POST['usn'])) {

		$usernameFromForm = $_POST['usn'];
		$passwordFromForm = $_POST['psw'];

		$group_username = "bmgt407_17";
		$group_password = "bmgt407_17";
		$group_database = "bmgt407_17_db";
		// connect to the database with information. Just replace "ta" with your group number (XX)
		connect_to_db($group_username, $group_password, $group_database);

		// construct your query--> note that this does not actually do anything! We need to run the query below.
		$query = "SELECT employee_id, employee_password, employee_title FROM Employee WHERE employee_id = '{$usernameFromForm}'";
	
		// runs the query and returns the one record. We know there should only be one person with a given username
		$record = get_one_record_from_query($query);

		// $record will be false if the query didn't return any records from the database
		if ($record == false) {
			$errorMessage = "username does not exist</br>";
		} else {
			$_SESSION['employee_title'] = $record['employee_title'];
			// if $record is not false, then a record was returned. If so, we want to check if the password from the database matches the password from the form
			if ($passwordFromForm == $record['employee_password']) {
				// they are authenticated --> store the session variable to log them in, and redirect them to the homepage
					$_SESSION['employee_id'] = $usernameFromForm;
				if($_SESSION['employee_title']=="Manager"){
					header('Location: aProfile.php');
				}else if($_SESSION['employee_title']!="Manager"){
					header('Location: eProfile.php');
				}
			} else {
				// passwords don't match
				$errorMessage = "invalid password</br>";
			}
		}

	}

?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>
  <title>InStreamOne Employee Login</title>


<body>
<a href="index.php"><img src="ISO_LOGO.png" alt="Logo"/></a>
  <div class="wrapper">
	<div class="container">
		<h1>Welcome</h1>
		<form class="form" action="eLogin.php" method="POST">
		<?php
					// if there is an errorMessage (from above), display it
					if (isset($errorMessage)){
						echo $errorMessage;
					}
				?>
			<input type="text" placeholder="Username" name="usn" required>
			<input type="password" placeholder="Password" name="psw" required> <!--php will check to see if employee is in database and that USN and password match-->
			<button type="submit" id="login-button">Login</button> <!--after successful login, will take user to profile page-->
		</form>
	</div>
	<!-- design coding, animated bubble background-->
	<ul class="bg-bubbles">
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
	</ul>
</div>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>


</body>
</html>
