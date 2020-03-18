<?php
define('DB_HOST','localhost'); // Host name
define('DB_USER','root'); // db user name
define('DB_PASS',''); // db user password name
define('DB_NAME','taskme'); // db name

/**
 * Connect to MySQL and instantiate the PDO object.
 */
global $pdo;
$pdo = new PDO(
    "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
    DB_USER,
    DB_PASS,
    []
);
