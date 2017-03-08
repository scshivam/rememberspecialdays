<?php
		$msg_id=$_GET['value'];
		require "dbconnection.php" ;
		$qry="SELECT def_msg FROM msg WHERE msg_id='$msg_id';";
		$res=mysqli_query($connection,$qry);
		$row=mysqli_fetch_assoc($res);
		echo $row['def_msg'];
		?>