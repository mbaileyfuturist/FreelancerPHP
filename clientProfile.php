<?php

  include 'header.php';

  session_start();

  //Grab the user id from the login screen.
  $foreign_key = $_SESSION['id'];
  $skill = $_SESSION['skill'];

  //Database connection.
  include('config/db_connect.php');

  //Retrive the last id from the users table to use as foriegn key later.
  $company_info_query = "SELECT company_name, address, city, state, zip, mission_statement, id FROM company_info WHERE id = '$foreign_key'";

  //Make Query and get result.
  $company_info_result = mysqli_query($conn, $company_info_query);

  //Fetch query as associative array.
  $company_info_associative_array = mysqli_fetch_assoc($company_info_result);

  $company_name = $company_info_associative_array['company_name'];
  $company_address = $company_info_associative_array['address'];
  $mission_statement = $company_info_associative_array['mission_statement'];

  //We will use this in jobDescription.php
  $_SESSION['mission_statement'] = $mission_statement;

  /**************************************************************************************************************/

  $company_jobs_query = "SELECT job_name, job_description, job_hourly_rate FROM jobs WHERE id = '$foreign_key'";

  $company_jobs_result = mysqli_query($conn, $company_jobs_query);

  while($company_jobs_row = mysqli_fetch_assoc($company_jobs_result)){
    $jobs_array[] = $company_jobs_row;
  }

  //Store job_name and job_hourly_rate intoand array.
  for($index = 0; $index < count($jobs_array); $index++){
    $job_name[] = json_encode($jobs_array[$index]['job_name']);
    $job_hourly_rate[] = json_encode($jobs_array[$index]['job_hourly_rate']);

    $_job_name[] = trim($job_name[$index], '"');
    $_job_hourly_rate[] = trim($job_hourly_rate[$index], '"');
  }

  if(isset($_POST['submit-1'])){
    //header('Location: editActiveProfile.php');
  }

  if(isset($_POST['submit-2'])){
    header('Location: addNewJobs.php');
  }

  if(isset($_POST['submit-3'])){
    //header('Location: contactClient.php');
  }

  if(isset($_POST['submit-4'])){
    header('Location: ClientHomePage.php');
  }
?>

    <body>
    
        <div class="profile-pic mt-3">
            <h2 class="mt-5 text-center text-white">Compnay Logo</h2>
          </div>
    
          <h4 class="text-center mt-3"><?php echo $company_name ?></h4>
          <h4 class="text-center mt-2"><?php echo $company_address ?></h4>

          <div class="mt-5 mb-5" style="width:50%;margin-left:25%;">
              <h5 class="text-center Company-description"><?php echo $mission_statement ?></h5>
          </div>

          <table class="table list-of-projects-company-offers">
            <thead class="thead-dark">
              <tr>
                <th scope="col" class="text-center">Project</th>
                <th scope="col" class="text-center">Skill Required</th>
                <th scope="col" class="text-center">Offer Price</th>
                <th scope="col" class="text-center">View</th>

              </tr>
            </thead>
            <tbody>
            
            <?php for($index = 0; $index < count($jobs_array); $index++){?>
                <tr>
                  <td class="text-center"><?php echo $_job_name[$index]; ?></td>
                  <td class="text-center"><?php echo $skill; ?></td>
                  <td class="text-center"><?php echo $_job_hourly_rate[$index]; ?></td>
                  <td class="text-center"><a href="jobDescription.php"><button class="btn btn-success">Select</button></a></td>
                </tr>
            <?php }?>
             
            </tbody>
          </table>

          <form action="clientProfile.php" method="POST">
            <div class="mt-5 mb-5 d-flex justify-content-center">
              <button class="btn btn-primary mr-3" name="submit-1" type="submit">Edit Profile</button>
              <button class="btn btn-primary mr-3" name="submit-2" type="submit">New Job</button>
              <button class="btn btn-primary mr-3" name="submit-3" type="submit">Contact</button>
              <button class="btn btn-primary" name="submit-4" type="submit">Done</button>
            </div>
          </form>
<?php
  include 'footer.php';
?>