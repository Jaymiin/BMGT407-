<?php 
require_once('CconnectDB.php');
require_once('clientMenu.php');
	// Step 4: write your query
	$query = "SELECT * FROM Project WHERE client_id = '{$_SESSION['client_id']}' ORDER BY project_status ASC, project_edate ASC, project_name ASC";
	// Step 5: run your query and get the resulting records
	$records = get_records_from_query($query);?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="css/tableStyles.css" rel="stylesheet" type="text/css">
<link href="css/menuStyle.css" rel="stylesheet" type="text/css">
<title>Projects</title>
</head>

<body>
	<h2>Projects</h2>
	<table>
		<th>Project Name</th><th>Client ID</th><th>start date</th><th>end date</th><th>pay term</th><th>status</th>
		<?php
			foreach ($records as $record) {
				echo "<tr>";
				echo "<td>{$record['project_name']}</td>";
				echo "<td>{$record['client_id']}</td>";
				echo "<td>{$record['project_sdate']}</td>";
				echo "<td>{$record['project_edate']}</td>";
				echo "<td>{$record['project_payterm']}</td>";
					if($record['project_status']==1){
						echo"<td>Complete</td>";
					}		  
						else if($record['project_status']==0){
							echo"<td>In Progess</td>";
						}
			}
		?>
	</table>
	

</body>
</html>