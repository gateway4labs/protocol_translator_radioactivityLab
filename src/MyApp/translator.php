<?php
/**
 * Created by PhpStorm.
 * User: garbi
 * Date: 12/10/14
 * Time: 8:35 PM
 */
include "iLab/clientProxy.php";


    function submitExperiment($credentials, $expSpecs){

        $iLabClient = new ClientProxy($credentials['labserverId'], $credentials['couponId'], $credentials['passkey']);
        $result = $iLabClient->submit($expSpecs);
        unset ($iLabClient);
        return $result;
    }

    function getExperimentStatus($credentials, $exp_id){

        $iLabClient = new ClientProxy($credentials['labserverId'], $credentials['couponId'], $credentials['passkey']);
        $result = $iLabClient->getExperimentStatus($exp_id);
        unset ($iLabClient);
        return $result;
    }

    function translateActuatorRequest($valueNames, $data, $credentials){

    $expSpecs_array = array (
        $data[0] => $valueNames[0],
        $data[1] => $valueNames[1],
        $data[2] => $valueNames[2],
        $data[3] => $valueNames[3],
        $data[4] => $valueNames[4],
        implode(',', $data[5]) => $valueNames[5],
        implode(',', $data[6]) => $valueNames[6]

    );
    $expSpecsXml = new SimpleXMLElement('<experimentSpecification/>');
    array_walk_recursive($expSpecs_array, array ($expSpecsXml, 'addChild'));
        $iLabClient = new ClientProxy($credentials['labserverId'], $credentials['couponId'], $credentials['passkey']);
        $result = $iLabClient->submit($expSpecsXml->asXML());
        unset ($iLabClient);
        return $result;


    }

    function translateGetSensorDataRequest($message, $credentials, $exp_id){
        $iLabClient = new ClientProxy($credentials['labserverId'], $credentials['couponId'], $credentials['passkey']);
        $resultStatus = $iLabClient->getExperimentStatus($exp_id);

        if ($resultStatus->statusCode == '3') //in iLabs status code "3"= experiment completed
        {
            $experimentResults = $iLabClient->retrieveResults($exp_id);
            $experimentResultsXml = simplexml_load_string($experimentResults);

            $max = sizeof($experimentResultsXml->dataVector);
            for ($i=0; $i<$max; $i++){
                $radiationArray[$i] =  explode(",",$experimentResultsXml->dataVector[$i]);
            }

            //echo $experimentResultsXml->timestamp;
           $response = array(
               "method" => $message["method"],
               "sensorId" => $message["sensorId"],
               "accessRole" => $message["accessRole"],
               //"lastMeasured" => date('Y-m-d h:i:s ', time()),//"2011-07-14 19:43:37 +0100",

               "responseData" => array(
                                       "valueNames" => array("experiment_status", "QueueLength", "RemainingRuntime", "experiment_id", "setupName", "setupId", "sourceName","repeat", "duration", "radiation_array", "distance", "absorberName"),
                                       "data" => array(
                                                     $resultStatus->statusCode,
                                                     $resultStatus->wait->effectiveQueueLength,
                                                     $resultStatus->estRemainingRuntime,
                                                     (string)$experimentResultsXml->experimentId,
                                                     (string)$experimentResultsXml->setupName,
                                                     (string) $experimentResultsXml->setupId,
                                                     (string)$experimentResultsXml->sourceName,
                                                     (string)$experimentResultsXml->repeat,
                                                     (string)$experimentResultsXml->duration,
                                                     $radiationArray,
                                                     explode(",",$experimentResultsXml->distance),//distance array
                                                     explode(",",$experimentResultsXml->absorberName) //absorbers


                                                      )
                //"experimentId" => $protocol->SubmitResult->experimentID,
                //"valueNames" => $message["valueNames"],
                //"data" => $message["data"]
            )
        );
        }
        else
        {
            $response = array(
                "method" => $message["method"],
                "sensorId" => $message["sensorId"],
                "accessRole" => $message["accessRole"],
                //"lastMeasured" => date('Y-m-d h:i:s ', time()),//"2011-07-14 19:43:37 +0100",

                "responseData" => array(
                    "valueNames" => array("experiment_status", "QueueLength", "RemainingRuntime", "experiment_id", "setupName", "setupId", "sourceName","repeat", "duration", "radiation_array", "distance", "absorberName"),
                    "data" => array(
                        $resultStatus->statusCode,
                        $resultStatus->wait->effectiveQueueLength,
                        $resultStatus->estRemainingRuntime,
                        $exp_id,
                        NULL,
                        NULL,
                        NULL,
                        NULL,
                        NULL,
                        NULL,
                        NULL,//distance array
                        NULL //absorbers


                    )
                    //"experimentId" => $protocol->SubmitResult->experimentID,
                    //"valueNames" => $message["valueNames"],
                    //"data" => $message["data"]
                )
            );
        }
        //$result = $iLabClient->retrieveResults($exp_id);
        unset ($iLabClient);
        return $response;
    }


