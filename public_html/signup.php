<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<title>Page Title</title>
</head>
<body>
<?php  require_once("header.php") ?>
    <div class="container">
     <form id="insertform" method="post">
      <input type="text" class="form-control border-primary" style="margin-top:20px; height:50px;" name="name" id="name" placeholder="Name" required>
      <input type="text" class="form-control border-primary" style="margin-top:20px; height:50px;" name="phone" id="phone" placeholder="Phone" required>
      <input type="password" class="form-control border-primary" style="margin-top:20px; height:50px;" name="password" id="pass" placeholder="password" required>
      <button class="form-control border-light bg-primary text-light" style="margin-top:20px; height:50px;">Submit</button>
     </form>
     </div>
<script>
   document.addEventListener('DOMContentLoaded', function() {
        // Select the form element
        var form = document.querySelector('#insertform');
        
        // Add event listener for form submission
        form.addEventListener('submit', function(event) {
            // Prevent the default form submission
            event.preventDefault();
         let name = document.querySelector("#name").value;
         let phone = document.querySelector("#phone").value;
         let pass = document.querySelector("#pass").value;
         
         if (name.length < 3){
          alert("Name must be at least 3 characters long");
         } else if (phone.length != 10 ) {
          alert("Phone number must be 10 digits long");
         } else if (pass.length < 7) {
          alert("Password must be at least 7 characters long");
         }else {
               $.ajax({
                url: "backend_signup.php",
                type: "POST",
                data: {name:name, phone:phone, pass:pass},
                success: function(data){
                  alert(data);
                  window.location.reload();
                }
               })   
         }
         

        });
    });
</script>
</body>
</html>