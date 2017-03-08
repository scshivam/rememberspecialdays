<?php
session_start();
$redirect6 = (isset($_REQUEST['redirect'])) ? $_REQUEST['redirect'] :
'dash.php';
if(isset($_SESSION['id']))
{
	header("Refresh:0;URL=".$redirect6);

}
else
{
?>
<!DOCTYPE html>
<html lang="en-us">
<meta charset="utf-8" />
<head>
<title> ::Login::</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="font-awesome/css/sans.css" rel="stylesheet" type="text/css">

<style>
*{margin:0; padding:0}
body{background:#294072; font-family: 'Source Sans Pro', sans-serif}
.form{width:400px; margin:0 auto; background:#1C2B4A; margin-top:10px}
.header{height:44px; background:#17233B}
.header h2{height:44px; line-height:44px; color:#fff; text-align:center}
.login{padding:0 20px}
.login span.un{width:10%; text-align:center; color:#0C6; border-radius:3px 0 0 3px}
.text{background:#12192C; width:90%; border-radius:0 3px 3px 0; border:none; outline:none; color:#999; font-family: 'Source Sans Pro', sans-serif} 
.text,.login span.un{display:inline-block; vertical-align:top; height:40px; line-height:40px; background:#12192C;}

.btn{height:40px; border:none; background:#0C6; width:100%; outline:none; font-family: 'Source Sans Pro', sans-serif; font-size:20px; font-weight:bold; color:#eee; border-bottom:solid 3px #093; border-radius:3px; cursor:pointer}
ul li{height:40px; margin:15px 0; list-style:none}
.span{display:table; width:100%; font-size:14px;}
.ch{display:inline-block; width:50%; color:#CCC}
.ch a{color:#CCC; text-decoration:none}
.ch:nth-child(2){text-align:right}
/*bottom*/
.sign{width:90%; padding:0 5%; height:50px; display:table; background:#17233B}
.sign div{display:inline-block; width:50%; line-height:50px; color:#ccc; font-size:14px}
.up{text-align:right}
.up a{display:block; background:#096; text-align:center; height:35px; line-height:35px; width:50%; font-size:16px; text-decoration:none; color:#eee; border-bottom:solid 3px #006633; border-radius:3px; font-weight:bold; margin-left:50%}
@media(max-width:480px){ .form{width:100%}}
</style>
</head>
<body>
<center><img src="logo.png" style="margin-top:40px;"/></center>
<div class="form">
<div class="header"><h2>Sign In</h2></div>
<div class="login">
<form action="authentication.php" method="post">
<ul>
<li>
<span class="un"><i class="fa fa-user"></i></span><input type="text" required name="username" class="text" placeholder="Email Id"/></li>
<li>
<span class="un"><i class="fa fa-lock"></i></span><input type="password" name="password" required class="text" placeholder="Password"/></li>
<li>
<input type="submit" name="submit" class="btn">
</li>
<li><div class="span"></span> <span class="ch"><a href="forgot.php">Forgot Password?</a></span></div></li>
</ul>
</form>
</div><br/>
<div class="sign">
<div class="need">Need new account ?</div>
<div class="up"><a href="Signup.php">Sign Up</a></div>
</div>
</div>
</body>
</html>
<?php 
}
?>