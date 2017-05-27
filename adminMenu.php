<!--drop down navigation bar for manager to access manger view pages
will be inserted into all pages viewed by admin using require_once('adminMenu.php')-->
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="aProfile.php">Profile</a>
  <a href="aEmployeesList.php">Employees</a>
  <a href="aTimesheet.php">Timesheets</a>
  <a href="aTasks.php">Assignment</a>
  <a href="aClientsList.php">Clients</a>
  <a href="aProjectsList.php">Projects/Tasks</a>
  <a href="aInvoice.php">Invoices</a>
  <a href="logout.php">Logout</a>

</div>

<!--drop down button that will expand and show pages above-->
<div id="main">
  <span style="font-size:30px;
	cursor:pointer;" onclick="openNav()">&#9776; Menu</span>
</div>

<!--animations-->
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