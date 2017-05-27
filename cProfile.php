<?php
require_once('CconnectDB.php');
require_once('clientMenu.php');

		// construct your query--> note that this does not actually do anything! We need to run the query below.

	$query = "SELECT * FROM Client WHERE client_id = '{$_SESSION['client_id']}'";
		// runs the query and returns the one record. We know there should only be one person with a given username
		$record = get_one_record_from_query($query);

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="css/menuStyle.css" rel="stylesheet" type="text/css">
<title>Client Profile</title>
</head>

<body>

<div class="card">
  <img src="http://www.clipartkid.com/images/759/hardware-store-clipart-images-pictures-becuo-m7fgCr-clipart.png" style="width:100%">
  <div class="container">
<!--php used to call client information from the Clients table to fill profile-->
  	<?php
		echo "<h1>{$record['client_name']}</h1>";
		echo "<p class='title'><u>Point of Contact:</u> ".$record['client_contact']."</p>";
	  	echo "<p><u>Phone:</u> ".$record['client_pnum']."</p>";
	  	echo "<p><u>Email:</u> ".$record['client_email']."</p>";
	  	echo "<p><u>Billing Address:</u> ".$record['client_address']."</p>";
					
		?>
  </div>
</div>
     
</body>
</html>
