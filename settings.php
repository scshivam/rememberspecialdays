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

    <title>Settings</title>

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
var pass=document.getElementById("p").value;
var repass=document.getElementById("re").value;
if(pass!=repass)
{
	alert("Password dont match");
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
                            Change Password
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="dash.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-fw fa-gear"></i> Settings
                            </li>
                        </ol>
                    </div>
                </div>
				<?php if(isset($_POST['submit']))
				{
					$id=$_SESSION['id'];
					$pass=$_POST['pass'];
					$qry="Update entries set emp_pass='$pass' where id='$id'";
					$res=mysqli_query($connection,$qry)or die(mysqli_error($connection));
				?>
				<div class="row">
				<center><h1>
				Password Changed Successfully..
				</h1>
				<a href="dash.php"><button class="btn btn-default">Go to Dashboard</button></a></center>
				</div>
				<?php				
				}
				else
				{ ?>
					<div class="row">
                    <div class="col-lg-9">
						<form action="#" method="post" onsubmit="return validate();">
										<div class="form-group">
										<label>Enter Password</label>
										<input class="form-control" type="password" name="pass" id="p" required>
										</div>
							
										<div class="form-group">
                                        <label>Re-Enter Password</label>
										<input class="form-control" name="repass" type="password" id="re" required>
										</div>
										<center>
										<button type="submit" name="submit" class="btn btn-default">Submit Button</button>
										<button type="reset" class="btn btn-default">Reset Button</button>
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