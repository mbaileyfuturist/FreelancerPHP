<?php
  include 'header.php';

  $errors = array('hourly_pay' => '', 'website' => '', 'bio' => '', 'services' => '');

  if(isset($_POST['submit-1'])){
    header('Location:projects.php');
  }

  if(isset($_POST['submit-2'])){
      
      //Database connection.
      include('config/db_connect.php');

      //Retrive the last id from the users table to use as foriegn key later.
      $idquery = "SELECT * FROM users ORDER BY id DESC LIMIT 1";

      //Make Query and get result.
      $result = mysqli_query($conn, $idquery);

      //Fetch query as associative array.
      $lastrow = mysqli_fetch_assoc($result);

      //Store foreign key into variable to insert into our table later.
      $foreign_key = $lastrow['id'];

      /************************************************************************************************ */
      
      //Protection from SQLInjection.
      $hourly_pay = mysqli_real_escape_string($conn, $_POST['hourly_pay']);
      $website = mysqli_real_escape_string($conn, $_POST['website']);
      $bio = mysqli_real_escape_string($conn, $_POST['bio']);
      $services = mysqli_real_escape_string($conn, $_POST['services']);
      

      //Form Validation for empty input.
      if(empty($_POST['hourly_pay'])){
        $errors['hourly_pay'] = 'Please enter a valid hourly rate.';
      }
      if(empty($_POST['website'])){
        $errors['website'] = 'Please enter a valid domain name';
      }
      if(empty($_POST['bio'])){
        $errors['bio'] = 'Please enter a valid bio';
      }
      if(empty($_POST['services'])){
        $errors['services'] = 'Please enter valid services';
      }

      if(!$empty){
        //SQL insert query
        $sql = "INSERT INTO profile_info(hourly_pay, website, bio, services, id) VALUES('$hourly_pay', '$website', '$bio', '$services', '$foreign_key')";
      
        //Insert value.
        mysqli_query($conn, $sql);
      }
     
      header("Location: FreelancersHomePage.php");
  }
?>
    <body>
        
      <div id="signup-banner" class="bg-primary pt-2 mb-5">
        <p id="signup-logo" class="text-white d-inline ml-3">The Freelancer</p>
        <h5 class="text-white d-inline banner-text-profile-description">Almost done, just add a little bit more information about yourself.</h5>
      </div>

      <h4 class="text-center mt-5">Full Name</h4>
      <h4 class="text-center mt-3">Skill Type</h4>

      <div class="d-flex justify-content-center mt-5">
        <div class="card" style="width: 33rem;border-style:solid;border-width:2px;border-color:#0275d8;">
            <div class="card-body">
            <h4 class="card-title signup-card-title text-dark"><strong>Profile Description</strong></h4>
              <form action="profileDescription.php" method="POST" class="profile-description-form">
              <div class="form-group">
                <label for="hourlyPay" class="text-dark"><strong>Hourly Pay</strong></label>
                <input type="text" class="form-control" id="hourly_pay" name="hourly_pay" aria-describedby="hourlyPay" placeholder="$0.00">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1" class="text-dark"><strong>Website</strong></label>
                <input type="text" class="form-control" id="website" name="website" aria-describedby="emailHelp" placeholder="domain.com">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1" class="text-dark"><strong>Bio</strong></label>
                <textarea type="text" class="form-control" id="bio" name="bio" placeholder="Tell us about yourself!"></textarea>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1" class="text-dark"><strong>Services</strong></label>
                <textarea type="text" class="form-control" id="services" name="services" placeholder="Please describe the services you can provide relating to your skillset."></textarea>
              </div>
              <div class="form-group mt-4">
                <label for="exampleInputPassword1" class="text-dark"><strong>Upload Resume:</strong></label>
                <input type="file" id="resumeInput" name="resumeInput"></input>
              </div>
              <button type="submit" name="submit-1" class="btn btn-primary mb-5">Back</button>
              <button type="submit" name="submit-2" class="btn btn-primary mb-5">Finish</button>
              </form>
            </div>
        </div>
      </div>

<?php
  include 'footer.php';
?>