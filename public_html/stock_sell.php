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
      <input type="text" style="margin-top:20px; height:50px;" class="form-control border-primary" name="item" id="item" placeholder="Add item" required>
      <div class="name-list"></div>
      <input type="text" style="margin-top:20px; height:50px; " class="form-control border-primary" name="unit" id="unit" placeholder="unit" required>
      <div class="unit-list"></div>
      <input type="number" style="margin-top:20px; height:50px;" class="form-control border-primary" name="qwt" id="qwt" placeholder="Qwantity">
      <input type="number" style="margin-top:20px; height:50px;" class="form-control border-primary" name="rate" id="rate" placeholder="rate">
      <input type="number" style="margin-top:20px; height:50px;" class="form-control border-primary" name="sellamt" id="sellamt" placeholder="Sell Amount">
      <button style="margin-top:20px; height:55px;" class="form-control border-primary bg-primary text-light">Submit</button>
     </form>
</div>
<div class="display-table"> </div>
<script>
  

// item autocomplete code
       document.querySelector('#item').addEventListener('keyup', function(e){
           let item_val = e.target.value;
           $.ajax({
            url: 'backend_stock.php',
            method: "post",
            data: {item_val:item_val},
            success: function(data){
                $('.name-list').fadeIn("fast").html(data);
              $('.name-list').html(data);
            }
           })
           $(document).on('click', '.name-list li', function(){
            $('#item').val($(this).text());
            $('.name-list').fadeOut();
           })
           
           
       });

// Unit autocomplete code.
       document.querySelector('#unit').addEventListener('keyup', function(e){
           let unit_val = e.target.value;
           $.ajax({
            url: 'backend_stock.php',
            method: "post",
            data: {unit_val:unit_val},
            success: function(data){
                $('.unit-list').fadeIn("fast").html(data);
              $('.unit-list').html(data);
            }
           })
           $(document).on('click', '.unit-list li', function(){
            $('#unit').val($(this).text());
            $('.unit-list').fadeOut();
           })
           
           
       });

// total amount code

   document.querySelector('#rate').addEventListener('keyup', function(e){
       let rate = e.target.value;
       let qwt = document.querySelector('#qwt').value;
       let sumamt = rate * qwt;
       document.querySelector('#sellamt').value = sumamt;
   })



        var form = document.querySelector('#insertform');
        
        // Add event listener for form submission
        form.addEventListener('submit', function(event) {
            // Prevent the default form submission
            event.preventDefault();
            let item = document.querySelector("#item").value;
            let unit = document.querySelector("#unit").value;
            let qwt = document.querySelector("#qwt").value;
            let sellamt = document.querySelector("#sellamt").value;
            
          if (item == "" ) {
          alert("Please add item");
         } else if (unit == "") {
          alert("Please add unit");
         }
          else if (qwt == "") {
            alert("Please add qwt");
          }
            else if (sellamt == "") {
                alert("Please add amount");
         }else {
               $.ajax({
                url: "backend_stocksell.php",
                type: "POST",
                data: {item: item, unit: unit, qwt: qwt, sellamt: sellamt},
                success: function(data){
                 
                 $('.display-table').html(data);
                 $('#item').val("")
                 $('#unit').val("")
                 $('#qwt').val("")
                 $('#rate').val("")
                 $('#sellamt').val("") 
                }
               })   
         }
         

        });
    // });
</script>
</body>
</html>