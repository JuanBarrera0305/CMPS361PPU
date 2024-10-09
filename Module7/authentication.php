<?php

//start session
session_start();

//Database Configuration
$host = 'localhost';
$db = 'stats';
$user = 'postgres';
$pass = '';
$port = '5432';

//Create connection to PostGres
$conn = pg_connect("host=$host port=$port dbname=$db user=$user password=$password");

//Validate the connection works
if (!$conn){
    die("Connection failed" .pg_last_error());
}

//Get User Account Information
$username = $POST['username'];
$password = $_POST['password'];

//SQP Query
$sql = "SELECT * From users WHERE username= $1";
$result = pg_query_params($conn,$sql, array($username));

if(pg_num_rows($result) > 0){
    if(hash_equals($user['password'],crypt($password, $user['password']))){
        //if password is right
        $_SESSION['username'] = $username;
        header("Location: home.php");
    } else {
        //password is not correct
        echo "Invalid Password!!";
    }
} else {
    //No user is found
    echo "Sorry User does not exist";
}

//Close the connection 
pg_close($conn);

?>