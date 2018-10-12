<?php
    include("connection.php");
    if(isset($_GET['did'])){
		$FORM['did'] = "";
		$FORM['sid'] = "";
        $FORM['level'] = "";
        
        if (isset($_GET['level'])) $FORM['level'] = $_GET['level'];
        if (isset($_GET['did'])) $FORM['did'] = $_GET['did'];
		if (isset($_GET['sid'])) $FORM['sid'] = $_GET['sid'];
		global $dbc;
		echo $sql = "SELECT * from " .$FORM['did']." WHERE id = ".$FORM['sid'];
        $result = $conn->query($sql);
        $thres = '';
        while($row = $result->fetch_assoc()) {
            $thres = $row['threshold'];
        }
		if ( (int)$thres > (int)$FORM['level'] ){
            $sql = "UPDATE " . $FORM['did'] . " SET moisture_level =  " . $FORM['level'] . ", motor_status =  1  WHERE id = ".$FORM['sid'];
        }
        else{
            $sql = "UPDATE " . $FORM['did'] . " SET moisture_level =  " . $FORM['level'] . ", motor_status =  0  WHERE id = ".$FORM['sid'];  
        }
        $conn->query($sql);
        
       
        
        echo "Data succesfully updated";
        $conn->close();
	}
?>