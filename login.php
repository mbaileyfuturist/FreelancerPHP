<?php
  ob_start();
  session_start();

  include 'header.php';

  $errors = array('email' => '', 'password' => '');

  if(isset($_POST['submit'])){
      
      //Database connection.
      include('config/db_connect.php');

      //Protection from SQLInjection.
      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $password = mysqli_real_escape_string($conn, $_POST['password']);
     
      //Form Validation for empty input.
      if(empty($_POST['email'])){
        $errors['email'] = 'Please enter a valid email address.';
      }
      if(empty($_POST['password'])){
        $errors['password'] = 'Please enter a valid password.';
      }
     
      //SQL query to grab all emails and passwords from the users table.
      $login_query = "SELECT email, password FROM users";

      //Make query and get result.
      $result = mysqli_query($conn, $login_query);

      //Store these values in a dictionary using email = key and password = value;
      $email_to_password = mysqli_fetch_assoc($result);

      //Use linear search to compare the value of email and password. If they match then move on to signup.php
      foreach($email_to_password as $local_email => $local_password){
        if(($email_to_password['email'] == $email) && ($email_to_password['password'] == $password)){
          header("Location: jobs.php");
        }
      }
  }
?>
    <body>
        
        <div class="d-flex justify-content-center login-container">
            <form action="login.php" method="POST">
                <div class="form-group">
                  <label>Email address</label>
                  <input type="email" class="form-control" id = "email" name = "email" placeholder="Enter email">
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input type="password" class="form-control" id = "password" name = "password" placeholder="Password">
                </div>
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">Stay signed in</label>
                </div>
                <small id="emailHelp" class="form-text text-muted">Dont have an account? <a href="signup.php" class="text-info">sign up here.</a></small>
                <button type="submit" name="submit" class="btn btn-primary mt-3">Log in</button>
              </form>
        </div>
<?php
  include 'footer.php';
?>