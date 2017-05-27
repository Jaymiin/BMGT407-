<?php
session_start();
require_once('mysql_functions.php');

if ((!isset($_SESSION['employee_id']))){

	header('Location: eLogin.php');
	
}
else {
	// Step 2: fill in your database information
		$group_username = "bmgt407_17";
		$group_password = "bmgt407_17";
		$group_database = "bmgt407_17_db";
		// connect to the database with information. Just replace "ta" with your group number (XX)
		connect_to_db($group_username, $group_password, $group_database);

		// construct your query--> note that this does not actually do anything! We need to run the query below.
	// Step 4: write your query

	// Step 5: run your query and get the resulting records
}
?>
