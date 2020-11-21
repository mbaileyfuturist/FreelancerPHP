<?php
  include 'header.php';

  $errors = array('first_name' => '', 'last_name' => '', 'email' => '', 'user_name' => '', 'password' => '');

  if(isset($_POST['submit-1'])){
    header("Location: login.php");
  }


  if(isset($_POST['submit-2'])){
      
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

      if($work_hire == "Work"){
        header("Location: education.php");
      }else{
        header("Location: companyInfo.php");
      }
     
  }
?>

    <body>
        <div id="signup-banner" class="bg-primary pt-2">
          <p id="signup-logo" class="text-white d-inline ml-3">The Freelancer</p>
          <h5 class="text-white d-inline banner-text">Welcome new user, to register please fill out the appropriate information below.</h5>
        </div>

        <div class="d-flex justify-content-center sign-up-container">
        <div class="card" style="width: 25rem;border-style:solid;border-width:2px;border-color:#0275d8;">
          <div class="card-body">
            <h4 class="card-title signup-card-title text-dark"><strong>Registration</strong></h4>
            <form action="signup.php" method="POST">
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label class="text-dark" for="inputEmail4"><strong>First name</strong></label>
                    <input type="text" class="form-control" id="first_name" placeholder="First name" name="first_name">
                  </div>  
                  <div class="form-group col-md-6">
                    <label class="text-dark" for="inputPassword4"><strong>Last name</strong></label>
                    <input type="text" class="form-control" id="last_name" placeholder="Last name" name="last_name">
                  </div>
                </div>

                <div class="form-group">
                  <label class="text-dark" for="inputAddress"><strong>Email</strong></label>
                  <input type="email" class="form-control" id="email" placeholder="example@email.com" name="email">
                </div>
                <div class="form-group">
                    <label class="text-dark" for="inputAddress2"><strong>Username</strong></label>
                    <input type="text" class="form-control" id="username" placeholder="Username" name="user_name">
                  </div>
                <div class="form-group">
                  <label class="text-dark" for="inputAddress2"><strong>Password</strong></label>
                  <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                </div>

                <p class="d-block mt-4 text-dark"><strong>Are you looking for work or looking to hire?</strong></p>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                  <label class="btn btn-secondary active">
                    <input type="radio" name="work_hire" value="Hire" id="option1" autocomplete="off" checked> Hire
                  </label>
                  <label class="btn btn-secondary">
                    <input type="radio" name="work_hire" value="Work" id="option2" autocomplete="off"> Work
                  </label>
                </div>
                
                <div class="d-block mt-4">
                  <label class="text-dark" for="skills"><strong>Please choose a skill below</strong></label>

                  <select name="skills" id="skills">
                  <option value="graphic">Graphic Design</option>
                  <option value="logo">Logo Design</option>
                  <option value="web">Web Design</option>
                  <option value="front-end">Front End Web Development</option>
                  <option value="back-end">Back End Web Development</option>

                  </select>
                </div>

              <button type="submit" name="submit-1" class="btn btn-primary d-inline mt-4">Cancel</button>
              <button type="submit" name="submit-2" class="btn btn-primary d-inline mt-4 ml-3">Sign Up</button>
              </form>
          </div>
        </div>

        
        

<?php
  include 'footer.php';
?>