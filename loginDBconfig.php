<?php

header('Access-Control-Allow-Origin: 71.77.192.81');

$DB_host = "localhost";
$DB_user = "root";
$DB_pass = "Chip0100";
$DB_name = "schoolchat";

try
{
     $db = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
     $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
     echo $e->getMessage();
}

?>
