<?php
    //  SETTING DATABASE CONNECTION
    include("connection.php");
    
	//  GETTING FROM URL (HTTP-GET)
	if(isset($_GET['did']))
	{
        //  DECLARING VARIABLES	
        $FORM['sid'] = "";
        $FORM['did'] = "";
        
        //  DEFINING VARIABLES
        if (isset($_GET['sid'])) $FORM['sid'] = $_GET['sid'];
        if (isset($_GET['did'])) $FORM['did'] = $_GET['did'];
		global $dbc;
		
		//  SQL QUERY
		$q=mysqli_query($conn,"select `socket_status`,`timer` from `" .$FORM['did']. "` where `sno`='" .$FORM['sid']. "'")or die("Unable to Show Result");
        
        //  EXECUTING SQL QUERY AND FETCHING DATA
		while($f=mysqli_fetch_assoc($q))
		{
		    //  RETURNING SOCKET STATUS AND TIMER DETAILS TO BLANK PAGE
			echo $f['socket_status'];       
			echo $f['timer'];
			
		}
	}
?>