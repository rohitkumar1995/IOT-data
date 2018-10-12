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
        $sq = "UPDATE `" .$_SESSION['have_device']. "` SET `socket_name`='".$FORM['newname']."' WHERE `sno`='".$FORM['socketnum']."'";    
        
        //  EXECUTING SQL QUERY
        $conn->query($sq);
        
        //  REDIRECTING BACK TO DASHBOARD
        function Redirect($url, $permanent = false)
        {
            header('Location: ' . $url, true, $permanent ? 301 : 302);
            exit();
        }
        Redirect('http://ranajoy0.000webhostapp.com/dashboard.php', false);
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