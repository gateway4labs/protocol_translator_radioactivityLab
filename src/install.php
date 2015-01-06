<?php

$ini_array = parse_ini_file("MyApp/iLab/config.ini");
ini_set('display_errors',1);
error_reporting(-1);

$host = $ini_array['host'];
$db = $ini_array['database'];
$user = $ini_array['user'];
$pass = $ini_array['password'];

$root = $argv[1];
$root_password = $argv[2];

$dbConn = new PDO('mysql:host='.$host, $root, $root_password);
//$query = file_get_contents("translator.sql");

$query = "CREATE DATABASE IF NOT EXISTS `$db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
          USE `$db`;
          CREATE TABLE IF NOT EXISTS `reservations` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `username` varchar(100) NOT NULL,
              `couponId` varchar(45) NOT NULL,
              `passkey` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
              `labserverId` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
              `duration` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
              `reservation_key` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
               PRIMARY KEY (`id`) )
               ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
               CREATE USER '$user'@'localhost' IDENTIFIED BY '$pass';
               GRANT ALL ON `$db`.* TO '$user'@'localhost';
               FLUSH PRIVILEGES;";


try{
    $result = $dbConn->exec($query);
    //or die(print_r($dbConn->errorInfo(), true));

}
catch (PDOException $e) {
    die("DB ERROR: ". $e->getMessage());
}


