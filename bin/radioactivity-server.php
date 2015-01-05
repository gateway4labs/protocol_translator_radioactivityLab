<?php
/**
 * Created by PhpStorm.
 * User: garbi
 * Date: 11/6/14
 * Time: 3:32 PM
 */

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use MyApp\radioactivity;

require dirname(__DIR__) . '/vendor/autoload.php';

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new radioactivity()
        )
    ),
    8080
);

$server->run();