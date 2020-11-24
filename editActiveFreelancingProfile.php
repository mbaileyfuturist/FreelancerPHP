<?php
  include 'header.php';

  session_start();

  //Grab the user info from the login screen.
  $user_id = $_SESSION['id'];

  $first_name = $_SESSION['first_name'];
  $last_name = $_SESSION['last_name'];
  $skill = $_SESSION['skill'];

  if(isset($_POST['submit-1'])){
    header('Location:freelancerProfile.php');
  }

  if(isset($_POST['submit-2'])){
      
      //Database connection.
      include('config/db_connect.php');

      /************************************************************************************************ */
      
      //Protection from SQLInjection.
      $hourly_pay = mysqli_real_escape_string($conn, $_POST['hourly_pay']);
      $website = mysqli_real_escape_string($conn, $_POST['website']);
      $bio = mysqli_real_escape_string($conn, $_POST['bio']);
      $services = mysqli_real_escape_string($conn, $_POST['services']);
      
      //Update user information based on their id.
      $sql = "UPDATE profile_info SET hourly_pay = '$hourly_pay', website = '$website', bio = '$bio', services = '$services' WHERE id = '$user_id'";
      
      //Insert value.
      mysqli_query($conn, $sql);
     
      header("Location:freelancerProfile.php");
  }
?>
    <body>
        
    <div id="signup-banner" class="bg-primary pt-2 mb-5">
        <p id="signup-logo" class="text-white d-inline ml-3">The Freelancer</p>
      </div>

      <h4 class="text-center mt-3"><?php echo $first_name . " " . $last_name ?></h4>
      <h4 class="text-center mt-3"><?php echo $skill ?></h4>

      <div class="d-flex justify-content-center mt-5">
        <div class="card" style="width: 33rem;border-style:solid;border-width:2px;border-color:#0275d8;">
            <div class="card-body">
            <h4 class="card-title signup-card-title text-dark"><strong>Edit Profile</strong></h4>
        <form action="editActiveFreelancingProfile.php" method="POST" class="profile-description-form">
          <div class="form-group">
            <label for="hourlyPay">Hourly Pay</label>
            <input type="text" class="form-control" id="hourly_pay" name="hourly_pay" aria-describedby="hourlyPay" placeholder="$0.00">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Website</label>
            <input type="text" class="form-control" id="website" name="website" aria-describedby="emailHelp" placeholder="domain.com">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Bio</label>
            <textarea type="text" class="form-control" id="bio" name="bio" placeholder="Tell us about yourself!"></textarea>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Services</label>
            <textarea type="text" class="form-control" id="services" name="services" placeholder="Please describe the services you can provide relating to your skillset."></textarea>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Upload Resume</label>
            <input type="file" id="resumeInput" name="resumeInput"></input>
          </div>
          <button type="submit" name="submit-1" class="btn btn-primary mb-5">Cancel</button>
          <button type="submit" name="submit-2" class="btn btn-primary mb-5">Update</button>
        </form>
        </div>
      </div>
<?php
  include 'footer.php';
?>