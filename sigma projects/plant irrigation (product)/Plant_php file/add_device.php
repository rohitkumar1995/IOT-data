<?php
include('connection.php');
// Getting from form
$serial=$_POST['serialNo'];
$socket=$_POST['socket'];
$column="";

// CREATING TABLE

$sql_table = "create table ".$serial."  (id MEDIUMINT AUTO_INCREMENT, plant_name VARCHAR(30), moisture_level VARCHAR(30), motor_status BOOLEAN NOT NULL DEFAULT 0, threshold VARCHAR(30) NOT NULL DEFAULT 50, PRIMARY KEY (id))";

$_SESSION["device_name"] = $serial;

if ($conn->query($sql_table) === TRUE) {
	

	
	
    $message = "Device added successfully";
	
    try{
		
    for ($x = 1; $x<=(int)$socket; $x++){
        $sql_addSockets = "INSERT INTO ".(string)$serial." (plant_name) VALUES ( 'plant".(string)$x."')";
        $conn->query($sql_addSockets);
        //$conn->close();
       
        }
        $sq = "UPDATE users SET device = '".$serial."' WHERE email = '".$_SESSION['user_name']."'";
        $conn->query($sq);
        $_SESSION['have_device']=$serial;
		
		 $sq = "UPDATE users SET device_name = '".$serial."' WHERE email = '".$_SESSION['user_name']."'";
        $conn->query($sq);
        $_SESSION['have_device']=1;
		$_SESSION["device_name"] = $serial;
		
		echo "<script LANGUAGE='JavaScript'>
    window.alert('".$message."');
    window.location.href='http://moisturewater.000webhostapp.com/dashboard.php';
    </script>";
	
	exit();
            
        }
    catch(Exception $e){
        echo "Error occured while adding Socket --->".(string)$x." : ".$conn->error;
    }
    $conn->close();
}
else {
    echo "Error occured while adding device: " . $conn->error;
}

?>