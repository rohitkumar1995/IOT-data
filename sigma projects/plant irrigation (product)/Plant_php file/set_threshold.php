<?php
// ESTABLISHING CONNECTION WITH DATABASE
include('connection.php');

// Getting from form
    if(isset($_POST['start'])){
        // DECLARING VARIABLES
		$FORM['start'] = "";
        $FORM['socketnum'] = "";
        $stringg = "";
        
        // DEFINING VARIABLES WITH DATA FETCHED FROM FORM
        if (isset($_POST['start'])) $FORM['start'] = $_POST['start'];
        if (isset($_POST['socketnum'])) $FORM['socketnum'] = $_POST['socketnum'];

        
        // UPDATING TIME IN DATEBASE
        try{
            
            // SQL QUERY
            $sq = "UPDATE " .$_SESSION['device_name']. " SET threshold='".$_POST['start']."' WHERE id='".$FORM['socketnum']."'";
            $conn->query($sq);
            
            // REDIRECTING BACK TO DASHBOARD
            function Redirect($url, $permanent = false)
            {
                //$conn->close();
                header('Location: ' . $url, true, $permanent ? 301 : 302);
                exit();
            }
            Redirect('http://moisturewater.000webhostapp.com/dashboard.php', false);
        }
        catch(Exception $e){
            echo "Error occured while adding Socket --->".(string)$x." : ".$conn->error;
        }
        
        // CLOSING DATABASE CONNECTION
        $conn->close();
	}

?>