<?php
  $Tempc=$_GET["field1"];
  $Tempf=$_GET["field2"];
  $Humidity=$_GET["field3"];
  $lights=$_GET["field4"];
  $MotionDetected=$_GET["field5"];
  $Write="<p>Temperature : " . $Tempc . " Celcius </p>"."<p>". "<p>Temperature : " . $Tempf . " Fahrenheit </p>"."<p>". "<p>Humidity :" . $Humidity . " % </p>"."<p>"."<p>Lights :" . $lights . " % </p>"."<p>"."<p>MotionDetected :" . $MotionDetected . " % </p>";
  $servername = "localhost";
  $username = "id5492737_root";
  $password = "123456789";
  $dbname = "id5492737_raspberry";

// Create connection

$conn = new mysqli($servername, $username,$password, $dbname);
// Check connection

  

if ($conn->connect_error)
 {
  
  die("Connection failed: " . $conn->connect_error);

}
 
$val1 = $Tempc;
$val2 = $Tempf;
$val3 = $Humidity;
$val4 = $lights;
$val5 = $MotionDetected;

//date.timezone = "India/kolkata";
date_default_timezone_set("Asia/Kolkata");
 $now= date("Y-m-d h:i:sa");
// $t=time();
 //echo(date("Y-m-d",$t));
echo $now;

$sql = "INSERT INTO weather VALUES ('','$now', '$val1', '$val2','$val3','$val4','$val5')";

if ($conn->query($sql) === TRUE) {
    echo "distance Saved Successfully!";
} else {
    echo "Error:" . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
  