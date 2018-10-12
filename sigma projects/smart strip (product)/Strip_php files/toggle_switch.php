<?php
    // ESTABLISHING DATABASE CONNECTION
    include("connection.php");
	
	// DECLARING VARIABLES
	$FORM['id'] = "";
    $FORM['sts'] = "";
    
    // DEFINING VARIABLES WITH DATA FROM FORM
    if (isset($_POST['id'])) $FORM['id'] = htmlspecialchars($_POST['id']);
    if (isset($_POST['sts'])) $FORM['sts'] = htmlspecialchars($_POST['sts']);
    try{
        // SQL QUERY TO TOGGLE STATUS
        $sq = "UPDATE `" .$_SESSION['have_device']. "` SET `socket_status`='".$FORM['sts']."' WHERE `sno`='".$FORM['id']."'";
        
        // EXECUTING QUERY
        $conn->query($sq);
        
        // REDIRECTING BACK TO DASHBOARD
        function Redirect($url, $permanent = false)
        {
            header('Location: ' . $url, true, $permanent ? 301 : 302);
            exit();
        }
        
        // CLOSING DATABASE CONNECTION
        $conn->close();
        Redirect('http://ranajoy0.000webhostapp.com/dashboard.php', false);
    }
    catch(Exception $e){
        echo "Error occured while adding Socket --->".(string)$x." : ".$conn->error;
    }
$conn->close();
?>