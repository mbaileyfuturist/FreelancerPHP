<?php
  include 'header.php';

  $errors = array('first_name' => '', 'last_name' => '', 'email' => '', 'user_name' => '', 'password' => '');

  if(isset($_POST['submit'])){
      
      //Database connection.
      include('config/db_connect.php');

      //Protection from SQLInjection.
      $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
      $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
      $password = mysqli_real_escape_string($conn, $_POST['password']);
      $work_hire = mysqli_real_escape_string($conn, $_POST['work_hire']);
      $skill = mysqli_real_escape_string($conn, $_POST['skills']);

      //Form Validation for empty input.
      if(empty($_POST['first_name'])){
        $errors['first_name'] = 'Please enter a valid first name.';
      }
      if(empty($_POST['last_name'])){
        $errors['last_name'] = 'Please enter a valid last name.';
      }
      if(empty($_POST['email'])){
        $errors['email'] = 'Please enter a valid email address.';
      }
      if(empty($_POST['user_name'])){
        $errors['user_name'] = 'Please enter a valid username.';
      }
      if(empty($_POST['password'])){
        $errors['password'] = 'Please enter a valid password.';
      }

      if(!$empty){
        //SQL insert query
        $sql = "INSERT INTO users(first_name, last_name, email, user_name, password, work_hire, skill) VALUES('$first_name', '$last_name', '$email', '$user_name', '$password', '$work_hire', '$skill')";
      
        //Insert value.
        mysqli_query($conn, $sql);
      }

      header("Location: education.php");
     
  }
?>

    <body>
        
        <div class="d-flex justify-content-center sign-up-container">
            <form action="signup.php" method="POST">
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputEmail4">First name</label>
                    <input type="text" class="form-control" id="first_name" placeholder="First name" name="first_name">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputPassword4">Last name</label>
                    <input type="text" class="form-control" id="last_name" placeholder="Last name" name="last_name">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputAddress">Email</label>
                  <input type="email" class="form-control" id="email" placeholder="example@email.com" name="email">
                </div>
                <div class="form-group">
                    <label for="inputAddress2">Username</label>
                    <input type="text" class="form-control" id="username" placeholder="Username" name="user_name">
                  </div>
                <div class="form-group">
                  <label for="inputAddress2">Password</label>
                  <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                </div>

                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                  <label class="btn btn-secondary active">
                    <input type="radio" name="work_hire" value="Hire" id="option1" autocomplete="off" checked> Hire
                  </label>
                  <label class="btn btn-secondary">
                    <input type="radio" name="work_hire" value="Work" id="option2" autocomplete="off"> Work
                  </label>
                </div>
                
                <div class="form-group mt-3">
                  <label for="skills">Please choose a Skill:</label>

                  <select name="skills" id="skillcods">
                  <option value="graphic">Graphic Design</option>
                  <option value="logo">Logo Design</option>
                  <option value="web">Web Design</option>
                  <option value="front-end">Front End Web Development</option>
                  <option value="back-end">Back End Web Development</option>

                  </select>
              </div>

                <button type="submit" name="submit" class="btn btn-primary d-block mt-3">Sign Up</button>
              </form>
        </div>

<?php
  include 'footer.php';
?>