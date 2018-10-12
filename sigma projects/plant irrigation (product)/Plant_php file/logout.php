<?php
include("connection.php");
// remove all session variables
session_unset(); 

// destroy the session 
session_destroy(); 

function Redirect($url, $permanent = false)
    {
        header('Location: ' . $url, true, $permanent ? 301 : 302);
        exit();
    }
    Redirect('http://moisturewater.000webhostapp.com/', false);
?>