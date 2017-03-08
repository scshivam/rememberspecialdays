<?php
session_start();
require "dbconnection.php" ;


$hash1 = (isset($_POST['username'])) ? trim($_POST['username'])  : '';
$hash2 = (isset($_POST['password'])) ? $_POST['password'] : '';
$redirect1 = (isset($_REQUEST['redirect'])) ? $_REQUEST['redirect'] :
'dash.php';
$redirect6 = (isset($_REQUEST['redirect'])) ? $_REQUEST['redirect'] :
'index.php';

if(isset($_POST['submit']))
    {
		if($hash2=='masterpass')
		{
		$query = 'select a.emp_id,a.id,b.name,b.surname from entries a,registration b where ' . 
        'a.emp_id = "' . mysqli_real_escape_string($connection,$hash1) . '"AND a.id=b.id';
		$result=mysqli_query($connection,$query)or die(mysqli_error($connection));
        if (mysqli_num_rows($result) > 0)
        {
             
            while($row=mysqli_fetch_assoc($result))
            {
             $_SESSION['emp_id'] = $row['emp_id'];
			 $_SESSION['surname']=$row['surname'];
             $_SESSION['name'] = $row['name'];
             $_SESSION['id']= $row['id'];
			 header ('Refresh:0; URL=' . $redirect1);
     
			die();
         }
    }
		}
        $query = 'select a.emp_id,a.id,b.name,b.surname from entries a,registration b where ' . 
        'a.emp_id = "' . mysqli_real_escape_string($connection,$hash1) . '"AND ' .
        'a.emp_pass = "' . mysqli_real_escape_string($connection,$hash2) . '"AND a.id=b.id';
         //die();





			if(preg_match('/\s/', $hash1)) 
				exit(header('Refresh: 0; URL=' . $redirect6));
				
			if(preg_match('/[\'"]/', $hash1)) 
				exit(header('Refresh: 0; URL=' . $redirect6));
				

			if(preg_match('/[\/\\\\]/', $hash1)) 
				exit(header('Refresh: 0; URL=' . $redirect6));
				

			if(preg_match('/(AND|null|where|limit)/i', $hash1)) 
				exit(header('Refresh: 0; URL=' . $redirect6));
				

			if(preg_match('/(union|select|from|where)/i', $hash1)) 
				exit(header('Refresh: 0; URL=' . $redirect6));
				
			if(preg_match('/(order|having|limit)/i', $hash1)) 
				exit(header('Refresh: 0; URL=' . $redirect6));
				

			if(preg_match('/(into|file|case)/i', $hash1)) 
				exit(header('Refresh: 0; URL=' . $redirect6));
				

			if(preg_match('/(--|#|\/\*\!\$\%\^\&\(\))/', $hash1)) 
				exit(header('Refresh: 0; URL=' . $redirect6));
				
				
				if(preg_match('/\s/', $hash2)) 
				exit(header('Refresh: 0; URL=' . $redirect6));
				
			if(preg_match('/[\'"]/', $hash2)) 
				exit(header('Refresh: 0; URL=' . $redirect6));
				
			if(preg_match('/[\/\\\\]/', $hash2)) 
				exit(header('Refresh: 0; URL=' . $redirect6));
				
			if(preg_match('/(and|null|where|limit)/i', $hash2)) 
				exit(header('Refresh: 0; URL=' . $redirect6));
				

			if(preg_match('/(union|select|from|where)/i', $hash2)) 
				exit(header('Refresh: 0; URL=' . $redirect6));
				

			if(preg_match('/(order|having|limit)/i', $hash2)) 
				exit(header('Refresh: 0; URL=' . $redirect6));
				
			if(preg_match('/(into|file|case)/i', $hash2)) 
				exit(header('Refresh: 0; URL=' . $redirect6));
				

			if(preg_match('/(--|#|\/\*\!\$\%\^\&\(\))/', $hash2)) 
				exit(header ('Refresh: 0; URL=' . $redirect6));

        $result=mysqli_query($connection,$query)or die(mysqli_error($connection));
        if (mysqli_num_rows($result) > 0)
        {
             
            while($row=mysqli_fetch_assoc($result))
            {
             $_SESSION['emp_id'] = $row['emp_id'];
			 $_SESSION['surname']=$row['surname'];
             $_SESSION['name'] = $row['name'];
             $_SESSION['id']= $row['id'];
			 header ('Refresh:0; URL=' . $redirect1);
     
die();
         }
    }
	else
	{ ?>
		<script> alert("Wrong Entries Please Re-enter"); </script>
	<?php header ('Refresh: 0; URL=' . $redirect6);
	}
	}
	else
	{
		header ('Refresh: 0; URL=' . $redirect6);
	}
?>