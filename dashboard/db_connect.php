<?php
define("HOST", "localhost"); // The host you want to connect to.
define("USER", "w6022388_mtgdb"); // The database username.
define("PASSWORD", "OWVDPN1b"); // The database password. 
define("DATABASE", "w6022388_mtgdb"); // The database name.
 
$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
// If you are connecting via TCP/IP rather than a UNIX socket remember to add the port number as a parameter

?>