<?php
/**
 * Created by PhpStorm.
 * User: garbi
 * Date: 12/27/14
 * Time: 3:56 PM
 */


class messageDispatcher extends Thread {

    public $from;

    public function __construct(){
        $this->from = $from;
    }

    public function run(){

        for ($i=0; $i<10; $i++){
            echo "hello World!";
        }

    }

}

$testThread = new messageDispatcher();
$testThread->start();



