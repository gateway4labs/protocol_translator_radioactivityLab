<?php

namespace iLab;
use PDO;

class dbConnection{
    
    
    var $dbConn;
    
    public function __construct($credentials) {

        //$ini_array = parse_ini_file("public/config.php");
        //ini_set('display_errors',1);
        //error_reporting(-1);
        $host = $credentials['host'];
        $dbname = $credentials['database'];
        $dbuser = $credentials['user'];
        $dbpassword = $credentials['password'];


    ini_set('display_errors',1);
    error_reporting(-1);
    $this->dbConn = new PDO('mysql:host='.$host.';dbname='.$dbname, $dbuser,$dbpassword);

}

    public function selectAll(){
        
        $statement = $this->dbConn->query("SELECT * FROM reservations");
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        
        return $row['couponId'];
    }

    public function createReservation($username, $couponId, $passkey, $labserverId, $duration){
    
    $reservation_key = str_replace(".","dot", rand(100000000000, 999999999999));
    $query = "INSERT INTO reservations (username, couponId, passkey, labserverId, duration, reservation_key)".
                        "VALUES ('".$username."', '".$couponId."', '".$passkey."', '".$labserverId."', '".$duration."', '".$reservation_key."')";
    $count = $this->dbConn->exec($query);
    
    if ($count != NULL)
    {
        return $reservation_key;
    }
    else
    {
        //echo "Query failed: %s\n", mysqli_connect_error();
        return -1;
    }
}

    public function selectCredentials($reservation_key){
        
        $statement = $this->dbConn->prepare("SELECT couponId, passkey, labserverId FROM reservations WHERE reservation_key='".$reservation_key."'");
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        
        if ($row != FALSE)
            return $row;
        else
            return -1;
    }
    
 
}

?>
