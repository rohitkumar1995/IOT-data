<?php
    include('connection.php');
	$email=$_POST['emailid'];
	$pass=$_POST['password'];
	$q=mysqli_query($conn,"select * from users where `email`='".$email."'") or die("Unable to get email information..");
	$num=mysqli_num_rows($q);
	global $device_name;	
	global $user_name;
	$db_pass = '';
	
	if($num>0){
		while($f=mysqli_fetch_assoc($q)){
			$db_pass=$f['pass'];
			$device_name=$f['device_name'];
		}
			
		if($pass==$db_pass){
		    $user_name = $email;
			$_SESSION['user_name']=$email;
			$_SESSION['device_name']=$device_name;
			if ($device_name === "" or $device_name === 0 or $device_name === "0")
			{
				$_SESSION["have_device"] = 0;
			}
			//echo $_SESSION['user_name']."<br>";
			//echo $_SESSION['device_name']."<br>";
            function Redirect($url, $permanent = false)
            {
                header('Location: ' . $url, true, $permanent ? 301 : 302);
                exit();
            }
            Redirect('http://moisturewater.000webhostapp.com/dashboard.php', false);
		}
        else{
			echo "Password Does Not Match...";
		}
	}
    else{
		echo "Email Id Not Registered, Please enter a registered email id and try again";
	}

?>