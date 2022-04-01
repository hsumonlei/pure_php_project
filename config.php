<?php
//username
define('MYSQL_USER','root');
//password
define('MYSQL_PASSWORD','12345');
//
define('MYSQL_HOST','localdb');

define('MYSQL_DATABASE','php_project');

$pdoOptions =  array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
);

//connection code
$pdo = new PDO(
    'mysql:dbhost='.MYSQL_HOST.';dbname='.MYSQL_DATABASE,
    MYSQL_USER,MYSQL_PASSWORD ,
    $pdoOptions
);


?>

<!-- $db = new PDO('mysql:dbhost=localdb;dbname=fwdclass', 'root', '12345', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
    ]); -->