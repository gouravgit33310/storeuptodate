<?php
    session_start();
    require_once("connection.php");

if (!isset($_SESSION['usersDetail'])) {
     header("Location: login.php");
}
  
?>
<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
<style>
    
</style>
</head>
<body>
  <?php  require_once("header.php");?>
  <div class="container">
     <form id="insertform" method="post">
      <input type="text" style="margin-top:20px; height:50px;" class="form-control border-primary" name="dendar" id="dendar" placeholder="Dendar Name" required>
      <div class="name-list"></div>
      <input type="number" style="margin-top:20px; height:50px; " class="form-control border-primary" name="amt" id="amt" placeholder="Dendar amount" required>
      <input type="number" style="margin-top:20px; height:50px;" class="form-control border-primary" name="phn" id="phn" placeholder="Phone no">
      <button style="margin-top:20px; height:55px;" class="form-control border-primary bg-primary text-light">Submit</button>
     </form>
</div>
<script>
  

//    document.addEventListener('DOMContentLoaded', function() {
        // Select the form element
       document.querySelector('#dendar').addEventListener('keyup', function(e){
           let dendar_val = e.target.value;
           $.ajax({
            url: 'backend_dendar.php',
            method: "post",
            data: {dendar_val:dendar_val},
            success: function(data){
                $('.name-list').fadeIn("fast").html(data);
              $('.name-list').html(data);
            }
           })
           $(document).on('click', '.name-list li', function(){
            $('#dendar').val($(this).text());
            $('.name-list').fadeOut();
           })
           
           
       });



        var form = document.querySelector('#insertform');
        
        // Add event listener for form submission
        form.addEventListener('submit', function(event) {
            // Prevent the default form submission
            event.preventDefault();
            let dendar = document.querySelector("#dendar").value;
            let phone = document.querySelector("#phn").value;
            let amt = document.querySelector("#amt").value;
            
          if (dendar == "" ) {
          alert("Please add the creditor name");
         } else if (amt == "") {
          alert("Please add amount");
         }else {
               $.ajax({
                url: "backend_dendar.php",
                type: "POST",
                data: {dendar: dendar, phone: phone, amt: amt},
                success: function(data){
                  if (data == 'success'){
                    alert("Data inserted successfully");
                    window.location.reload();
                  } else {
                    alert(data);
                  }
                 
                  
                }
               })   
         }
         

        });
    // });
</script>
</body>
</html>