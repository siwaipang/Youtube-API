<?php
$servername = "localhost";
$dbname = "api-ontwikkeling";
$username = "root";
$password = "";

try
{
    $conn = new PDO("mysql:host=$servername;dbname=$dbname",
        $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    echo "Connectie gelukt <br/>";
}
catch(PDOException $e)
{
    echo "Connectie mislukt" .$e->getMessage();
}