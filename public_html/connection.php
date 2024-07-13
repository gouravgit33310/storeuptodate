<?php
$servername = "localhost";
$username = "id22388164_manager";
$password = "Entdate@123";
$dbname = "id22388164_manager";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>