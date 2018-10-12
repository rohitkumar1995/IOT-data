
<?php
    // DATABASE CREDENTIALS
    $servername = "localhost";
    $username = "id6549663_root";
    $password = "abc123";
    $dbname = "id6549663_nodemcu";
    
    // Create connection
    global $dbc;
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        echo $page = $_SERVER['PHP_SELF'];
        $sec = "0";
        header("Refresh: $sec; url=$page");
        die("Connection failed: " . $conn->connect_error);    
    }
    nl2br("\n");
    
    // GETTING DATA FROM FORM
	if(isset($_GET['did']))
	{       
        $FORM['did'] = ""; // DECLARING VARIABLE FOR DEVICE ID
        if (isset($_GET['did'])) $FORM['did'] = $_GET['did']; // FETCHING DEVICE ID FROM URL
		global $conn;
		
		// FETCHING SOCKET STATUSES FROM DEVICE TABLE
		$q=mysqli_query($conn,"select `socket_status` from " .$FORM['did'])or die("Unable to Show Result");
        $stri = '';
		while($f=mysqli_fetch_assoc($q))
		{
			$stri = $stri. $f['socket_status'];
		}
		echo $stri;
		
		// FETCHING TIMER STATUS FROM DEVICE TABLE
		$q=mysqli_query($conn,"select `timer` from " .$FORM['did'])or die("Unable to Show Result");
		$stri = $stri. ' ';
		while($f=mysqli_fetch_assoc($q))
		{
			$stri = $stri. $f['timer']. " -> ";
		}
		echo $stri;
		}
		
?>
