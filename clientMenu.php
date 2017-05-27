<!--drop down navigation bar for employee to acess "Profile", "Timesheet", and "Pay Period Tasks" pages-->
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="cProfile.php">Profile</a>
  <a href="cProjects.php">Projects</a>
  <a href="cInvoice.php">Invoice</a>
  <a href="logout.php">Logout</a>
</div>

<div id="main">
  <span style="font-size:30px;
	cursor:pointer;" onclick="openNav()">&#9776; Menu</span>
</div>

<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
    document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft= "0";
    document.body.style.backgroundColor = "white";
}
</script>
<!--To create the sidebar, we followed a tutorial on w3schools and made stylistic modifications. We also customized the navigation options for our client. -->