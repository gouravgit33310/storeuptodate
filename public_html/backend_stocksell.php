<?php

require_once("connection.php");
session_start();
if (isset($_SESSION['usersDetail'])){
    $uid = $_SESSION['usersDetail']['uid'];
}


if (isset($_POST['sellamt']) && isset($_POST['item']) && isset($_POST['unit']) && isset($_POST['qwt'])){
    $item = $_POST['item'];
    $unit = $_POST['unit'];
    $qwt = $_POST['qwt'];
    $sellamt = $_POST['sellamt'];
$sumquery = "SELECT ballance AS total_amount, ballanceqwt AS total_qwt FROM stock WHERE uid = '$uid' AND item = '$item' ORDER BY tr_date DESC LIMIT 1";
$sumresult = $conn->query($sumquery);

if ($sumresult->num_rows > 0) {
$row = $sumresult->fetch_assoc();
$total_amount = $row['total_amount'];
$total_qwt = $row['total_qwt'];
$ballance = $total_amount - $sellamt;
$ballanceqwt = $total_qwt - $qwt;
} 
$query = "INSERT INTO stock (uid, item,unit,sellqwt,sell_amt, ballance, ballanceqwt) VALUES ('$uid' ,'$item', '$unit', '$qwt', '$sellamt','$ballance', '$ballanceqwt')";
$results = $conn->query($query);
if ($results == true) {
    
    // displayData($uid, $name, $conn);
    $query = "Select * from stock where item LIKE '%{$item}%' and uid = '$uid' ORDER BY tr_date DESC";
    $result = mysqli_query($conn, $query);
    $num = mysqli_num_rows($result);
    $output = "<table class='table'> <thead><tr><th>Date</th><th>item</th><th>Unit</th><th>Qwt</th><th>SellQwt</th><th>Buy amt</th><th>sell amt</th><th>blnce</th><th>blnce qwt</th></tr></thead><tbody>";
    if ($num > 0) {
      while($row = mysqli_fetch_assoc($result)){
        $output .=  "<tr><td>{$row['tr_date']}</td><td>{$row['item']}</td>
        <td>{$row['unit']}</td><td>{$row['qwt']}</td><td>{$row['sellqwt']}</td>
        <td>{$row['buy_amt']}</td>
        <td>{$row['sell_amt']}</td><td>{$row['ballance']}</td><td>{$row['ballanceqwt']}</td></tr>";  
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

?>