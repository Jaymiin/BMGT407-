<?php require_once('EconnectDB.php');
require_once('adminMenu.php');

//if the add client button is clicked.... 
 if(isset($_POST['Add_Client'])){
    $Client_ID = $_POST['Client_ID'];
    $Client_Password = $_POST['Client_Password'];
    $Client_Name = $_POST['Client_Name'];
    $Client_Email = $_POST['Email'];
    $Client_Phone = $_POST['Phone'];
    $Client_Contact = $_POST['Contact'];
   $Client_Phone = $_POST['Billing_Address'];
//insert the data from the new client form into the Client table  
  $query_Insert = "INSERT INTO Client (client_id, client_password, client_name, client_email, client_pnum, client_contact, client_address) VALUES ('{$Client_ID}', '{$Client_Password}', '{$Client_Name}', '{$Client_Email}', '{$Client_Phone}', '{$Client_Contact}', '{$Client_Phone}');";
  $result = run_query($query_Insert);
//if successfully inserted, declare this string 
  if ($result) {
  	$message =  "<p>Successfully added new client!</p>";
  }
}

//return data from Client table and display it in the Clients table on the page 
	$query = "SELECT * FROM Client ORDER BY client_name, client_id, client_pnum, client_email, client_contact, client_address";
	$records = get_records_from_query($query);
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="css/tableStyles.css" rel="stylesheet" type="text/css">
<link href="css/menuStyle.css" rel="stylesheet" type="text/css">
	<title>Clients</title>
</head>
<body>

	<h2>Clients</h2>
	<table>
		<th>Client Name</th><th>Client ID</th><th>Phone</th><th>Email</th><th>Contact</th><th>Billing Address</th>
		<?php
			foreach ($records as $record) {
				echo "<tr>";
				echo "<td>{$record['client_name']}</td>";
				echo "<td>{$record['client_id']}</td>";
				echo "<td>{$record['client_pnum']}</td>";
				echo "<td>{$record['client_email']}</td>";
				echo "<td>{$record['client_contact']}</td>";
				echo "<td>{$record['client_address']}</td>";
								}
		?>
	</table>
	
  
<form action="aClientsList.php" method="POST">
<h2>New Client<h2>

   <input type="text" name="Client_ID" placeholder="Client ID">
  <input type="text" name="Client_Password" placeholder="Client Password">
  <input type="text" name="Client_Name" placeholder= "Client Name">
  <input type="text" name="Email" placeholder="Email">
  <input type="text" name="Phone" placeholder="Phone">
  <input type="text" name="Contact" placeholder="Contact">
  <input type="text" name="Billing_Address" placeholder="Billing Address">
  <Input Type = "submit" name="Add_Client" placeholder="Add Client"
  <br><br>
 </form>

<?php
	//if $message is declared, echo the string stating that a new client was inserted 
	if (isset($message)) { 
  		echo $message;
	}
?>
     
</body>
</html>
