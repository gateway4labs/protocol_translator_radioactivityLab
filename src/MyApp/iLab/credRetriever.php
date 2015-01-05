//The Service Broker should redirect the user to this file (Batch redirect).
//The Service Broker appends the credentials (coupon_id, passkey and labServer_id) to the URL when forwarding the user to this script.
//The forwarded credentials will be retrieved and returned.

<?php

$coupon_id = $_GET["coupon_id"];
$passkey = $_GET["passkey"];
$labServer_id = $_GET["labServer_id"];

//echo $coupon_id;
header('Content-Type: text/xml');
echo  "<sbAuth>" .
      "<couponID>".$coupon_id."</couponID>" . 
      "<couponPassKey>".$passkey."</couponPassKey>". 
      "<labserverId>".$labServer_id."</labserverId>". 
      "</sbAuth>";

?>
