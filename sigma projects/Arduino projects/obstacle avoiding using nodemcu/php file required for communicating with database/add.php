<?php
echo '<meta http-equiv="refresh" content="3">';

$temp1 = $_GET['temp'];
echo $temp1;


$servername = "localhost";

$username = "root";

$password = "";

$dbname = "db";

// Create connection

$conn = new mysqli($servername, $username,$password, $dbname);
// Check connection

  

if ($conn->connect_error)
 {
  
  die("Connection failed: " . $conn->connect_error);

}
 
$val = $temp1;
//date.timezone = "India/kolkata";
date_default_timezone_set("Asia/Kolkata");
 $now= date("Y-m-d h:i:sa");
// $t=time();
 //echo(date("Y-m-d",$t));
echo $now;

$sql = "INSERT INTO robo VALUES ('','$val', '$now')";

if ($conn->query($sql) === TRUE) {
    echo "distance Saved Successfully!";
} else {
    echo "Error:" . $sql . "<br>" . $conn->error;
}

$conn->close();
?>