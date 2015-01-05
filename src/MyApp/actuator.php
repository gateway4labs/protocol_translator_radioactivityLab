<?php
/**
 * Created by PhpStorm.
 * User: garbi
 * Date: 12/23/14
 * Time: 4:43 PM
 */
namespace MyApp;

interface actuator{

    public function sendActuatorData($from, $message);

    public function denyAuthorization($from, $message);

    public function getActuatorId();
}

