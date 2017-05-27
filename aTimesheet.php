<?php require_once('EconnectDB.php');
require_once('adminMenu.php'); 

$query_tasks = "SELECT T.task_id, T.task_name, P.project_name FROM Task T, Project P WHERE T.project_Id = P.project_Id";
	$records_tasks = get_records_from_query($query_tasks);
	$query_employees = "SELECT * FROM Employee;";
	$records_employees = get_records_from_query($query_employees);
	$query_timesheets = "SELECT TS.date_of_work, t.task_name, p.project_name, TS.hours_worked, e.employee_name 
	FROM Timesheet TS, Task t, Project p, Employee e 
	WHERE TS.task_id = t.task_id AND t.project_Id = p.project_Id AND e.employee_id = TS.employee_id ORDER BY TS.date_of_work DESC, e.employee_name DESC;";
	$records_timesheets = get_records_from_query($query_timesheets);
	

	
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="css/tableStyles.css" rel="stylesheet" type="text/css">
<link href="css/menuStyle.css" rel="stylesheet" type="text/css">
<title>Timesheets</title>
</head>

<body>


	

<h1>Employee Timesheets</h1>

 <form action="aTimesheet.php" method="POST">
	    </select></th>
	      <input type="date" name="Start_Date" placeholder="Start Date">
           <input type="date" name="End_Date" placeholder="End Date">
              <th><select name= "Employee_ID">
	    <?php foreach ($records_employees as $record_employee) { ?> 
	        <option value="<?php echo $record_employee['employee_id']; ?>"><?php echo $record_employee['employee_id']; ?></option>
	        <?php } ?>
	    </select></th>
	       <input type="submit" name="Search" value="Search">
		</form>
   <table> 


   <?php
   		if (isset($_POST['Search'])) {
	     	 	$Start_Date = $_POST['Start_Date'];
	    	  	$End_Date = $_POST['End_Date'];
	    	  	$Employee_ID= $_POST['Employee_ID'];

	 $query_timesheets = "SELECT * FROM Timesheet WHERE employee_id='{$Employee_ID}'AND date_of_work between '{$Start_Date}' AND '{$End_Date}';";
	 $run_query= $query_timesheets;
	$records_timesheets = get_records_from_query($query_timesheets); }
   ?>


		<th>Employee ID</th><th>Task Id</th><th>Project ID</th><th>Date of Work</th><th>Hours Worked</th><th>Reject</th>
	    <?php 
	    	if (isset($_POST['Search'])) {
			foreach ($records_timesheets as $record_timehsheet) {
					echo "<tr>";
					echo "<td>{$record_timehsheet['employee_id']}</td>";
					echo "<td>{$record_timehsheet['task_id']}</td>";
					echo "<td>{$record_timehsheet['project_Id']}</td>";
					echo "<td>{$record_timehsheet['date_of_work']}</td>";
					echo "<td>{$record_timehsheet['hours_worked']}</td>";		
					
					echo "<td><input type='submit' name='Reject' value = 'Reject'></td>";
					
									} }
			?>
	</table>



	
</body>
</html>