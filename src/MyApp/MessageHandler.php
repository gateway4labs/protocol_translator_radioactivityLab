<?php
/**
 * Created by PhpStorm.
 * User: garbi
 * Date: 11/6/14
 * Time: 4:17 PM
 */

namespace MyApp;
use iLab\dbConnection;
use MyApp\geigerActuator;
//include_once ('MetadataServices.php');
include_once ('geigerActuator.php');

class MessageHandler {

    public $theGeigerCounterActuator;
    public $theGeigerSensor;
    public $db;

   function __construct(){

       $this->theGeigerCounterActuator = new geigerActuator();
       $this->theGeigerSensor = new geigerSensor();
       $this->db = new dbConnection();
}
   public function parseMethod($message, $from){

       //decode the Json string to an array
       $messageArray = json_decode($message, true);
       $method = $messageArray['method'];
       $reservationId = $messageArray["authToken"];

       //$actuatorId = $messageArray['actuatorId'];

       if ($method == "sendActuatorData")
       {
           $credentials = $this->db->selectCredentials($reservationId);

           if ($credentials == -1){

               $this->theGeigerCounterActuator->denyAuthorization($from, $messageArray);
           }
           else{
               $this->theGeigerCounterActuator->sendActuatorData($from, $messageArray);
           }

       }
       elseif ($method == "getSensorData")
       {
           $this->theGeigerSensor->getSensorData($from, $messageArray);
       }
       elseif ($method == "getActuatorMetadata")
       {
          getActuatorMetadata($from);
       }
       elseif ($method == "getSensorMetadata")
       {
           getSensorMetadata($from);
       }
       else{
           call_user_func_array($method, array($from));
       }
       //echo $response;
       //$from->send($response);
    }
}

?>