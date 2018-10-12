<?php
    // SETTING DATABASE CONNECTION
    include("connection.php");
    
    // GETTING DATA FROM URL
    if(isset($_GET['did']))
    {
        // DECLARING VARIABLES
		$FORM['sid'] = "";
        $FORM['did'] = "";
        $FORM['sts'] = "";
        
        // DEFINING VARIABLES WITH DATA FFROM URL
        if (isset($_GET['sid'])) $FORM['sid'] = $_GET['sid']; // SOCKET ID
        if (isset($_GET['did'])) $FORM['did'] = $_GET['did']; // DEVICE ID
		global $dbc;
		
		// SQL QUERY TO SELECT SOCKET CURRENT STATUS
		$q=mysqli_query($conn,"select `socket_status` from `" .$FORM['did']. "` where `sno`='" .$FORM['sid']. "'")or die("Unable to Show Result");
        
        // EXECUTING SQL QUERY
		while($f=mysqli_fetch_assoc($q)){
            $FORM['sts'] = $f['socket_status'];
			echo $FORM['sts'];
		}
		
        try{
            $FORM['sts'] = 1;
            
            // SQL QUERY TO TOGGLE STATUS
            $sq = "UPDATE `" .$FORM['did']. "` SET `socket_status`='".$FORM['sts']."' WHERE `sno`='".$FORM['sid']."'";
            $conn->query($sq);
            echo 'success';
        }
        catch(Exception $e){
            echo "Error occured while adding Socket --->".(string)$x." : ".$conn->error;
        }
        $conn->close();
	}
?>