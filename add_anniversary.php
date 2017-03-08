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

    <title>Add Anniversary</title>

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
	var request;
	var xmlHttp;
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
			 var textarea = document.getElementById("msg1");
			if(textarea.value=="")
			{
				alert("Enter Your Message");
				textarea.focus();
				return false;
			}
			else
				if(textarea.value.length>120)
				{
					alert("Enter a smaller Message");
					textarea.focus();
					return false;
				}
		
	return true;
	}
	function message()
	{
		str=document.getElementById("select1").value;
		if (typeof XMLHttpRequest!="undefined")
			{
			ajaxRequest=new XMLHttpRequest();
			}
			else if (window.ActiveXObject)
			{
			ajaxRequest=new ActiveXObject("Microsoft.XMLHTTP");
			}
			if (ajaxRequest==null)
			{
			alert("browser does not support XMLHTTPrequest");
			return;
			}
			ajaxRequest.onreadystatechange=function(){
				if(ajaxRequest.readyState==4)
			{
			var ajaxDisplay=document.getElementById('msg1');
			ajaxDisplay.innerHTML=ajaxRequest.responseText;
			};
			};
			ajaxRequest.open("GET","msg.php?value="+str,true);
			ajaxRequest.send();
			 
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
                            Add Anniversary
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="dash.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="glyphicon glyphicon-plus"></i> Add Anniversary
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
				<?php if(isset($_POST['submit']))
				{
					$id=$_SESSION['id'];
					$name=$_POST['recipient'];
					$mob=$_POST['phone'];
					$date=$_POST['anniversary'];
					$message=$_POST['msg'];
					$def=$_POST['def'];
					if($def!="")
					{
						$message=substr($message,6);
					}
					$qry="INSERT INTO special (userid,recipient,rec_no,date,day_type,message) VALUES ('$id','$name','$mob','$date','A','$message')";
					$res=mysqli_query($connection,$qry) or die();
				?>
				<div class="row">
				<center><h1>
				Added Successfully..
				</h1>
				<a href="dash.php"><button class="btn btn-default">Go to Dashboard</button></a></center>
				</div>
				<?php
				}
				else
				{
					?>
				<div class="row">
                    <div class="col-lg-9">
						<form action="#" method="post" onsubmit="return validate();">
										
										<div class="form-group">
										<label>Recipient Name</label>
										<input class="form-control" name="recipient" required>
										</div>
							
										<div class="form-group">
                                        <label>Recipient Number</label>
										<input class="form-control" name="phone" id="mob" required>
										</div>

										<div class="form-group">
                                        <label>Anniversary Date</label>
                                        <input class="form-control" type="date" name="anniversary" required >
										</div>

										<div class="form-group">
										<label>Default Messages</label>
										<select class="form-control" name="def" id="select1" onChange="message();">
										<option value="">Enter Yourself..</option>
										<?php 
										$qry="SELECT def_msg,msg_id FROM msg WHERE type='A';";
										$res=mysqli_query($connection,$qry) or die();
										while($row=mysqli_fetch_assoc($res))
										{
										?>
										<option value="<?php echo $row['msg_id']; ?>"><?php echo $row['def_msg']; ?></option>
										<?php 
										}
										?>
										</select>
										</div>
							<center>
							<label>Final Message</label>
										<textarea class="form-control" name="msg" id="msg1" rows="3" ></textarea><br />
							<button type="submit" name="submit" class="btn btn-default">Submit Button</button>
                            <button type="reset" class="btn btn-default">Reset Button</button>
							</center>
							</form>
                        </div>
                    </div>
				<!-- /.row -->
				<?php
				}
				?>
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