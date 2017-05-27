<?php 
require_once('EconnectDB.php');
require_once('employeeMenu.php'); 

$currentEmp= $_SESSION['employee_id'];

if (isset($_POST['submit'])) {

		$task_id = $_POST['task'];
		$date = $_POST['date'];
		$hours = $_POST['hours_worked'];
	
	$query_getProject_Id = get_one_record_from_query("SELECT project_Id FROM Task WHERE task_id ='{$task_id}';");
	$record_getProjectID = $query_getProject_Id['project_Id'];
	
	$query_insert = "INSERT INTO Timesheet (employee_id, task_id, date_of_work, hours_worked, project_Id) VALUES ('{$currentEmp}', '{$task_id}', '{$date}', '{$hours}', '{$record_getProjectID}');";
	
  	$result_insert = run_query($query_insert);
	if ($result_insert) {
		$message = "<p>Successfully entered hours!</p>";
	}
}
	

// if (isset($message)) { 
//   		echo $message;
// 	}


//table of entered hours 
$query = "SELECT P.project_name, T.task_name, TS.date_of_work, TS.hours_worked FROM Timesheet TS, Project P, Task T 
		  WHERE TS.employee_id = '$currentEmp' and TS.project_Id = P.project_Id and TS.task_id = T.task_Id
		  ORDER BY date_of_work DESC;";
$records =  get_records_from_query($query);
	

//this will show tasks assigned to the employee in drop downs
$query_tasks = "SELECT P.project_name, T.task_name, A.task_id FROM Assignment A, Project P, Task T 
				WHERE A.employee_id = '$currentEmp'
				  AND A.task_id = T.task_id
				  AND A.project_Id = P.project_Id;";
$records_tasks = get_records_from_query($query_tasks);

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Timesheet</title>
<link href="css/tableStyles.css" rel="stylesheet" type="text/css">
<link href="css/menuStyle.css" rel="stylesheet" type="text/css">
<script>document.form.reset();</script>
</head>

<body>
<!--will insert into table timesheet the hours worked by the employee on the task	-->

   
<form action="eTimeSheet.php" method="POST">
<!-- show drop down of task_id's from the assignemnt table -->
   
    <select name ="task">
		<?php foreach ($records_tasks as $record_tasks) { ?>
			<option value="<?php echo $record_tasks['task_id'];?>"><?php echo $record_tasks['project_name'];?> - <?php echo $record_tasks['task_name'];?></option>
		<?php }?>
	</select>   
     
      <input type="date" name="date">
      <input type="numeric" name="hours_worked" placeholder="Enter Hours Worked">
      <input type="submit" name="submit">
   
</form>

<!--table of hours entered by the employee-->
<p>Pay Period Timesheet</p>  
	<table>
		<th>Project</th><th>Task</th><th>Date</th><th>Hours Worked</th>
		<?php
			foreach ($records as $record) {
				echo "<tr>";
				echo "<td>{$record['project_name']}</td>";
				echo "<td>{$record['task_name']}</td>";
				echo "<td>{$record['date_of_work']}</td>";
				echo "<td>{$record['hours_worked']}</td></tr>";
			}
		?>
	</table>
	


</body>
</html>