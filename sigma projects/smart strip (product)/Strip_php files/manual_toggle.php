<?php
    include("connection.php");
    if(isset($_GET['did'])){
		$FORM['sid'] = "";
        $FORM['did'] = "";
        $FORM['sts'] = "";
        if (isset($_GET['sid'])) $FORM['sid'] = $_GET['sid'];
        if (isset($_GET['did'])) $FORM['did'] = $_GET['did'];
		global $dbc;
		$q=mysqli_query($conn,"select `socket_status` from `" .$FORM['did']. "` where `sno`='" .$FORM['sid']. "'")or die("Unable to Show Result");
        //$q=mysqli_query($dbc,"select `socket_status` from `" .$device_id. "` where `sno`='".$socket_id."'")or die("Unable to Show Result");
        
		while($f=mysqli_fetch_assoc($q)){
            $FORM['sts'] = $f['socket_status'];
			echo $FORM['sts'];
		}
        try{
            if ($FORM['sts'] == 1){
                $FORM['sts'] = 0;
            }
            else if ($FORM['sts'] == 0){
                $FORM['sts'] = 1;
            }
            $sq = "UPDATE `" .$FORM['did']. "` SET `socket_status`='".$FORM['sts']."' WHERE `sno`='".$FORM['sid']."'";
            $conn->query($sq);
            echo 'success';
            }
        catch(Exception $e){
            echo "Error occured while adding Socket --->".(string)$x." : ".$conn->error;
        }
        $conn->close();
	}
?>