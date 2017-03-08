<?php
session_start();
$redirect6 = (isset($_REQUEST['redirect'])) ? $_REQUEST['redirect'] :
'dash.php';
$redirect1 = (isset($_REQUEST['redirect'])) ? $_REQUEST['redirect'] :
'index.php';
if(isset($_SESSION['id']))
{
  header("Refresh:0;URL=".$redirect6);

}
else
{
	include('dbconnection.php');
	$pass=$_POST['pass'];
	$id=$_POST['id'];
	$qry="Update entries set emp_pass='$pass' where id='$id'";
	$res=mysqli_query($connection,$qry)or die(mysqli_error($connection));
	?>
	<script>
	alert("Password changed Succesfully");
	</script>
	<?php
	header("Refresh:0;URL=".$redirect1);
}
?>