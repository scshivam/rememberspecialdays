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
require "dbconnection.php" ;
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Special Days</title>

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
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
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
            <?php include('left.php'); ?>
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Today Special Days
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="dash.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="glyphicon glyphicon-th-list"></i> Today Special Days
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
				<div class="row">
                    <div class="col-lg-12">
                        <h2>Special Days List</h2>
                        <div class="table-responsive">
						<form action="#" method="post">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="col-lg-12"><center>Special Days Details</center></th>
                                        </tr>
                                </thead>
                                <tbody>
                                    
									<?php $i=$_SESSION['id'];
									$today=date('m-d',time());
									$query="Select * from special where userid='$i' AND DATE_FORMAT(date,'%m-%d')='$today'";
									$result=mysqli_query($connection,$query)or die(mysqli_error($connection));
										while($row1=mysqli_fetch_assoc($result))
										{
											$id=$row1['id'];
											$rec=$row1['recipient'];
											$no=$row1['rec_no'];
											$date=$row1['date'];
											$msg=$row1['message'];
										?>  
										<tr>
                                        <td>
										<div class="form-group col-lg-4">
										<label>Recipient Name</label>
										<input class="form-control" name="recipient" value="<?php echo $rec; ?>" readonly >
										</div>
										<div class="form-group col-lg-4">
                                        <label>Recipient Number</label>
										<input class="form-control" name="phone" id="mob" value="<?php echo $no; ?>" readonly>
										</div>

										<div class="form-group col-lg-4">
                                        <label>Date Of Birth</label>
                                        <input class="form-control" type="date" name="birthday" value="<?php echo $date; ?>" readonly >
										</div>
										<center>
										<div class="form-group col-lg-12">
										<label class="col-lg-11">Final Message</label>
										<textarea class="form-control" name="msg" id="msg1" rows="3" readonly ><?php echo $msg; ?></textarea><br />
										</div>
										</center>
										</tr>
										<?php
										}
										?>
                                    
                                </tbody>
                            </table>
							</form>
                        </div>
                    </div>
					</div>
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