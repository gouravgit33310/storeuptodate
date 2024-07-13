<?php
    session_start();

if (!isset($_SESSION['usersDetail'])) {
     header("Location: login.php");
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
</head>
<body>
<?php  include("header.php") ?>
 
     <div class="container mt-3">
      <div><a class="btn btn-primary form-control mt-2" href="/dendar.php"> Dendar In</a></div>
      <div><a class="btn btn-primary form-control mt-2" href="/dendarpaid.php">Dendar Out</a></div>
      <div><a class="btn btn-primary form-control mt-2" href="/filter.php">Filter</a></div>
      <div><a class="btn btn-primary form-control mt-2" href="/stock.php">Stock In</a></div>
      <div><a class="btn btn-primary form-control mt-2" href="/stock_sell.php">Stock Out</a></div>
      <div><a class="btn btn-primary form-control mt-2" href="/remaining_stock.php">Check Stock</a></div>
      <div><a class="btn btn-primary form-control mt-2" href="/backend_logout.php">Logout</a></div>    
    </div>
<script>
</body>
</html>
