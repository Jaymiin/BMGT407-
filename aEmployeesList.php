<?php require_once('EconnectDB.php');
require_once('adminMenu.php'); 

//if add employee button is clicked
if(isset($_POST['Add_Employee'])){
  	$Employee_ID = $_POST['Employee_ID'];
  	$Employee_Password = $_POST['Employee_Password'];
  	$Employee_Name = $_POST['Employee_Name'];
  	$Address = $_POST['Address'];
  	$Email = $_POST['Email'];
	$Phone = $_POST['Phone'];
	$Position = $_POST['Position'];
	$Rate = $_POST['Rate'];
	$Supervisor = $_POST['Manager'];
//insert data from new employee form into the Employee table 
	$query_Insert = "INSERT INTO Employee (employee_id, employee_password, employee_name, employee_address, employee_email, employee_pnum, employee_title, employee_wrate, employee_manager) VALUES ('{$Employee_ID}', '{$Employee_Password}', '{$Employee_Name}', '{$Address}', '{$Email}', '{$Phone}', '{$Position}','{$Rate}', '{$Supervisor}');";
	$result = run_query($query_Insert);
//if insert is successful, declare this message 
	if ($result) {
	$message = "<p>Successfully added new employee!</p>";
	}
}
//return all data from employss to be displayed in table of employees
	$query = "SELECT * FROM Employee ORDER BY employee_name, employee_id, employee_title, employee_pnum, employee_email, employee_wrate, employee_address";
	// Step 5: run your query and get the resulting records
	$records = get_records_from_query($query);
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="css/tableStyles.css" rel="stylesheet" type="text/css">
<link href="css/menuStyle.css" rel="stylesheet" type="text/css">
	<title>Employees</title>
</head>
<body>
<!--table of employees viewd by the manager-->
	<h2>Employees</h2>
	<table>
		<th>Employee Name</th><th>Employee ID</th><th>Position</th><th>Phone</th><th>Email</th><th>Rate</th><th>Address</th>
		<?php
			foreach ($records as $record) {
				echo "<tr>";
				echo "<td>{$record['employee_name']}</td>";
				echo "<td>{$record['employee_id']}</td>";
				echo "<td>{$record['employee_title']}</td>";
				echo "<td>{$record['employee_pnum']}</td>";
				echo "<td>{$record['employee_email']}</td>";
				echo "<td>{$record['employee_wrate']}</td>";
				echo "<td>{$record['employee_address']}</td>";

								}
		?>
	</table>
<script>document.form.reset();</script>	 
<!--form to take values from manager to create new employee-->
<form action="aEmployeesList.php" method="POST">
<h2>New Employee<h2> 
  <input type="text" name="Employee_ID" placeholder="Employee ID">
  <input type="text" name="Employee_Password" placeholder = "Employee Password">
  <input type="text" name="Employee_Name" placeholder = "Employee Name">
  <input type="text" name="Address" placeholder="Address">
  <input type="text" name="Email" placeholder="Email">
  <input type="text" name="Phone" placeholder="Phone">
  <input type="text" name="Position" placeholder="Position">
  <input type="text" name="Rate" placeholder="Rate">
  <input type="text" name="Manager" placeholder="Manager">
  <input type="submit" name="Add_Employee" value="Add Employee">

  <br><br>
 </form>
<?php
// display message if string was succesfully declared
	if (isset($message)) {
	echo $message;
  }
	

  ?>



</body>
</html>


