<?php require_once('CconnectDB.php');
require_once('clientMenu.php'); 


$currentclient = $_SESSION['client_id'];
$query_date = "SELECT I.invoice_date FROM Invoice I, Project P
                      WHERE P.client_id = '$currentclient'
                        and I.project_Id = P.project_Id;"; 
$records_date = get_records_from_query($query_date);

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Invoice</title>
<link href="css/menuStyle.css" rel="stylesheet" type="text/css">
<link href="css/invoiceStyle.css" rel="stylesheet" type="text/css">
</head>
	<body>

			<h1>INVOICES</h1>
		
<!--drop down of all invoice dates for this client, will be selected and then invoice information for this date will be displayed on invoice table 	-->
			<form action="cInvoice.php" method="POST">
	  <select name= "inDate">
		  <option>Select Invoice Date</option>
	    <?php foreach ($records_date as $record_date) { ?> 
	        <option value="<?php echo $record_date['invoice_date']; ?>"><?php echo $record_date['invoice_date']; ?></option>
	        <?php } ?>
	    </select>
	      <input type="submit" name="search" value="Enter">
		</form>
	<img src="ISO_LOGO.png" alt="Logo" />
		<p>John Wall</br>johnwall@gmail.com</br>(333) 333-3333</p>
		
	<table>
		<th>Invoice ID</th><th>Invoice Date</th><th>Project ID</th><th>Project_Hours Worked</th><th>Invoice Amount</th>
	
		
			<?php
		if (isset($_POST['search'])) {
			$date = $_POST['inDate'];
			
			if ($date == "Select Invoice Date"){
				echo "Please select invoice date";
			}
			else{
			
			$query = "SELECT * FROM Invoice I, Project P
                      WHERE P.client_id = '$currentclient'
                        and I.project_Id = P.project_Id
						and I.invoice_date = '{$date}'
						;"; 
				$records = get_records_from_query($query);
			foreach ($records as $record) {
				echo "<tr>";
				echo "<td>{$record['invoice_id']}</td>";
				echo "<td>{$record['invoice_date']}</td>";
				echo "<td>{$record['project_name']}</td>";
				echo "<td>{$record['project_hworked']}</td>";
				echo "<td><strong>$</strong>{$record['invoice_amount']}</td>";
			}
		}}
		else {
			echo "";
		}
		?>
	</table>

	</body>
</html>



</body>
</html>