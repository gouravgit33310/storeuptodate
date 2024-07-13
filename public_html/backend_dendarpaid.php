<?php
require_once("connection.php");
session_start();
if (isset($_SESSION['usersDetail'])){
    $uid = $_SESSION['usersDetail']['uid'];
}

if (isset($_POST['dendar_paid']) && isset($_POST['amt_paid']) || isset($_POST['phone']) ) {

$name = $_POST['dendar_paid'];
$amt = $_POST['amt_paid'];
if (!isset($_POST['phone'])){
   $phone = "";    
} else {
    $phone = $_POST['phone'];
}

// $sumquery = "SELECT LAST(ballance) AS total_amount FROM debtors where uid = '$uid' and name = '$name'";
$sumquery = "SELECT ballance AS total_amount FROM debtors WHERE uid = '$uid' AND name = '$name' ORDER BY tr_date DESC LIMIT 1";
$sumresult = $conn->query($sumquery);

if ($sumresult->num_rows > 0) {
$row = $sumresult->fetch_assoc();
$total_amount = $row['total_amount'];
$ballance = $total_amount - $amt;
} 
$query = "INSERT INTO debtors (uid, name, amt_chuka, phone, ballance) VALUES ('$uid' ,'$name', '$amt', '$phone','$ballance')";
$results = $conn->query($query);
if ($results == true) {
    
    // displayData($uid, $name, $conn);
    $query = "Select * from debtors where name LIKE '%{$name}%' and uid = '$uid' ORDER BY tr_date DESC";
    $result = mysqli_query($conn, $query);
    $num = mysqli_num_rows($result);
    $output = "<table class='table'> <thead><tr><th>Date</th><th>Name</th><th>Phone</th><th>Amt</th><th>Paid</th><th>Blnce</th></tr></thead><tbody>";
    if ($num > 0) {
      while($row = mysqli_fetch_assoc($result)){
        $output .=  "<tr><td>{$row['tr_date']}</td><td>{$row['name']}</td>
        <td>{$row['phone']}</td><td>{$row['lena_amt']}</td>
        <td>{$row['amt_chuka']}</td><td>{$row['ballance']}</td></tr>";  
      }
    } else {
        $output .= "<tr><td>No result found</td></tr>";
    }
    $output .= "</tbody></table>";
    echo $output;
   
} else {
    echo $results;
}
}

// function displayData($uid, $name, $conn){
    
// }


 ?>