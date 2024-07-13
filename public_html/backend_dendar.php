<?php
require_once("connection.php");
session_start();
if (isset($_SESSION['usersDetail'])){
    $uid = $_SESSION['usersDetail']['uid'];
}
if (isset($_POST['dendar_val'])){
    $name = $_POST['dendar_val'];
    $query = "Select distinct(name) from debtors where name LIKE '%{$name}%' and uid = '$uid'";
    $result = mysqli_query($conn, $query);
    $num = mysqli_num_rows($result);
    $output = "<ul>";
    if ($num > 0) {
      while($row = mysqli_fetch_assoc($result)){
        $output .=  "<li style='list-style-type: none' class'form-control'>{$row['name']} </li>";  
      }
    } else {
        $output .= "<li>No result found</li>";
    }
    $output .= "</ul>";
    echo $output;
  }

  if (isset($_POST['dendar']) && isset($_POST['amt']) || isset($_POST['phone']) ) {

    $name = $_POST['dendar'];
    $amt = $_POST['amt'];
    if (!isset($_POST['phone'])){
       $phone = "";    
    } else {
        $phone = $_POST['phone'];
    }
    
    $sumquery = "SELECT SUM(lena_amt) AS total_amount FROM debtors where uid = '$uid' and name = '$name'";
    $sumresult = $conn->query($sumquery);

if ($sumresult->num_rows > 0) {
    $row = $sumresult->fetch_assoc();
    $total_amount = $row['total_amount'];
    $ballance =  $amt + $total_amount;
} else {
    $total_amount = 0;
   $ballance =  $amt + $total_amount;
}
    $query = "INSERT INTO debtors (uid, name, lena_amt, phone, ballance) VALUES ('$uid' ,'$name', '$amt', '$phone','$ballance')";
    $results = $conn->query($query);
    if ($results == true) {
        echo "success";
    } else {
        echo $results;
    }
}


// filter code start from hear
if (isset($_POST['dendar_filter'])) {
    $name = $_POST['dendar_filter'];
    $query = "Select * from debtors where name LIKE '%{$name}%' and uid = '$uid'";
    $result = mysqli_query($conn, $query);
    $num = mysqli_num_rows($result);
    $output = "<table class='table'> <thead><tr><th>Date</th><th>Name</th><th>Phone</th><th>Amt</th><th>Paid</th><th>Blnce</th></tr></thead><tbody>";
    if ($num > 0) {
      while($row = mysqli_fetch_assoc($result)){
        $output .=  "<tr><td>{$row['tr_date']}</td><td>{$row['name']}</td>
        <td>{$row['phone']}</td><td>{$row['lena_amt']}</td>
        <td>{$row['amt_chuka']}</td><td>{$row['ballance']}</td><td><a class='btn btn-sm btn-warning' href='/manager/dendarEdit.php?did={$row['did']}'>Edit</a></td></tr>";  
      }
    } else {
        $output .= "<tr><td>No result found</td></tr>";
    }
    $output .= "</tbody></table>";
    echo $output;
  }

//   Dendar paid code hear



?>
