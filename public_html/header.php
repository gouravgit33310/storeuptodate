<?php

if (isset($_SESSION['usersDetail'])) {
    $userdetail = $_SESSION['usersDetail']['username'];
   $user = "Welcome<br>$userdetail";
   $dashboard = "<a class='text-light' href='/dashboard.php'>Dashboard</a>";
} else {
    $user = "Please <a href='/login.php' class='text-light'>Login</a> / <a href='/signup.php' class='text-light'>signup</a>";
}

?>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- As a link -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">


<!-- As a heading -->
<nav class="navbar navbar-dark bg-primary mt-2 p-2" style=" border-radius:25px;">
  <span class="navbar-brand mb-0 h3 "><img src="./Union.png" class="img-fluid" style="width:40px"></span>
  <?php if (!empty($dashboard)) { ?>
  <span class="" style="font-size:15px; color:white; font-weight:bold;"><?php echo $dashboard ?></span>
  <?php } ?>
  <span class="" style="font-size:12px; color:white; font-weight:bold;"><?php echo $user ?></span>
 
</nav>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>