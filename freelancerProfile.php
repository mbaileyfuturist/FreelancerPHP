<?php
  include 'header.php';

  session_start();

  //Database connection.
  include('config/db_connect.php');

  //Grab the user id from the login screen.
  $foreign_key = $_SESSION['id'];

  //Retrive the users first_name, last_name.
  $freelancer_name_query = "SELECT first_name, last_name, skill FROM users WHERE id = '$foreign_key'";

  $freelancer_name_results = mysqli_query($conn, $freelancer_name_query);

  $freelancer_name_associtaive_array = mysqli_fetch_assoc($freelancer_name_results);

  $first_name = $freelancer_name_associtaive_array['first_name'];
  $last_name = $freelancer_name_associtaive_array['last_name'];
  $skill = $freelancer_name_associtaive_array['skill'];

  /****************************************************************************************************/

  //Retreive hourly_pay and bio.
  $freelancer_info_query = "SELECT hourly_pay, bio, services FROM profile_info WHERE id = '$foreign_key'";

  $freelancer_info_results = mysqli_query($conn, $freelancer_info_query);

  $freelancer_info_associtaive_array = mysqli_fetch_assoc($freelancer_info_results);

  $hourly_pay = $freelancer_info_associtaive_array['hourly_pay'];
  $bio = $freelancer_info_associtaive_array['bio'];
  $services = $freelancer_info_associtaive_array['services'];
  
  if(isset($_POST['submit-1'])){
    header('Location: FreelancersHomePage.php');
  }
?>
    <body>
    
        <div class="profile-pic mt-3">
            <h2 class="mt-5 text-center text-white">profile pic</h2>
          </div>
    
          <h4 class="text-center mt-3"><?php echo $first_name . " " . $last_name; ?></h4>
          <h4 class="text-center mt-2"><?php echo $skill; ?></h4>
          <h4 class="text-center mt-2"><?php echo $hourly_pay; ?></h4>

          <div class="mt-5" style="width:50%;margin-left:25%;">
              <h4 class="text-center">Bio</h6>
              <h5 class="text-center bio"><?php echo $bio ?></h5></br>
              <h4 class="text-center">Services</h6>
              <h5 class="text-center services-offered"><?php echo $services ?></h5>
          </div>

          <form action="freelancerProfile.php" method="POST">
            <div class="mt-5 d-flex justify-content-center">
              <button class="btn btn-primary" type="submit" name="submit-1">Done</button>
            </div>
          </form>

<?php
  include 'footer.php';
?>