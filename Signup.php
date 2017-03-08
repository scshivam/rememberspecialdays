<!doctype html>
<html lang="en-US">
<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html">
  <title>Signup</title>
  <link rel="stylesheet" type="text/css" media="all" href="css/styles.css">
</head>

<body>
<script>
function check1()
{
	var email=document.getElementById("email").value;
	var pass=document.getElementById("pass").value;
	var rpass=document.getElementById("rpass").value;
	if(email.indexOf('@')===-1&&email.indexOf('.')===-1)
	{
		alert("Enter Correct Email Id");
		return false;
	}
	if(rpass!=pass)
	{
		alert("Passwords dont Match");
		return false;
	}
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
  <?php 
  require "dbconnection.php" ;
  if(isset($_POST['submit']))
  {
	  $email=$_POST['email'];
	  $pwd=$_POST['pass'];
	  $query="SELECT emp_id FROM entries WHERE emp_id='$email';";
	  $res=mysqli_query($connection,$query) or die();
	  $row=mysqli_num_rows($res);
	  if($row==0)
	  {
		$qry="INSERT INTO entries (emp_id,emp_pass) VALUES ('$email','$pwd')";
		$res=mysqli_query($connection,$qry) or die();
		$qry="SELECT id FROM entries WHERE emp_id='$email' AND emp_pass='$pwd'";
		$res=mysqli_query($connection,$qry) or die();
		$row=mysqli_fetch_assoc($res);
		$id=$row['id'];
		$name=$_POST['name'];
		$surname=$_POST['surname'];
		$phone=$_POST['phone'];
		$dob=$_POST['dob'];
		$gender=$_POST['gender'];
		$qry1="INSERT INTO registration(id,name,surname,mob,dob,gender) VALUES ('$id','$name','$surname','$phone','$dob','$gender');";
		$res1=mysqli_query($connection,$qry1) or die();
		?>
		<h1>SignUp Succesful</h1>
		<a href="index.php"><center><button>HOME</button><center></a>
<?php		
	  }
	  else
	  {
	   ?>
	   <script> alert("Email is already used"); </script>
<?php	
		header("Refresh:0;URL=Signup.php");
	  }
  }
  else
  {
  ?>
  <h1>SignUp Form</h1>
  
  <form action="#" method="post" onsubmit="return check1();">
  <div class="col-2">
    <label>
      Name
      <input placeholder="Name" name="name" tabindex="1" required >
    </label>
  </div>
  <div class="col-2">
    <label>
      Surname
      <input placeholder="Surname" name="surname" tabindex="2" required >
    </label>
  </div>
  
  <div class="col-3">
    <label>
      Phone Number
      <input placeholder="Phone No." id="mob" name="phone" tabindex="3"required >
    </label>
  </div>
  <div class="col-3">
    <label>
      Email
      <input placeholder="e-mail address" id="email" name="email" tabindex="4" required >
    </label>
  </div>
  <div class="col-3">
    <label>
      Gender
      <select name="gender" tabindex="5">
        <option value="M">Male</option>
        <option value="F">Female</option>
        <option value="O">Others</option>
      </select>
    </label>
  </div>
  
  <div class="col-3">
    <label>
      Password
      <input type="password" placeholder="********" id="pass" name="pass" tabindex="6" required >
    </label>
  </div>
  <div class="col-3">
    <label>
      Re-Enter Password
      <input type="password" placeholder="********" id="rpass" name="repass" tabindex="7" required >
    </label>
  </div>
  <div class="col-3">
    <label>
      Date of Birth
      <input type="date" name="dob" tabindex="8" required >
    </label>
  </div>
  
  <div class="col-submit">
    <button class="submitbtn" name="submit">Submit Form</button>
  </div>
  
  </form>
  <?php
  }
  ?>
</body>
</html>