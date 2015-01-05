<?php

use iLab\dbConnection;
use iLab\authClient;
include 'dbConnection.php';
include 'authClient.php';

    ini_set('display_errors',1);
    error_reporting(-1); 
    
//Read config file
$ini_array = parse_ini_file("config.ini");

$db = new dbConnection();

//$test = $db->selectAll();
//var_dump($test);

//Retrieve GET Paremeters
$user = $_GET["user"];


$authCouponId = $ini_array["couponId"];
$authPasskey = $ini_array["passkey"];
$clientId = $ini_array["clientGuid"];
$duration = $ini_array["duration"];

$theClientAuth = new authClient($user, $clientId, $authCouponId, $authPasskey);

//Retrieve credential from Service Broker for sbAuthHeader
//echo $theClientAuth->getURL();

$credentials = file_get_contents($theClientAuth->getURL());
$credentialsXml = simplexml_load_string($credentials);

$result = $db->createReservation($user, $credentialsXml->couponID, $credentialsXml->couponPassKey, $credentialsXml->labserverId, $duration);

if ($result != -1){
    header('Content-Type: text/xml');
    echo "<reservation>" .
         "<user>".$user."</user>".
         "<created>true</created>".   
         "<reservationKey>".$result."</reservationKey>" . 
         "</reservation>";
    
}
else{
    header('Content-Type: text/xml');
    echo "<reservation>" .
         "<user>".$user."</user>".
         "<created>false</created>".   
         "<reservationKey></reservationKey>" . 
         "</reservation>";   
}

?>
