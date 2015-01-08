<?php

$root_password = $argv[1];
$root = "root";
//Download composer
$source = "https://getcomposer.org/download/1.0.0-alpha9/composer.phar";
$dest = "composer.phar";

echo "Downloading composer.phar from ".$source."\r";

copy($source, $dest);

//Install dependencies
passthru("php composer.phar install");

$ini_array = parse_ini_file("src/MyApp/iLab/public/config.php");
ini_set('display_errors',1);
error_reporting(-1);

$host = $ini_array['host'];
$db = $ini_array['database'];
$user = $ini_array['user'];
$pass = $ini_array['password'];

echo "Creating database.. \r";

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
    if ($result == true){
        echo "Database created \r \r";
    }

}
catch (PDOException $e) {
    die("DB ERROR: ". $e->getMessage());
}


