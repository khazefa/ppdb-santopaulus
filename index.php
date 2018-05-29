<?php
ini_set('display_errors', 0);
if (version_compare(PHP_VERSION, '5.3', '>='))
{
    error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
}
else
{
    error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);
}
session_start();
$isLoggedIn = $_SESSION['isSession'];

if(!isset($isLoggedIn) || $isLoggedIn != TRUE){
    //var session
}
else{
    //var not session
}
if (file_exists('digi_canvas.php')){
    require('digi_canvas.php');
} else {
    header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
    echo 'The application environment is not set correctly.';
    exit(1); // EXIT_ERROR
}
?>