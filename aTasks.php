<?php 
require_once('EconnectDB.php');
require_once('adminMenu.php'); 

?>

	<!DOCTYPE html>
	<html>
	<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="css/tableStyles.css" rel="stylesheet" type="text/css">
	<link href="css/menuStyle.css" rel="stylesheet" type="text/css">
		<title>Tasks</title>
	</head>
	<body>

	<?php



	//$query_clients = "SELECT * FROM Client;";
	//$records_clients = get_records_from_query($query_clients);
	//$query_projects = "SELECT * FROM Project;";
	//$records_projects = get_records_from_query($query_projects);
	$query_tasks = "SELECT T.task_id, T.task_name, P.project_name FROM Task T, Project P WHERE T.project_Id = P.project_Id AND P.project_status = 0;";
	$records_tasks = get_records_from_query($query_tasks);
	$query_employees = "SELECT * FROM Employee;";
	$records_employees = get_records_from_query($query_employees);
	//$query_assignment = "SELECT 'A.assignment_id', 'T.task_name' , 'P.project_name' ,'E.employee_name', 'A.due_date' FROM Assignment A, Task T, Project P, Employee E WHERE 'A.employee_id = E.employee_id' and 'A.task_id = T.task_id' and 'A.project_Id = P.project_Id';";
	//$query_assignment = "SELECT * FROM Assignment";
	//$records_assignments = get_records_from_query($query_assignment);

	// handle second form here
	if (isset($_POST['Assign'])) {
	     	 //	$Project_Name = $_POST['project_name'];
	    	  	$Task_id = $_POST['task'];
	    	  	$Employee_id = $_POST['employee'];
	     	 	$Due_Date = $_POST['DueDate'];

	 	$query_getProject_Id = get_one_record_from_query("SELECT project_Id FROM Task WHERE task_id ='{$Task_id}';");
	 	$record_getProjectID = $query_getProject_Id['project_Id'];
	

	//step 4 
	//the project, task, and employee ID's associated with the project, task, and employee name's selected
	 //from the dropdowns to store in the Assignment table in the database

 
	//$query_getProjectID = get_one_record_from_query("SEL//$query_getProjectID = $query_getProjectID['project_id'];ECT project_id FROM Project WHERE project_name='{$Project_Name}';");
	

	//$query_getTaskID = get_one_record_from_query("SELECT task_id, project_Id, task_name FROM Task WHERE task_name='{$Task_Name};");
	//$query_getTaskID = $query_getTaskID['task_id'];

	//$query_getEmployeeID = get_one_record_from_query("SELECT employee_id FROM Employee WHERE employee_name='{$Employee_Name}';");
	//$query_getEmployeeID = $query_getEmployeeID['employee_id'];
	  
		$query_assignment = "INSERT INTO Assignment (task_id, project_id, employee_id, due_date) 
		VALUES ('{$Task_id}','{$record_getProjectID}','{$Employee_id}','{$Due_Date}')";


		$result = run_query($query_assignment);
		if ($result) {
		$message =  "<p>Successfully added new assignment!</p>";
	    }

	 }
	//Step 5 - display the information from the Assignment table onto the website
	//since the assignment table stores basically just ID's, we need to grab the associated project names and employee names
	//to display on the website along with the task name that is in the assignment table

	//$query_displayAssignments = "SELECT p\.project_name, t\.task_name, e\.employee_name FROM Assignment a, Project p, Task t, Employee e WHERE a\.project_Id=p\.project_Id AND a\.task_id=t\.task_id AND a\.employee_id=e\.employee_id";
	//$records_displayAssignments=get_records_from_query($query_displayAssignments);

	//getting a syntax error with the above query, tried to replace it with the query below but that also didn't work

	//$query_displayAssignments = "SELECT Project.project_name, Task.task_name, Employee.employee_name FROM Project, Task, Employee FULL OUTER JOIN Assignment on Project.project_id = Assignment.project_id AND FULL OUTER JOIN Assignment on Task.task_id = Assignment.task_id AND FULL OUTER JOIN Assignment on Employee.employee_id = Assignment.employee_id;";
	//$query_assinment_amy = 'SELECT Project.project_name, Task.task_name, Assignment.employee_id 
	//						FROM Project FULL INNER JOIN on Task WHERE Project.project_Id = Task.project_Id AND
	//						FROM Task FULL INNER JOIN on Assignment WHERE Task.task_id = Assignment.task_id 
	//						WHERE 


	//$records_displayAssignments=get_records_from_query($query_displayAssignments);



//Step 5 new version --> just display everything in the assignment table to make it easier for now
	    //this way at least we have something on the page that is functional 


	//$query_assignment = "SELECT * FROM Assignment";
	
	$query_assignment = "SELECT A.assignment_id, A.task_id, T.task_name , P.project_name , E.employee_name, A.due_date FROM Assignment A, Task T, Project P, Employee E WHERE A.task_id = T.task_id and A.project_Id = P.project_Id and A.employee_id = E.employee_id;";

	$records_assignments = get_records_from_query($query_assignment);

	?>
	<h1>Task Assignments</h1>
	 <table>
	  <tr>
	    <th>Task</th><th>Project</th><th>Employee</th><th>Due Date</th>
	    <?php foreach ($records_assignments as $record_assignment) {
					echo "<tr>";
					//echo "<td>{$record_assignment['assignment_id']}</td>";
					echo "<td>{$record_assignment['task_name']}</td>";
					echo "<td>{$record_assignment['project_name']}</td>";
					echo "<td>{$record_assignment['employee_name']}</td>";
					echo "<td>{$record_assignment['due_date']}</td>";
			
									}
			?>
	</table>



	<form action="aTasks.php" method="POST">
	    
	   <!--  <th><select name= "project_name" onChange="getId(this.value);">
	    <?php foreach ($records_projects as $record_project) { ?> 
	        <option value="<?php echo $record_project['project_name']; ?>"><?php echo $record_project['project_name']; ?></option>
	        <?php } ?>
	    </select></th> -->
	    
	    
	    <th><select name= "task" id="taskList">
	    <?php foreach ($records_tasks as $record_task) { ?> 
	       
	        <option value="<?php echo $record_task['task_id']; ?>"><?php echo $record_task['task_name']; ?> - <?php echo $record_task['project_name']; ?></option>
	        
	        <?php } ?>
	    </select></th>
	    
	     <th><select name= "employee">
	    <?php foreach ($records_employees as $record_employee) { ?> 
	        <option value="<?php echo $record_employee['employee_id']; ?>"><?php echo $record_employee['employee_name']; ?></option>
	        <?php } ?>
	    </select></th>
	      <input type="date" name="DueDate" placeholder="Due Date">
	       <input type="submit" name="Assign" value="Assign">
	</form>
	     
	    


	<?php 

	if (isset($message)) {
		echo $message;
	}


	  ?>



	
	</body>
	</html>