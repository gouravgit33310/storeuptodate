<?php
session_start();
require_once("connection.php");

$phone = isset($_POST['phone']) ? $_POST['phone'] : '';
$password = isset($_POST['pass']) ? $_POST['pass'] : '';

$query = "Select * From user Where phone_no='$phone' and password='$password'";

$results = $conn->query($query);

if ($results->num_rows > 0){
    while($row = $results->fetch_assoc()) {
       $_SESSION['usersDetail'] = $row;

       echo "success";
    }
    } else {
        echo "fail";
    }
