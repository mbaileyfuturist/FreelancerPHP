<?php
  ob_start();
  session_start();

  include 'header.php';

  if(isset($_POST['submit'])){
      
      //Database connection.
      include('config/db_connect.php');

      //Protection from SQLInjection.
      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $password = mysqli_real_escape_string($conn, $_POST['password']);

      //From the username and password, grab the corresponding work_hire
      //and skill from the users table. 
      $user_type_query = "SELECT email, user_name, password, work_hire, skill FROM users WHERE email = '$email' AND password = '$password'";

      $user_type_result = mysqli_query($conn, $user_type_query);

      $work_hire_to_skill = mysqli_fetch_assoc($user_type_result);
      
      //Store the email, username, work_hire and skill into session variables.
      $_SESSION['email'] = $work_hire_to_skill['email'];
      $_SESSION['user_name'] = $work_hire_to_skill['user_name'];
      $_SESSION['work_hire'] = $work_hire_to_skill['work_hire'];
      $_SESSION['skill'] = $work_hire_to_skill['skill'];

      //If work_hire = Work, then relocate to FreelancersHomePage.php
      if($_SESSION['work_hire'] == 'Work'){
        header('Location: FreelancersHomePage.php');
      }
      //else-if work_hire = work, then relocate to ClientHomePage.php
      elseif($_SESSION['work_hire'] == 'Hire'){
        header('Location: ClientHomePage.php');
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