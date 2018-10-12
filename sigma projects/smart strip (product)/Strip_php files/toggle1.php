<?php
    // SETTING DATABASE CONNECTION
    include("connection.php");
    
    // GETTING DATA FROM URL
    if(isset($_GET['did'])){
        // DECLARING VARIABLES
		$FORM['sid'] = "";
        $FORM['did'] = "";
        $FORM['sta'] = "";
        
        // DEFINING VARIABLES WITH DATA FROM URL        
        if (isset($_GET['sid'])) $FORM['sid'] = $_GET['sid'];
        if (isset($_GET['did'])) $FORM['did'] = $_GET['did'];
		global $dbc;
		
		// SQL QUERY TO GET CURRENT SOCKET STATUS
		$q=mysqli_query($conn,"select `socket_status` from `" .$FORM['did']. "` where `sno`='" .$FORM['sid']. "'")or die("Unable to Show Result");
        
		while($f=mysqli_fetch_assoc($q)){
            $FORM['sta'] = $f['socket_status'];
			echo $FORM['sta'];
		}
        try{
          
            $FORM['sta'] = 0;
            // UPDATING SOCKET STATUS
            $sq = "UPDATE `" .$FORM['did']. "` SET `socket_status`='".$FORM['sta']."' WHERE `sno`='".$FORM['sid']."'";
            $conn->query($sq);
            echo 'success';
            }
        catch(Exception $e){
            echo "Error occured while adding Socket --->".(string)$x." : ".$conn->error;
        }
        $conn->close();
	}
?>