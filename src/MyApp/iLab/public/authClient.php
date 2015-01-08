<?php

namespace iLab;
use SoapClient;
use SoapHeader;

class authClient {
    
    var $client;
    var $wsdlURL;
    var $headerParams;
    var $params;
    
   function __construct($userName, $clientId, $authCouponId, $authPasskey)
    {
    $ini_array = parse_ini_file("config.php");
    ini_set('display_errors',1);
    error_reporting(-1); 
    //Parse config.ini parameters
    $this->wsdlURL = $ini_array["wsdlURL"];
    $SbGuid = $ini_array["SbGuid"];
    $groupName = $ini_array["groupName"];
    $authorityKey = $ini_array["authorityKey"];
    $duration   = $ini_array["duration"];
    $start = $ini_array["start"];
    $clientGuid = $clientId;
    $passkey = $authPasskey;
    $couponId = $authCouponId;
    
    //Set SOAP Headers
    $this->headerParams = array('coupon' => array(
                        'couponId'=>$couponId,
                        'issuerGuid'=>$SbGuid, 
                        'passkey'=>$passkey)); 

    //Set Body parameters
    $this->params = array(
	'clientGuid' =>$clientGuid, //provide as parameter for the service
	'groupName'=>$groupName,
        'userName'=>$userName,
        'authorityKey'=>$authorityKey,
        'start'=>$start,
        'duration'=>$duration);
     //Create SOAP Client
     $this->client = new SoapClient($this->wsdlURL, array('trace' => 1));
     $header = new SOAPHeader('http://ilab.mit.edu/iLabs/type', 'OperationAuthHeader', $this->headerParams); 
     $this->client->__setSoapHeaders($header);
 
    }
    
    function getURL(){ //call this method "reserve"
    
    $result = $this->client->__soapCall('LaunchLabClient',array($this->params));

    return  $result->LaunchLabClientResult->tag;
    //$resultStr = $client->__getLastResponse();
    }


}


?>


