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
<title>Filter</title>
<style>
    
</style>
</head>
<body>
  <?php  require_once("header.php");?>
  <div class="container">
     <form id="insertform" method="post">
      <input type="text" style="margin-top:20px; height:50px;" class="form-control border-primary" name="dendar" id="dendar" placeholder="Dendar Name" required>
      <div class="name-list"></div>
      
      <button style="margin-top:20px; height:55px;" class="form-control border-primary bg-primary text-light">Search</button>
     </form>
     <div class="result-list mt-3"></div>
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
            let dendar_filter = document.querySelector("#dendar").value;
            
            
          if (dendar_filter == "" ) {
          alert("Please add the creditor name");
         }else {
               $.ajax({
                url: "backend_dendar.php",
                type: "POST",
                data: {dendar_filter: dendar_filter},
                success: function(data){
                  $('.result-list').html(data);
               }
               })   
         }
         

        });
    // });
</script>
</body>
</html>