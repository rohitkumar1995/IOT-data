<?php

    //  CREATING CONNECTION WITH DATABASE
    include("connection.php");
    
    // GETTING VALUES FROM URL (HTTP-GET REQUEST)
	if(isset($_GET['did']))
	{
	    //  DECLARING VARIABLES
        $FORM['sid'] = "";
        $FORM['did'] = "";
        
        //  DEFINING VARIABLES WITH VALUES PROVIDED IN URL PARAMETER
        if (isset($_GET['sid'])) $FORM['sid'] = $_GET['sid'];
        if (isset($_GET['did'])) $FORM['did'] = $_GET['did'];
		global $dbc;
		
		//  SQL QUERY FOR SOCKET STATUS
		$q=mysqli_query($conn,"select `motor_status` from `" .$FORM['did']. "` where id='" .$FORM['sid']. "'")or die("Unable to Show Result");
		$stri = '';
		
		//  EXECUTING SQL QUERY AND CONCATINATING RESULTS TO FORM A STRING
		while($f=mysqli_fetch_assoc($q)){
			$stri = $stri. $f['motor_status'];
		}
		echo $stri;
		
	
		
	}
?>