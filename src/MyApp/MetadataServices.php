<?php
/**
 * Created by PhpStorm.
 * User: Danilo Garbi Zutin
 * Date: 11/6/14
 * Time: 5:06 PM
 */

function getSensorMetadata($from){

    $jsonResponse = array(
        'method' => 'getSensorMetadata',
        'sensors' => array(
            array(
                'sensor_id' => 'geiger_counter_sensor',
                'fullName' => ' Geiger–Mueller counter_sensor',
                'description' => 'It detects radiation such as alpha particles, beta particles and gamma rays using the ionization produced in a Geiger–Mueller tube',
                'webSocketType' =>  "text",
                'produces' => 'application/json',
                'values' => array(
                                    array(
                                        'name' => 'experiment_status',
                                        'unit' => '',
                                        'lastMeasured' => '2014-06-23T18:25:43.511Z', //not static, get this information from latest batch
                                        'rangeMinimum' => '0',
                                        'rangeMaximum' => '10000',
                                        'rangeStep' => '1',
                                        'updateFrequency' => 'batched'), //check this RemainingRuntime
                                    array(
                                        'name' => 'QueueLength',
                                        'unit' => '',
                                        'lastMeasured' => '2014-06-23T18:25:43.511Z', //not static, get this information from latest batch
                                        'rangeMinimum' => '0',
                                        'rangeMaximum' => '10000',
                                        'rangeStep' => '1',
                                        'updateFrequency' => 'batched'), //check this
                                    array(
                                         'name' => 'RemainingRuntime',
                                         'unit' => 's',
                                         'lastMeasured' => '2014-06-23T18:25:43.511Z', //not static, get this information from latest batch
                                         'rangeMinimum' => '0',
                                         'rangeMaximum' => '10000',
                                         'rangeStep' => '1',
                                         'updateFrequency' => 'batched'), //check this
                                    array(
                                        'name' => 'experiment_id',
                                        'unit' => '',
                                        'lastMeasured' => '2014-06-23T18:25:43.511Z', //not static, get this information from latest batch
                                        'rangeMinimum' => '0',
                                        'rangeMaximum' => '10000',
                                        'rangeStep' => '1',
                                        'updateFrequency' => 'batched'), //check this
                                    array(
                                        'name' => 'setupName',
                                        'unit' => '', //ex. "RadioactivityVsDistance"
                                        'lastMeasured' => '2014-06-23T18:25:43.511Z', //not static, get this information from latest batch
                                        'rangeMinimum' => '',
                                        'rangeMaximum' => '',
                                        'rangeStep' => '',
                                        'updateFrequency' => 'batched'), //check this
                                    array(
                                        'name' => 'setupId', //setupName
                                        'unit' => '', //ex. "RadioactivityVsDistance"
                                        'lastMeasured' => '2014-06-23T18:25:43.511Z', //not static, get this information from latest batch
                                        'rangeMinimum' => '',
                                        'rangeMaximum' => '',
                                        'rangeStep' => '',
                                        'updateFrequency' => 'batched'), //check this
                                    array(
                                        'name' => 'sourceName',
                                        'unit' => '', //ex. Strontium-90
                                        'lastMeasured' => '2014-06-23T18:25:43.511Z', //not static, get this information from latest batch
                                        'rangeMinimum' => '',
                                        'rangeMaximum' => '',
                                        'rangeStep' => '',
                                        'updateFrequency' => 'batched'), //check this
                                    array(
                                        'name' => 'repeat',
                                        'unit' => '', //number of trials
                                        'lastMeasured' => '2014-06-23T18:25:43.511Z', //not static, get this information from latest batch
                                        'rangeMinimum' => '',
                                        'rangeMaximum' => '',
                                        'rangeStep' => '',
                                        'updateFrequency' => 'batched'), //check this
                                    array(
                                        'name' => 'duration',
                                        'unit' => '', //ex. "RadioactivityVsDistance"
                                        'lastMeasured' => '2014-06-23T18:25:43.511Z', //not static, get this information from latest batch
                                        'rangeMinimum' => '',
                                        'rangeMaximum' => '',
                                        'rangeStep' => '',
                                        'updateFrequency' => 'batched'), //check this
                                    array(
                                        'name' => 'radiation_array',
                                        'unit' => 'counts',
                                        'lastMeasured' => '2014-06-23T18:25:43.511Z', //not static, get this information from latest batch
                                        'rangeMinimum' => '0',
                                        'rangeMaximum' => '10000', //depends on exposure time
                                        'rangeStep' => '1',
                                        'updateFrequency' => 'batched'), //check this
                                    array(
                                        'name' => 'distance',
                                        'unit' => 'mm',
                                        'lastMeasured' => '2014-06-23T18:25:43.511Z', //not static, get this information from latest batch
                                        'rangeMinimum' => '15',
                                        'rangeMaximum' => '95', //depends on exposure time
                                        'rangeStep' => '5',
                                        'updateFrequency' => 'batched'),
                                    array(
                                        'name' => 'absorberName',
                                        'unit' => 'absorber',
                                        'lastMeasured' => '2014-06-23T18:25:43.511Z', //not static, get this information from latest batch
                                        'rangeMinimum' => '15',
                                        'rangeMaximum' => '95', //depends on exposure time
                                        'rangeStep' => '5',
                                        'updateFrequency' => 'batched')
                                  ),
                'configuration' => array(
                                         'parameter' => "experiment_id",
                                         'description' => 'If provided will return the results of a specific experiment, if not provided returns the last experiment results'
                                         )
                ),
            array(
                'sensor_id' => 'status',
                'fullName' => 'Experiment execution status',
                'description' => 'returns the status of an experiment',
                'webSocketType' =>  "text",
                'produces' => 'application/json',
                'values' => array(
                                    array(
                                        'name' => 'experiment_id',
                                        'unit' => '',
                                        'lastMeasured' => '2014-06-23T18:25:43.511Z', //not static, get this information from latest batch
                                        'rangeMinimum' => '0',
                                        'rangeMaximum' => '10000',
                                        'rangeStep' => '1',
                                        'updateFrequency' => 1) //check this
                                 )
                ),
            array(
                'sensor_id' => 'camera',
                'fullName' => 'Webcam_1',
                'description' => 'Webcam that shows the Geiger-Mueller counter',
                'webSocketType' =>  "binary",
                'produces' => 'jpg',)

        )

    );

    $response = json_encode($jsonResponse);
    $from->send($response);
}

