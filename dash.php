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

    <title>Welcome to Dashboard</title>

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
	<link href="1/ninja-slider.css" rel="stylesheet" type="text/css" />
    <script src="1/ninja-slider.js" type="text/javascript"></script>
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
                            Dashboard 
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
				<div id="abc">
				<div class="row">
				<div id='ninja-slider'>
					<div class="slider-inner">
						<ul>
							<li>
								<a href="add_birthday.php"><img class="ns-img" src="img/a.jpg" /></a>
								<div class="caption">@birthday</div>
							</li>
							<li><a href="add_special.php"><img class="ns-img" src="img/b.jpg" /></a>
								<div class="caption">@special_day</div>
							</li>
							<li>
								<a href="add_anniversary.php"><img class="ns-img" src="img/c.jpg" /></a>
								<div class="caption">@anniversary</div>
							</li>
							<li>
								<a href="add_anniversary.php"><img class="ns-img" src="img/d.jpg" /></a>
								<div class="caption">@anniversary</div>
							</li>
							<li>
								<a href="add_birthday.php"><img class="ns-img" src="img/e.jpg" /></a>
								<div class="caption">@birthday</div>
							</li>
							<li>
								<a href="add_special.php"><img class="ns-img" src="img/f.jpg" /></a>
								<div class="caption">@special_day</div>
							</li>
							<li>
								<a class="ns-img" href="img/g.jpg"></a>
								<div class="caption cap1">WE HELP YOU REMEMBER</div>
								<div class="caption cap1 cap2">YOUR SPECIAL DAYS</div>
								<div class="caption">@remember_special_days</div>
							</li>
						</ul>
					</div>
				</div>
				</div>
				</div>
				<br>
                <?php 
				$id=$_SESSION['id'];
				$today=date('m-d');
				$num1=0;
				for($i=1;$i<8;$i++)
				{
				$tom=date('m-d',time()+($i*86400));
				$qry="Select * from special where userid='$id' and DATE_FORMAT(date,'%m-%d')='$tom'";
				$result=mysqli_query($connection,$qry)or die(mysqli_error($connection));
				$num1=$num1+mysqli_num_rows($result);
				}
				$qry="Select * from special where userid='$id' and DATE_FORMAT(date,'%m-%d')='$today'";
				$result=mysqli_query($connection,$qry)or die(mysqli_error($connection));
				$num=mysqli_num_rows($result); 
				?>
				<div class="row">
                    <div class="col-lg-5 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="glyphicon glyphicon-comment fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $num;?></div>
                                        <div>Special Days Today</div>
                                    </div>
                                </div>
                            </div>
                            <a href="today.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="glyphicon glyphicon-calendar fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $num1; ?></div>
                                        <div>Upcoming Special Days</div>
                                    </div>
                                </div>
                            </div>
                            <a href="upcoming.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
				<!-- /.row -->
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