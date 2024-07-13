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
      <input type="text" style="margin-top:20px; height:50px;" class="form-control border-primary" name="qwt" id="qwt" placeholder="Qwantity" >
      <input type="text" style="margin-top:20px; height:50px;" class="form-control border-primary" name="item" id="item" placeholder="Item" >
      <div class="item-list"></div>
      
      <button style="margin-top:20px; height:55px;" class="form-control border-primary bg-primary text-light">Search</button>
     </form>
     <div class="result-list mt-3"></div>
</div>
<script>
  

//    document.addEventListener('DOMContentLoaded', function() {
        // Select the form element
       document.querySelector('#item').addEventListener('keyup', function(e){
           let item_val = e.target.value;
           $.ajax({
            url: 'backend_stock.php',
            method: "post",
            data: {item_val:item_val},
            success: function(data){
                $('.item-list').fadeIn("fast").html(data);
              $('.item-list').html(data);
            }
           })
           $(document).on('click', '.item-list li', function(){
            $('#item').val($(this).text());
            $('.item-list').fadeOut();
           })
           
           
       });



        var form = document.querySelector('#insertform');
        
        // Add event listener for form submission
        form.addEventListener('submit', function(event) {
            // Prevent the default form submission
            event.preventDefault();
            let item_filter = document.querySelector("#item").value;
            let qwt_filter = document.querySelector("#qwt").value;
            
            
         
               $.ajax({
                url: "backend_remainingstock.php",
                type: "POST",
                data: {item_filter: item_filter, qwt_filter: qwt_filter },
                success: function(data){
                  $('.result-list').html(data);
               }
               })   
         
         

        });
    // });
</script>
</body>
</html>