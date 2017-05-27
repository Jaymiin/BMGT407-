<?php 
require_once('EconnectDB.php');
require_once('employeeMenu.php'); 
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Pay Period Tasks</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="css/menuStyle.css" rel="stylesheet" type="text/css">
<link href="css/tableStyles.css" rel="stylesheet" type="text/css">

<?php

$currentemployee = $_SESSION['employee_id'];
$query_assignments = "SELECT T.task_name, P.project_name, A.due_date
                      FROM Assignment A , Task T , Project P
                      WHERE A.employee_id = '$currentemployee'
                        and A.task_id = T.task_id
                        and A.project_Id = P.project_Id;"; 
$records_assignments = get_records_from_query($query_assignments);
// $query_getTaskName = "SELECT * FROM Task INNER JOIN Task ON 'Assignment.task_id' = 'Task.task_id';";
// $records_TaskNames = get_records_from_query($query_getTaskName);

?>

</head>

<table>
  <tr>
    <th>Project</th>
    <th>Task</th>
    <th>Due Date</th>
  </tr>
  <tr>
    <?php
    foreach ($records_assignments as $record_assignment) {
    echo "<tr>";
    echo "<td>{$record_assignment['project_name']}</td>";
    echo "<td>{$record_assignment['task_name']}</td>";
    echo "<td>{$record_assignment['due_date']}</td>";
    } 
    ?>
  </tr>

</table>
      
</body>
</html>
