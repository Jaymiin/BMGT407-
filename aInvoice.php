<?php require_once('EconnectDB.php');
require_once('adminMenu.php'); 
//run query to retrieve all infomation from Projects table 
$query_projects="SELECT * FROM Project;";
$records_projects=get_records_from_query($query_projects);

?>
	


<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="css/tableStyles.css" rel="stylesheet" type="text/css">
<link href="css/menuStyle.css" rel="stylesheet" type="text/css">
	<title>Invoices</title>
</head>
<body>

<!-- This code creates the form the manager will use to select the project and the dates for which they want to see the hours worked -->
	<p>Step 1: select the date range and project for which you want to see the hours worked and the hourly rate for that project</p>
<form action="aInvoice.php" method="POST">
	
	<input type = "Date" name="Inv_Start_Date" placeholder="Select Start Date">
	<input type = "Date" name="Inv_End_Date" placeholder="Select End Date">
	<select name="ProjectID">
		<option>Select Project ID</option>
		<?php foreach ($records_projects as $record_project) { ?>
			<option value="<?php echo $record_project['project_Id']; ?>"><?php echo $record_project['project_Id']; ?></option> 
			<?php }?>
	</select>
 <input type="submit" name="Show_Data" value="Show Hours">
 </form>


<!-- if the button Show hours is clicked, the variables will be created
the query will be ran, and the table will populate with the employee ID,
task ID, and hours worked from the timesheet where the project ID is that selected and the hours entered are for days between the start
and end date specified  -->
<?php
if (isset($_POST['Show_Data'])) {
	     	 	$Inv_Start_Date = $_POST['Inv_Start_Date'];
	    	  	$Inv_End_Date = $_POST['Inv_End_Date'];
	    	  	$Project_ID= $_POST['ProjectID'];


$query_timesheets = "SELECT * FROM Timesheet WHERE project_Id='{$Project_ID}' AND date_of_work between '{$Inv_Start_Date}' AND '{$Inv_End_Date}';";
$run_query= $query_timesheets;
$records_timesheets = get_records_from_query($query_timesheets);

$query_projects = "SELECT * FROM Project WHERE project_Id='{$Project_ID}';";
$run_query = $query_projects;
$records_projects = get_records_from_query($query_projects);




	    }


?>
<!--show this data in a table -->
<h2>Hours Worked</h2>
<table>
	<th>Employee ID</th><th>Task ID</th><th>Date of Work</th><th>Hours Worked</th>
		<?php
			if (isset($_POST['Show_Data'])) {
			 foreach ($records_timesheets as $record_timesheet) { 
			echo "<tr>";
				echo "<td>{$record_timesheet['employee_id']}</td>";
				echo "<td>{$record_timesheet['task_id']}</td>";
				echo "<td>{$record_timesheet['date_of_work']}</td>";
				echo "<td>{$record_timesheet['hours_worked']}</td>";
}}
?>

<table>
<h2>Project Hourly Rate</h2>
	<th>Project Hourly Rate</th>
		<?php
//	show the hourly rate of the project
			if (isset($_POST['Show_Data'])) {
			 foreach ($records_projects as $record_project) { 
			echo "<tr>";
				echo "<td>{$record_project['project_hrate']}</td>";
}}
?>
	
</table>

<!-- this form will allow the manager to compile the results in the above tables that will be inputted into the invoices table in the database and later used to create the invoice

if a project ID isn't selected and the "show hours" button isn't clicked,
the project ID in the form on the bottom will be blank. However once the top form is filled out and the "Show hours" button is clicked, the project ID will
appear in the bottom form 

 -->
 <p>Step 2: use the above information to create a new invoice for the selected project</p>
 <h2>Invoice Creation</h2>
<form action="aInvoice.php" method="POST">
	<input type = "Date" name="Inv_Date" placeholder="Select Today's Date">
	<input type = "text" name="Project_ID" value= <?php if (isset($_POST['Show_Data'])) { echo "$Project_ID"; }?>>
	<input type = "numeric" name="Total_Hours_Worked" placeholder="Enter Total Hours">
	<input type = "numeric" name="Total_Owed" placeholder="Enter Total Amount Due">
 <input type="submit" name="Create_Invoice" value="Create Invoice">
 </form>



<?php if (isset($_POST['Create_Invoice'])) {
				$Inv_Date = $_POST['Inv_Date'];
	    	  	$Project_ID = $_POST['Project_ID'];
	    	  	$Total_Hours= $_POST['Total_Hours_Worked'];
	    	  	$Total_Owed= $_POST['Total_Owed'];

$query_Insert= "INSERT INTO Invoice (invoice_date, project_Id, project_hworked, invoice_amount) VALUES ('{$Inv_Date}','{$Project_ID}','{$Total_Hours}','{$Total_Owed}');";

$result = run_query($query_Insert);
	 if ($result) {
		 $message = "<p> Successfully Added Invoice Information! </p>"; }


		}
	if(isset($message)) {
	echo $message;
}

	?>
</body>
</html>