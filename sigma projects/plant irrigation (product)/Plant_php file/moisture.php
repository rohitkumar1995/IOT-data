<?php
    $servername = "localhost";
    $username = "id7053656_admin";
    $password = "admin123";
    $dbname = "id7053656_moisturewater";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    
	if(isset($_GET['did'])){       
        $FORM['did'] = "";
        if (isset($_GET['did'])) $FORM['did'] = $_GET['did'];
		global $conn;
		$sql = "SELECT * from " . $FORM['did'] . " where id = (select max(id) from " .$FORM['did']. ")";
        $result = $conn->query($sql);
        $moisture_level = '';
        while($row = $result->fetch_assoc()) {
            $moisture_level = $row['moisture_level'];
        }
        echo $moisture_level;
	}
		
?>