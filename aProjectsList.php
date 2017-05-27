<?php require_once('EconnectDB.php');
require_once('adminMenu.php'); 
//create and insert new project into DB with default status of in progress
if (isset($_POST['Add_Project'])) {
			$Project_ID = $_POST['Project_ID'];
			$Project_Name = $_POST['Project_Name'];
			$Client_ID = $_POST['client_id'];
			$Project_hrate = $_POST['Hourly_Rate'];
			$Project_sdate = $_POST['Start_Date'];
			$Project_edate = $_POST['End_Date'];
			$Project_payterm = $_POST['Pay_Term'];
	$query_insert = "INSERT INTO Project (project_id, project_name, client_id, project_hrate, project_sdate, project_edate, project_payterm, project_status) 
	VALUES ('{$Project_ID}','{$Project_Name}','{$Client_ID}','{$Project_hrate}','{$Project_sdate}','{$Project_edate}','{$Project_payterm}','0');";
	$result = run_query($query_insert);
	if ($result) {
	$message =  "<p>Successfully added new project!</p>";
	}
}

//sets the selected project status to complete
if(isset($_POST['status_complete'])){ 
	$Selected_Project = $_POST['Project_Name']; 

						$query_complete = "UPDATE Project SET project_status=1 WHERE project_name='{$Selected_Project}';"; 
					$result_complete = run_query($query_complete);
	
//if the in progress button is clicked it will set the status of the selected project to in progress	
}
if(isset($_POST['status_progress'])){ 
	$Selected_Project = $_POST['Project_Name']; 

						$query_progress = "UPDATE Project SET project_status=0 WHERE project_name='{$Selected_Project}';"; 
					$result_progress = run_query($query_progress);
	
	
}
	
	//select information on projects to display in table and order them by status, open projects first, then end date, then proj name
	$query = "SELECT * FROM Project ORDER BY project_status ASC, project_edate ASC, project_name ASC";
	$records = get_records_from_query($query);
	//get information from clients table
	$query_clients = "SELECT * FROM Client;";
	$records_clients = get_records_from_query($query_clients);
	//get records from Project table of in progress status 
	$query_projects = "SELECT * FROM Project WHERE project_status = 0;";
	$records_projects = get_records_from_query($query_projects);


?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="css/tableStyles.css" rel="stylesheet" type="text/css">
<link href="css/menuStyle.css" rel="stylesheet" type="text/css">
	<title>Projects</title>
</head>
<body>

<!-- table of projects-->
	<h2>Projects</h2>
<!--this form will show drop down of all projects and the two buttons will change status of project from in progress(making its tasks assignable to employees) and complete(making tasks unassignable)-->
<form action="aProjectsList.php" method="POST">
	<select name="Project_Name">
		<option>Select Project</option>
		<?php foreach ($records as $record) { ?>
			<option value="<?php echo $record['project_name']; ?>"><?php echo $record['project_name']; ?></option>
		<?php }?>
	<input type='submit' name='status_complete' value='Complete'></td>
	<input type='submit' name='status_progress' value='In Progress'></td>
	</select>
</form>

	<table>
		<th>Project Name</th><th>Client ID</th><th>Hourly Rate</th><th>Start Date</th><th>End Date</th><th>Pay Term</th><th>Status</th>
		<?php
			foreach ($records as $record) {
				echo "<tr>";
				echo "<td>{$record['project_name']}</td>";
				echo "<td>{$record['client_id']}</td>";
				echo "<td>{$record['project_hrate']}</td>";
				echo "<td>{$record['project_sdate']}</td>";
				echo "<td>{$record['project_edate']}</td>";
				echo "<td>{$record['project_payterm']}</td>";
//check value of project status and return string of complete or in progress depending on value
				if($record['project_status']==1){
						echo"<td>Complete</td>";
					}
						
						else if($record['project_status']==0){

							echo"<td>In Progess</td>"; }

		}
	
		
				
		?>
	</table>
	
<form action="aProjectsList.php" method="POST">
<h2>New Project<h2>
	
	<input type="text" name="Project_ID" placeholder="Project ID">
	<input type="text" name="Project_Name" placeholder="Project Name">
	<select name="client_id">
		<option>Select Client</option>
		<?php foreach ($records_clients as $record_client) { ?>
			<option value="<?php echo $record_client['client_id']; ?>"><?php echo $record_client['client_id']; ?></option>
		<?php }?>
	</select>
	<input type="text" name="Hourly_Rate" placeholder="Hourly Rate">
	</select></th>
      <input type="Date" name="Start_Date"> 
 	</select></th>
      <input type="Date" name="End_Date">
 	<input type="text" name="Pay_Term" placeholder="Pay Term">
 <input type="submit" name="Add_Project" value="Add Project">
 </form>



<?php 
	if (isset($message)) {
	echo $message;
	}
?>



<?php
//create new task for project 
if (isset($_POST['Create'])) {

		$task_name = $_POST['task_name'];
		$project_id = $_POST['project_Id'];
	if ($task_name !== '' && $project_id !== 0) {

	 $query_Insert = "INSERT INTO Task ( task_name, project_Id) VALUES ( '{$task_name}', '{$project_id}');";
  $result = run_query($query_Insert);
if ($result) {
	$message2 = "<p>Successfully create new task!</p>";
	}
		
}
}
		$query_view_tasks = "SELECT t.task_id, t.task_name, p.project_name FROM Task t, Project p WHERE t.project_Id = p.project_Id";
		// Step 5: run your query and get the resulting records
		$records_view_tasks = get_records_from_query($query_view_tasks);

?>




<!--display table of tasks from db-->
		<h2>Existing Tasks</h2>
		<table>
			<th>Task ID</th><th>Task Name</th><th>Project Name</th>
			<?php
				foreach ($records_view_tasks as $record_view_tasks) {
					echo "<tr>";
					echo "<td>{$record_view_tasks['task_id']}</td>";
					echo "<td>{$record_view_tasks['task_name']}</td>";
					echo "<td>{$record_view_tasks['project_name']}</td>";
			
									}
			?>
		</table>
	 
<h2>New Task</h2>
<!--form to create new tasks-->
<form  action="aProjectsList.php" method="POST">
 <input type="text" name="task_name" placeholder="Task Name">
 <!-- <input type="text" name="project_id" placeholder="Project ID">
  -->
	     <th><select name= "project_Id">
			 <option value="0">Select a Project </option>
	    <?php foreach ($records_projects as $record_projects) { ?> 
	        <option value="<?php echo $record_projects['project_Id']; ?>"><?php echo $record_projects['project_name']; ?></option>
	        <?php } ?>


 <input type="submit" name="Create" value="Create">
</form>


<?php
	if (isset($message2)) { 
  		echo $message2;
	}
?>

 
</body>
</html>
