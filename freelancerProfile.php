<?php
  include 'header.php';

  session_start();

  //Database connection.
  include('config/db_connect.php');

  //Grab the user id from the login screen.
  $foreign_key = $_SESSION['id'];

  //If the user has just logged in, elseif the user has just signed up.
  if($_SESSION['signup'] == false){

    //Retrive the users first_name, last_name.
    $freelancer_name_query = "SELECT first_name, last_name, skill FROM users WHERE id = '$foreign_key'";

    $freelancer_name_results = mysqli_query($conn, $freelancer_name_query);

    $freelancer_name_associtaive_array = mysqli_fetch_assoc($freelancer_name_results);

    $first_name = $freelancer_name_associtaive_array['first_name'];
    $last_name = $freelancer_name_associtaive_array['last_name'];
    $skill = $freelancer_name_associtaive_array['skill'];

    $_SESSION['first_name'] = $first_name;
    $_SESSION['last_name'] = $last_name;
    $_SESSION['skill'] = $skill;

    /****************************************************************************************************/

    //Retreive hourly_pay and bio.
    $freelancer_info_query = "SELECT hourly_pay, bio, services FROM profile_info WHERE id = '$foreign_key'";

    $freelancer_info_results = mysqli_query($conn, $freelancer_info_query);

    $freelancer_info_associtaive_array = mysqli_fetch_assoc($freelancer_info_results);

    $hourly_pay = $freelancer_info_associtaive_array['hourly_pay'];
    $bio = $freelancer_info_associtaive_array['bio'];
    $services = $freelancer_info_associtaive_array['services'];

  }
  elseif($_SESSION['signup'] == true){

    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $skill = $_SESSION['skill'];
    $bio = $_SESSION['bio'];
    $services = $_SESSION['services'];
    $hourly_pay = $_SESSION['hourly_pay'];

  }
  
  if(isset($_POST['submit-1'])){
    header('Location: editActiveFreelancingProfile.php');
  }
  if(isset($_POST['submit-2'])){
    header('Location: FreelancersHomePage.php');
  }

?>
    <body>
    
          <div id="signup-banner" class="bg-primary pt-2">
            <p id="signup-logo" class="text-white d-inline ml-3">The Freelancer</p>
          </div>
    
          <div style="margin-top: 10%;">
            <h4 class="text-center mt-3"><?php echo $first_name . " " . $last_name; ?></h4>
            <h4 class="text-center mt-2"><?php echo $skill; ?></h4>
            <h4 class="text-center mt-2"><?php echo $hourly_pay; ?></h4>
          </div>

          <div class="mt-5" style="width:50%;margin-left:25%;">
              <h4 class="text-center">Bio</h6>
              <h5 class="text-center bio"><?php echo $bio ?></h5></br>
              <h4 class="text-center">Services</h6>
              <h5 class="text-center services-offered"><?php echo $services ?></h5>
          </div>

          <form action="freelancerProfile.php" method="POST">
            <div class="mt-5 d-flex justify-content-center">
              <button class="btn btn-primary mr-3" name="submit-1" type="submit">Edit Profile</button>
              <button class="btn btn-primary" name="submit-2" type="submit">Done</button>
            </div>
          </form>

<?php
  include 'footer.php';
?>