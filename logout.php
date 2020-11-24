<?php

   include 'header.php';

   session_start();
   unset($_SESSION["email"]);
   unset($_SESSION["password"]);
   
   header('Refresh: 3; URL = login.php');
?>

<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Log Out</title>
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="">
   </head>
   <body>
      <div class="content">
         <div id="cube8" class="logout-cube bg-primary"></div>
         <div id="cube9" class="logout-cube bg-primary"></div>
         <div id="cube10" class="logout-cube bg-primary"></div>
         <div id="cube11" class="logout-cube bg-primary"></div>
         <div id="cube12" class="logout-cube bg-primary"></div>
         <div id="cube13" class="logout-cube bg-primary"></div>

         <p class="display-4 text-center text-primary" id="logout-text">Thanks for visiting, please come back again!</p>
      </div>
   </body>
</html>

<?php
   include 'footer.php';
?>