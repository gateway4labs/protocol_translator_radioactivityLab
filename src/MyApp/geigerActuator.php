<?php
/**
 * Created by PhpStorm.
 * User: garbi
 * Date: 12/10/14
 * Time: 3:02 PM
 */
namespace MyApp;
use iLab\dbConnection;

include_once ('translator.php');
include_once ('MetadataServices.php');
include_once("iLab/dbConnection.php");
//include_once 'actuator.php';

class geigerActuator implements actuator{

   public $actuatorID = "geiger_counter_actuator";
   public $db;
   public $translator;

    function __construct(){

        $this->db = new dbConnection();
        //$credentials = $this->db->selectCredentials($reservationId);

    }

   public function sendActuatorData($from, $message){

       //$actuatorId = $message["actuatorId"];
       $valueNames = $message["valueNames"];
       $data = $message["data"];
       //var_dump($data[4]);
       $reservationId = $message["authToken"];
       $credentials = $this->db->selectCredentials($reservationId);

            //If credentials are verified, send submit request to the the lab (translate)
            $protocol = translateActuatorRequest($valueNames, $data,$credentials);
            //$protocol = submitExperiment($credentials, $expSpecs);

            //Assemble response protocol according Smart Device Specs
            $response = array(
                "method" => $message["method"],
                "accessRole" => $message["accessRole"],
                "lastMeasured" => date('Y-m-d h:i:s ', time()),//"2011-07-14 19:43:37 +0100",
                "payload" => array(
                    "success" => true,
                    "actuatorId" => $message["actuatorId"],
                    "experimentId" => $protocol->SubmitResult->experimentID,
                    "valueNames" => $message["valueNames"],
                    "data" => $message["data"]
                )
            );
            //$protocol = array('success' => true);

        $response = json_encode($response);
        $from->send($response);
    }

    public function denyAuthorization($from, $message){

        $response = array(
            "method" => $message["method"],
            "accessRole" => $message["accessRole"],
            "lastMeasured" => date('Y-m-d h:i:s ', time()),//"2011-07-14 19:43:37 +0100",
            "payload" => array(
                "success" => false,
                "actuatorId" => $message["actuatorId"],
                "errorMessage" => "invalid token"
            )
        );
        $response = json_encode($response);
        $from->send($response);
    }

    public function getActuatorID(){

        return $this->actuatorID;
    }


}


