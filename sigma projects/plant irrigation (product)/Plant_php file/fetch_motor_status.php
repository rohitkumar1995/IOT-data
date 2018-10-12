<?php 
    //  SETTING CONNECTION WITH DATABASE
    include('connection.php');

$sql = "select * from ".$_SESSION['device_name'];
    
    //  EXECUTING SQL QUERY

$output = "";

    $result = $conn->query($sql);
   $i = 1;
    while($row = $result->fetch_assoc()) 
    {
		
		if ($row["moisture_level"]<=$row["threshold"])
		{
			
			$sq = "UPDATE `".$_SESSION['device_name']. "` SET motor_status = 1 WHERE id =".$i;    
        	$conn->query($sq);
			
			$output .= 1;
		}
		else {
			
			$sq = "UPDATE `".$_SESSION['device_name']. "` SET `motor_status` = 0 WHERE id = ".$i;    
			
        	$conn->query($sq);
			
			$output .= 0;
		}

		
		$i++;
	}

echo json_encode($output);