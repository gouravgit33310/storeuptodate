<?php
require_once("connection.php");
session_start();
if (isset($_SESSION['usersDetail'])){
    $uid = $_SESSION['usersDetail']['uid'];
}
// item autocomplete backend
if (isset($_POST['item_val'])){
    $item = $_POST['item_val'];
    $query = "Select distinct(item) from stock where item LIKE '%{$item}%' and uid = '$uid'";
    $result = mysqli_query($conn, $query);
    $num = mysqli_num_rows($result);
    $output = "<ul>";
    if ($num > 0) {
      while($row = mysqli_fetch_assoc($result)){
        $output .=  "<li style='list-style-type: none' class='form-control'>{$row['item']} </li>";  
      }
    } else {
        $output .= "<li>No result found</li>";
    }
    $output .= "</ul>";
    echo $output;
  }


  // unit autocomplete backend code.
  if (isset($_POST['unit_val'])){
    $unit = $_POST['unit_val'];
    $query = "Select distinct(unit) from stock where unit LIKE '%{$unit}%' and uid = '$uid'";
    $result = mysqli_query($conn, $query);
    $num = mysqli_num_rows($result);
    $output = "<ul>";
    if ($num > 0) {
      while($row = mysqli_fetch_assoc($result)){
        $output .=  "<li style='list-style-type: none' class='form-control'>{$row['unit']} </li>";  
      }
    } else {
        $output .= "<li>No result found</li>";
    }
    $output .= "</ul>";
    echo $output;
  }





  if (isset($_POST['item']) && isset($_POST['unit']) && isset($_POST['qwt']) && isset($_POST['buyamt']) ) {

    $item = $_POST['item'];
    $unit = $_POST['unit'];
    $qwt = $_POST['qwt'];
    $buyamt = $_POST['buyamt'];
    
    
    $sumquery = "SELECT buy_amt AS total_amount, ballanceqwt AS total_qwt FROM stock where uid = '$uid' and item = '$item'";
    $sumresult = $conn->query($sumquery);

if ($sumresult->num_rows > 0) {
    $row = $sumresult->fetch_assoc();
    $total_amount = $row['total_amount'];
    $total_qwt = $row['total_qwt'];
    $ballance =  $buyamt + $total_amount;
    $ballanceqwt = $qwt + $total_qwt;
} else {
    $total_amount = 0;
    $total_qwt = 0;
   $ballance =  $buyamt + $total_amount;
   $ballanceqwt = $qwt + $total_qwt;
}
    $query = "INSERT INTO stock (uid, item, unit,qwt, buy_amt, ballance, ballanceqwt) VALUES ('$uid' ,'$item', '$unit', '$qwt', '$buyamt', '$ballance', '$ballanceqwt')";
    $results = $conn->query($query);
    if ($results == true) {
        echo "success";
    } else {
        echo $results;
    }
}


 





// // filter code start from hear
// if (isset($_POST['dendar_filter'])) {
//     $name = $_POST['dendar_filter'];
//     $query = "Select * from debtors where name LIKE '%{$name}%' and uid = '$uid'";
//     $result = mysqli_query($conn, $query);
//     $num = mysqli_num_rows($result);
//     $output = "<table class='table'> <thead><tr><th>Date</th><th>Name</th><th>Phone</th><th>Amt</th><th>Paid</th><th>Blnce</th></tr></thead><tbody>";
//     if ($num > 0) {
//       while($row = mysqli_fetch_assoc($result)){
//         $output .=  "<tr><td>{$row['tr_date']}</td><td>{$row['name']}</td>
//         <td>{$row['phone']}</td><td>{$row['lena_amt']}</td>
//         <td>{$row['amt_chuka']}</td><td>{$row['ballance']}</td><td><a class='btn btn-sm btn-warning' href='/manager/dendarEdit.php?did={$row['did']}'>Edit</a></td></tr>";  
//       }
//     } else {
//         $output .= "<tr><td>No result found</td></tr>";
//     }
//     $output .= "</tbody></table>";
//     echo $output;
//   }

// //   Dendar paid code hear



?>