function getActuatorMetadata($from){

    $jsonResponse = array(
        'method' => 'getActuatorMetadata',
        'actuators' => array(
            array(
                'actuator_id' => 'geiger_counter_actuator',
                'fullName' => ' Geiger–Mueller counter',
                'description' => 'Controls the measurements of radiation. It detects radiation such as alpha particles, beta particles and gamma rays using the ionization produced in a Geiger–Mueller tube',
                'webSocketType' =>  "text",
                'produces' => 'application/json',
                'values' => array(
                    array(
                        'name' => 'setupName',
                        'unit' => '', //ex. "RadioactivityVsDistance"
                        'lastMeasured' => '2014-06-23T18:25:43.511Z', //not static, get this information from latest batch
                        'rangeMinimum' => '',
                        'rangeMaximum' => '',
                        'rangeStep' => '',
                        'updateFrequency' => 'batched'), //check this
                    array(
                        'name' => 'setupId',
                        'unit' => '', //ex. "RadioactivityVsDistance"
                        'lastMeasured' => '2014-06-23T18:25:43.511Z', //not static, get this information from latest batch
                        'rangeMinimum' => '',
                        'rangeMaximum' => '',
                        'rangeStep' => '',
                        'updateFrequency' => 'batched'), //check this
                    array(
                        'name' => 'sourceName',
                        'unit' => '', //ex. Strontium-90
                        'lastMeasured' => '2014-06-23T18:25:43.511Z', //not static, get this information from latest batch
                        'rangeMinimum' => '',
                        'rangeMaximum' => '',
                        'rangeStep' => '',
                        'updateFrequency' => 'batched'), //check this
                    array(
                        'name' => 'repeat',
                        'unit' => '', //number of trials
                        'lastMeasured' => '2014-06-23T18:25:43.511Z', //not static, get this information from latest batch
                        'rangeMinimum' => '',
                        'rangeMaximum' => '',
                        'rangeStep' => '',
                        'updateFrequency' => 'batched'), //check this
                    array(
                        'name' => 'duration',
                        'unit' => 's', //ex. "RadioactivityVsDistance"
                        'lastMeasured' => '2014-06-23T18:25:43.511Z', //not static, get this information from latest batch
                        'rangeMinimum' => '1',
                        'rangeMaximum' => '10',
                        'rangeStep' => '',
                        'updateFrequency' => 'batched'), //check this
                    array(
                        'name' => 'distance',
                        'unit' => 'mm',
                        'lastMeasured' => '2014-06-23T18:25:43.511Z', //not static, get this information from latest batch
                        'rangeMinimum' => '15',
                        'rangeMaximum' => '95', //depends on exposure time
                        'rangeStep' => '5',
                        'updateFrequency' => 'batched'),
                    array(
                        'name' => 'absorberName',
                        'unit' => 'mm',
                        'lastMeasured' => '2014-06-23T18:25:43.511Z', //not static, get this information from latest batch
                        'rangeMinimum' => '15',
                        'rangeMaximum' => '95', //depends on exposure time
                        'rangeStep' => '5',
                        'updateFrequency' => 'batched')
                )
            )

        ),

    );
    $response = json_encode($jsonResponse);
    $from->send($response);
}