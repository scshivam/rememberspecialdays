<?php
session_start();
$redirect6 = (isset($_REQUEST['redirect'])) ? $_REQUEST['redirect'] :
'index.php';
if(!isset($_SESSION['id']))
{
  header("Refresh:0;URL=".$redirect6);

}
else
{
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>User Profile</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>	
<script>
function validate()
	{
		    var y = document.getElementById("mob");
			var v=y.value;
			if (v.charAt(0)!='7'&&v.charAt(0)!='8'&&v.charAt(0)!='9') {
			  alert("Enter a valid phone number.");
			  y.value = "";
			  y.focus();
			  return false;
			 }
			else if (isNaN(y.value)) {
			  alert("The phone number contains illegal characters.");
			  y.value = "";
			  y.focus();
			  return false;
			 }
			 else if (!(y.value.length == 10)) {
			  alert("The phone number is the wrong length. \nPlease enter 10 digit mobile no.");
			  y.value = "";
			  y.focus();
			  return false;
			 }
	return true;
	}
</script>
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Remember Special Days</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i><?php echo " ".$_SESSION['name']." ".$_SESSION['surname'];?><b class="caret"></b></a>
                    <?php include('top.php'); ?>
                </li>
            </ul>
			  <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <?php require('dbconnection.php');
			include('left.php');
			?>
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
				<div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Profile
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="dash.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-user"></i> Profile
                            </li>
                        </ol>
                    </div>
                </div>
				<?php if(isset($_POST['sub']))
				{
					$mob=$_POST['phone'];
					$dob=$_POST['birthday'];
					$id=$_SESSION['id'];
					$qry="Update registration set mob='$mob',dob='$dob' where id='$id'";
					$res=mysqli_query($connection,$qry)or die(mysqli_error($connection));
					?>
					<div class="row">
				<center><h1>
				Updated Successfully..
				</h1>
				<a href="dash.php"><button class="btn btn-default">Go to Dashboard</button></a></center>
				</div>
					<?php
				}
				else
					if(isset($_POST['submit']))
				{
					$id=$_SESSION['id'];
				$qry="Select * from registration where id='$id'";
				$query="Select emp_id from entries where id='$id'";
				$res=mysqli_query($connection,$qry)or die(mysqli_error($connection));
				$result=mysqli_query($connection,$query)or die(mysqli_error($connection));
				$row=mysqli_fetch_assoc($res);
				$row1=mysqli_fetch_assoc($result);
				?>
				<div class="row">
                    <div class="col-lg-9">
						<form action="#" method="post" onsubmit="return validate();">
						  <div class="form-group">
							<label>
							  Name</label>
							  <input class="form-control" value="<?php echo $row['name']; ?>" name="name" tabindex="1" disabled >
							
						  </div>
						  <div class="form-group">
							<label>
							  Surname</label>
							  <input class="form-control" value="<?php echo $row['surname']; ?>" name="surname" tabindex="2" disabled >
							
						  </div>
						  
						  <div class="form-group">
							<label>
							  Phone Number</label>
							  <input class="form-control" value="<?php echo $row['mob']; ?>" id="mob" name="phone" tabindex="3" required >
							
						  </div>
						  <div class="form-group">
							<label>
							  Email</label>
							  <input class="form-control" value="<?php echo $row1['emp_id'];?>" id="email" name="email" tabindex="4" disabled >
							
						  </div>
						  <div class="form-group">
							<label>
							  Gender</label>
							  <select class="form-control" value="<?php echo $row['gender']; ?>" name="gender" tabindex="5" disabled>
								<option value="M">Male</option>
								<option value="F">Female</option>
								<option value="O">Others</option>
							  </select>
							
						  </div>
						  <div class="form-group">
                                        <label>Date Of Birth</label>
                                        <input class="form-control" value="<?php echo $row['dob']; ?>" type="date" name="birthday" required >
										</div>
						  <center>
						  <div class="form-group">
							<button type="submit" name="sub" class="btn btn-default">Update</button>
						  </div>
						  </center>
						  </form>
										</div>
										</div>
				<?php				
				}
				else
				{ 
				$id=$_SESSION['id'];
				$qry="Select * from registration where id='$id'";
				$query="Select emp_id from entries where id='$id'";
				$res=mysqli_query($connection,$qry)or die(mysqli_error($connection));
				$result=mysqli_query($connection,$query)or die(mysqli_error($connection));
				$row=mysqli_fetch_assoc($res);
				$row1=mysqli_fetch_assoc($result);?>
					<div class="row">
                    <div class="col-lg-9">
						<form action="#" method="post" >
						  <div class="form-group">
							<label>
							  Name</label>
							  <input class="form-control" value="<?php echo $row['name']; ?>" name="name" tabindex="1" disabled >
							
						  </div>
						  <div class="form-group">
							<label>
							  Surname</label>
							  <input class="form-control" value="<?php echo $row['surname']; ?>" name="surname" tabindex="2" disabled >
							
						  </div>
						  
						  <div class="form-group">
							<label>
							  Phone Number</label>
							  <input class="form-control" value="<?php echo $row['mob']; ?>" id="mob" name="phone" tabindex="3" disabled >
							
						  </div>
						  <div class="form-group">
							<label>
							  Email</label>
							  <input class="form-control" value="<?php echo $row1['emp_id'];?>" id="email" name="email" tabindex="4" disabled >
							
						  </div>
						  <div class="form-group">
							<label>
							  Gender</label>
							  <select class="form-control" value="<?php echo $row['gender']; ?>" name="gender" tabindex="5" disabled>
								<option value="M">Male</option>
								<option value="F">Female</option>
								<option value="O">Others</option>
							  </select>
							
						  </div>
						  <div class="form-group">
                                        <label>Date Of Birth</label>
                                        <input class="form-control" value="<?php echo $row['dob']; ?>" type="date" name="birthday" disabled >
										</div>
						  <center>
						  <div class="form-group">
							<button type="submit" name="submit" class="btn btn-default">Update</button>
						  </div>
						  </center>
						  </form>
										</div>
										</div>
				<?php } ?>
										
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>

</body>

</html>
<?php 
}
?>