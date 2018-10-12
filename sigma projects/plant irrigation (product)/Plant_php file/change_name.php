<?php
include('connection.php');      // CREATING CONNECTION WITH DATABASE

// Getting from form
if(isset($_POST['newname']))        // CHECK FOR PRESENCE OF FORM DATA IN INCOMING STREAM
{
    //  DECLARING VARIABLES
	$FORM['newname'] = "";
    $FORM['socketnum'] = "";
    
    //  DEFINING VARIABLES WITH FORM DATA
    if (isset($_POST['newname'])) $FORM['newname'] = $_POST['newname'];
    if (isset($_POST['socketnum'])) $FORM['socketnum'] = $_POST['socketnum'];
    global $dbc;
	
	//  UPDATING SOCKET NAME IN RESPECTIVE DEVICE TABLE
    try
    {
        //  SQL QUERY
        $sq = "UPDATE `" .$_SESSION['device_name']. "` SET `plant_name`='".$FORM['newname']."' WHERE `id`='".$FORM['socketnum']."'";    
		
		echo $sq;
        
        //  EXECUTING SQL QUERY
        $conn->query($sq);
        
        //  REDIRECTING BACK TO DASHBOARD
		echo "<script LANGUAGE='JavaScript'>
    window.alert('Name Changed Successfully');
    window.location.href='http://moisturewater.000webhostapp.com/dashboard.php';
    </script>";
	
	exit();
    }
    
    //ERROR HANDLING IF ANY
    catch(Exception $e)
    {
        echo "Error occured while adding Socket --->".(string)$x." : ".$conn->error;
    }
    
    //  CLOSING DATABASE CONNECTION
    $conn->close();
	}

?>