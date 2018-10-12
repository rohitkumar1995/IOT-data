<?php
include('connection.php');
$FORM['emailid'] = "";
$FORM['pass'] = "";
$FORM['device_name'] = "";
if (isset($_POST['emailid'])) $FORM['emailid'] = $_POST['emailid'];
if (isset($_POST['device_name'])) $FORM['device_name'] = $_POST['device_name'];
if (isset($_POST['pass'])) $FORM['pass'] = $_POST['pass'];
else echo $FORM['pass'];
$sql_query="INSERT INTO users (email,pass,device_name) VALUES ('".$FORM['emailid']."','".$FORM['pass']."','".$FORM['device_name']."')";
if($conn->query($sql_query)===true){
    
    
echo ("<script LANGUAGE='JavaScript'>
    window.alert('Successfully Registered');
    window.location.href='http://moisturewater.000webhostapp.com/index.php';
    </script>");
	
	exit();
}
else{
    echo "Error occured : ".$conn->error;
}
$conn.close();

/*$sql_table = "create table ".$FORM['device_name']."(id MEDIUMINT AUTO_INCREMENT, plant_name VARCHAR(30), moisture_level DECIMAL(3,1), motor_status BOOLEAN NOT NULL DEFAULT 0, threshold DECIMAL(3,1) NOT NULL DEFAULT 50, PRIMARY KEY (id))";
    $conn->query($sql_table);
    $sql_query="INSERT INTO " . $FORM['device_name'] . " (moisture_level) VALUES ('0')";
    $conn->query($sql_query);*/
	
	
?>