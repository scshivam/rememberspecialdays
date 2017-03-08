<?php
error_reporting(E_ALL);
ob_implicit_flush(true);

include_once "class.curl.php";
include_once "class.sms.php";
include_once "cprint.php";
include('dbconnection.php');
date_default_timezone_set('Asia/Kolkata');
$today=date('m-d');
$query="Select * from special where DATE_FORMAT(date,'%m-%d')='$today'";
$result=mysqli_query($connection,$query)or die(mysqli_error($connection));
while($row=mysqli_fetch_assoc($result))
{
$msg=$row['message'];
$tonum=$row['rec_no'];
$id=$row['userid'];	
$qry="Select * from registration where id='$id'";
$res=mysqli_query($connection,$qry)or die(mysqli_error($connection));
$row1=mysqli_fetch_assoc($res);
$name=$row1['name']." ".$row1['surname'];
$mess=$msg." From-".$name;
$smsapp=new sms();
$smsapp->setGateway('way2sms');
$myno='7839179468';
$p='chausu';
cprint("Logging in ..\n");
$ret=$smsapp->login($myno,$p);

if (!$ret) {
   cprint("Error Logging In");
   exit(1);
}
$ret=$smsapp->send($tonum,$mess);

if (!$ret) {
   print("Error in sending message");
   exit(1);
}
}
?>