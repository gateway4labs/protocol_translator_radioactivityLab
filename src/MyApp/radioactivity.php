<?php
namespace MyApp;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use MyApp\MessageHandler;
include_once ('MetadataServices.php');


class radioactivity implements MessageComponentInterface {

    protected $clients;
    protected $theMessageHandler;

    public function __construct(){
        $this->clients = new \SplObjectStorage;

    }
    public function onOpen(ConnectionInterface $conn) {
        // Store the new connection to send messages to later
        $this->clients->attach($conn);
        echo "New connection! ({$conn->resourceId})\n";
        //var_dump($conn);
        $this->theMessageHandler = new MessageHandler();
    }

    public function onMessage(ConnectionInterface $from, $msg) {

        //Reply with metadata
        $this->theMessageHandler->parseMethod($msg, $from);

    }

    public function onClose(ConnectionInterface $conn) {

        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);

        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {

        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }

}
