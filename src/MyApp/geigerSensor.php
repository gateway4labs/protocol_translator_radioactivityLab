<?php
/**
 * Created by PhpStorm.
 * User: garbi
 * Date: 12/23/14
 * Time: 11:13 PM
 */
namespace MyApp;
use iLab\dbConnection;
include_once ('MetadataServices.php');

class geigerSensor implements sensor{

    public $sensorId = "geiger_counter_sensor";
    public $db;
    public $translator;

    function __construct(){

        $this->db = new dbConnection();
        //$credentials = $this->db->selectCredentials($reservationId);

    }

    public function getSensorData($from, $message){

        $configuration = $message["configuration"];
        $updateFrequency = $message["updateFrequency"];
        //var_dump($configuration[0]["value"]);
        $reservationId = $message["authToken"];
        $credentials = $this->db->selectCredentials($reservationId);

        //Send request to the the lab (translate)
        //$expSpecs = translateActuatorRequest($valueNames, $data);
        $exp_id = $configuration[0]["value"];
        $str_expId =strval($exp_id);
        $response = translateGetSensorDataRequest($message, $credentials, $str_expId);
        //var_dump($result);

        //Assemble response protocol according to Smart Device Specs


        $response = json_encode($response);
        $from->send($response);

    }

    public function denyAuthorization($from, $message){

        $response = array(
            "method" => $message["method"],
            "accessRole" => $message["accessRole"],
           // "lastMeasured" => date('Y-m-d h:i:s ', time()),//"2011-07-14 19:43:37 +0100",
            "payload" => array(
                "success" => false,
                "sensorId" => $message["sensorId"],
                "errorMessage" => "invalid token"
            )
        );
        $response = json_encode($response);
        $from->send($response);
    }

    public function getSensorId(){

        return $this->sensorId;
    }

}
