<?php
include('connection.php');
// Getting from form
$serial=$_POST['serialNo'];
$socket=$_POST['socket'];
$column="";

// CREATING TABLE
$sql_table = "create table ".(string)$serial."(sno MEDIUMINT AUTO_INCREMENT,socket_name VARCHAR(20) unique, socket_status BOOLEAN NOT NULL DEFAULT 0, timer VARCHAR(50), PRIMARY KEY (sno))";
if ($conn->query($sql_table) === TRUE) {
    $message = "Device added successfully";
    try{
    for ($x = 1; $x<=(int)$socket; $x++){
        $sql_addSockets = "INSERT INTO ".(string)$serial." (socket_name) VALUES ( 'socket".(string)$x."')";
        $conn->query($sql_addSockets);
        //$conn->close();
        echo "Socket".(string)$x." Added\n";
        }
        $sq = "UPDATE users SET device = '".$serial."' WHERE email = '".$_SESSION['user_name']."'";
        $conn->query($sq);
        $_SESSION['have_device']=$serial;
		
		echo "<script LANGUAGE='JavaScript'>
    window.alert('".$message."');
    window.location.href='http://ranajoy0.000webhostapp.com/dashboard.php';
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