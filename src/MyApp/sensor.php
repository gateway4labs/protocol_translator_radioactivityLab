<?php
/**
 * Created by PhpStorm.
 * User: garbi
 * Date: 12/23/14
 * Time: 6:44 PM
 */

namespace MyApp;

interface sensor{

    public function getSensorData($from, $message);

    public function denyAuthorization($from, $message);

    public function getSensorId();
}