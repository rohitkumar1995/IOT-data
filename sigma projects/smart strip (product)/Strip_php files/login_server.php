<?php
    // SETTING DATABASE CONNECTION
    include('connection.php');
    
    // GETTING FORM DATA
	$email=$_POST['emailid'];
	$pass=$_POST['password'];
    $hav_dev=0;
    
    // SQL QUERY
	$q=mysqli_query($conn,"select * from users where `email`='".$email."'") or die("Unable to get email information..");
	
	// EXECUTING SQL QUERY
	$num=mysqli_num_rows($q);
	if($num>0){
		while($f=mysqli_fetch_assoc($q)){
			$db_pass=$f['pass'];
            $hav_dev=$f['device'];
		}
		// VERIFYING GIVEN PASSWORD WITH PASSWORD IN DATABASE
		if($pass==$db_pass){
			$_SESSION['user_name']=$email; // SETTING SESSION VARIABLES
            $_SESSION['have_device']=$hav_dev;
            
            // REDIRECTING DASHBOARD 
            function Redirect($url, $permanent = false)
            {
                header('Location: ' . $url, true, $permanent ? 301 : 302);
                exit();
            }
            Redirect('http://ranajoy0.000webhostapp.com/dashboard.php', false);
		}
		// RETURN FOR INCORRECT PASSWORD
        else{
			echo "Password Does Not Matched...";
		}
	}
	
    else{
		echo "Email Id Not Registered, Please enter a registered email id and try again";
	}

?>