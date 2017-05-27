<?php
	/************************ MYSQL FUNCTIONS ************************************
	 * This file contains functions that you can use to do the following:
	 * 1) connect to your database
	 * 2) run an SQL query
	 * 3) return one record from a query
	 * 4) return all the records from a query
	 * 5) return the number of rows returned by a query
	 *
	 * Created by: Andrew Goldberg
	 *****************************************************************************/
	require_once('helper_functions.php');
	$connection = null;
	/**
	 * Connects to the MySQL database. Must pass in your username (BMGT407_XX), your password (BMGT407_XX), and the database to be used (BMGT407_XX_db)
	 */
	function connect_to_db($user, $pass, $db){
		global $connection;
		$host = "bmgt407.rhsmith.umd.edu";
		$connection = mysqli_connect($host, $user, $pass, $db);
		if (mysqli_connect_errno()) {
			echo "Failed to connect to the MySQL database. Try googling the following \"mysql error " . mysqli_connect_errno() . "\"\n";
			exit();
		}

	}

	/**
	 * Runs a query. Use this when you know there are no results from the query (I.E. INSERT and UPDATE statements)
	 */
	function run_query($query){
		global $connection;
		if ($result = mysqli_query($connection, $query)){
			return $result;
		} else {
			echo "Query failed with error number " . mysqli_error($connection) . ". Your query was: \"{$query}\"\n";
			return false;
		}
	}

	/**
	 * Returns one record from a query in an associative array. Use this when you know beforehand that you only want one record.
	 */
	function get_one_record_from_query($query){
		global $connection;
		if ($result = run_query($query)){
			return mysqli_fetch_array($result, MYSQLI_ASSOC);
		}
		return false;
	}

	/**
	 * Returns all the resulting records from a query in a 2 dimensional array.
	 * The results
	 */
	function get_records_from_query($query){
		global $connection;
		$records = array();
		if ($result = run_query($query)){
			while ($record = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				array_push($records, $record);
			}
		}
		return $records;
	}

	/**
	 * Returns the number of records resulting from a query.
	 */
	function get_num_rows($query){
		global $connection;
		if ($result = run_query($query)){
			return mysqli_num_rows($result);
		}
		return 0;
	}

?>