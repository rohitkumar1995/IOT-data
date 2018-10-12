<?php
include('connection.php');
$FORM['emailid'] = "";
$FORM['pass'] = "";
if (isset($_POST['emailid'])) $FORM['emailid'] = $_POST['emailid'];
if (isset($_POST['pass'])) $FORM['pass'] = $_POST['pass'];
else echo $FORM['pass'];
$sql_query="INSERT INTO users (email,pass) VALUES ('".$FORM['emailid']."','".$FORM['pass']."')";
if($conn->query($sql_query)===true){
    //echo "User added";
	
	echo ("<script LANGUAGE='JavaScript'>
    window.alert('Succesfully Registered');
    window.location.href='index.php';
    </script>");
	
	exit();
   /* function Redirect($url, $permanent = false)
    {
        header('Location: ' . $url, true, $permanent ? 301 : 302);
        exit();
    }
    Redirect('index.php', false); */
}
else{
    echo "Error occured : ".$conn->error;
}
$conn.close()
?>