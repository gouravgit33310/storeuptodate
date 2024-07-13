<?php

require_once("connection.php");
$name = isset($_POST['name']) ? $_POST['name'] : '';
$phone = isset($_POST['phone']) ? $_POST['phone'] : '';
$password = isset($_POST['pass']) ? $_POST['pass'] : '';

$squery = "Select * From user Where phone_no='$phone' or password='$password'";

$results = $conn->query($squery);

if ($results->num_rows > 0){
        
    echo 'Account found with same cred.';
} else {
$query = " INSERT INTO user (username, phone_no, password) values ('$name', '$phone', '$password')";

$submit = $conn->query($query);

if ($submit == true) {
    echo "Account created successfully";
}    
}




