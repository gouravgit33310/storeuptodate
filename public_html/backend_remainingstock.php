<?php
require_once("connection.php");
session_start();
if (isset($_SESSION['usersDetail'])){
    $uid = $_SESSION['usersDetail']['uid'];
}


if (isset($_POST['qwt_filter']) || isset($_POST['item_filter']) ) {
    $item = $_POST['item_filter'];
    $qwt = $_POST['qwt_filter'];
}
    
$sql = "Select * from stock ";
if ($item != "") {
    $sql .= "where item = '$item'";
}
if ($qwt != "") {
    $sql .= "where qwt < '$qwt'";
}
$sql .= " ORDER BY tr_date DESC";
 
    // displayData($uid, $name, $conn);
    // $query = "Select * from stock where
     
    // item = '$item' 
    //  and 
    //  qwt < '$qwt' and uid = '$uid' ORDER BY tr_date DESC";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    $output = "<table class='table'> <thead><tr><th>Date</th><th>item</th><th>Unit</th><th>Qwt</th><th>SellQwt</th><th>Buy amt</th><th>sell amt</th><th>blnce</th></tr></thead><tbody>";
    if ($num > 0) {
      while($row = mysqli_fetch_assoc($result)){
        $output .=  "<tr><td>{$row['tr_date']}</td><td>{$row['item']}</td>
        <td>{$row['unit']}</td><td>{$row['qwt']}</td><td>{$row['sellqwt']}</td>
        <td>{$row['buy_amt']}</td>
        <td>{$row['sell_amt']}</td><td>{$row['ballance']}</td></tr>";  
      }
    } else {
        $output .= "<tr><td>No result found</td></tr>";
    }
    $output .= "</tbody></table>";
    echo $output;

   


// function displayData($uid, $name, $conn){
    
// }
