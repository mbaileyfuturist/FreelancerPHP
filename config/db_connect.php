<?php 
    //Connect to database.
    $conn  = mysqli_connect('localhost', 'Micheal', 'mikespasword123', 'Freelancer');

   //Check Connection.
   if(!$conn){
       echo "Connection Error". mysqli_connect_error();
   }

?>