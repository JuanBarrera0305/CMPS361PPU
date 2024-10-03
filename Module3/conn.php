<?php
//authentication credentials
$host = "localhost";
$port = "5432";
$dbname = "library";

$user = "postgres";
$password = "";

//Connection String
$dsn = "pgsql:host=$host;dbname=$dbname";

try {
    //Session
    $pdo = new PDO($dsn, $user, $password);

    //Set an error alert
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //Echo Messages
    echo "Successfully connected to the database";

}  catch (PDOException $e) {
    echo "Connection Failed: " . $e->getMessage();
}
?>