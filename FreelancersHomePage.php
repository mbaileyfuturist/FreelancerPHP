<?php

  include 'header.php';

  session_start();

  //Database connection.
  include('config/db_connect.php');

  //Retreive the skill and username from the corresponding sessions variable.
  $client_skill = $_SESSION['skill'];
  $user_name = $_SESSION['user_name'];

  //Grab users id, skill where skill = $client_skill AND work_hire = 'Hire'.
  $client_query = "SELECT id, skill FROM users WHERE skill = '$client_skill' AND work_hire = 'Hire'";

  $result1 = mysqli_query($conn, $client_query);

  while($clients_id_skill_row = mysqli_fetch_assoc($result1)){
    $clients_array[] = $clients_id_skill_row;
  }

  //Store id's and skill into an array.
  for($index = 0; $index < count($clients_array); $index++){
    $client_id[] = json_encode($clients_array[$index]['id']);
    //$client_skill[] = json_encode($clients_array[$index]['skill']);
    
    //Remove begining and end quotes.
    $_client_id[] =  trim($client_id[$index], '"');
    $_client_skill[] = trim($client_skill[$index], '"');
  }
  
  for($index = 0; $index < count($client_id); $index++){
    //Grab job_name, job_hourly_rate from jobs where id = $user_id.
    $job_query = "SELECT job_name, job_description, job_hourly_rate, id FROM jobs WHERE id = '$_client_id[$index]'";
  
    $result2 = mysqli_query($conn, $job_query);

    while($job_name_hourly_rate_row = mysqli_fetch_assoc($result2)){
      $jobs_array[] = $job_name_hourly_rate_row;
    }
  }

  //Store job names and job hourly rate into arrays.
  for($index = 0; $index < count($jobs_array); $index++){
    $job_names[] = json_encode($jobs_array[$index]['job_name']);
    $job_descriptions[] = json_encode($jobs_array[$index]['job_description']);
    $job_hourly_rates[] = json_encode($jobs_array[$index]['job_hourly_rate']);
    $job_id[] = json_encode($jobs_array[$index]['id']);

    //Remove begining and end quotes.
    $_job_names[] = trim($job_names[$index], '"');
    $_job_descriptions[] = trim($job_descriptions[$index], '"');
    $_job_hourly_rates[] = trim($job_hourly_rates[$index], '"');
    $_job_id[] = trim($job_id[$index], '"');
  }

  $companies_array = array();
  for($index = 0; $index < count($_client_id); $index++){
    //Grab company_name from company_info where id = $job_id.
    $company_query = "SELECT company_name, mission_statement, id FROM company_info where id = '$_client_id[$index]'";

    $result3 = mysqli_query($conn, $company_query);

    while($company_name_row = mysqli_fetch_assoc($result3)){
      $companies_array[] = $company_name_row;
    }
  }

  //Store company names into an array.
  for($index = 0; $index < count($_client_id); $index++){
    $company_name[] = json_encode($companies_array[$index]['company_name']);
    $_company_name[] = trim($company_name[$index],'"');

    $mission_statement[] = json_encode($companies_array[$index]['mission_statement']);
    $_mission_statement[] = trim($mission_statement[$index], '"');

    $company_id[] = json_encode($companies_array[$index]['id']);
    $_company_id[] = trim($company_id[$index], '"');

  }

?>

    <body>
        
      <nav id = "signup-banner" class="navbar navbar-expand-lg navbar-light bg-primary">
        <h5 id= "user-name" class="text-white"><?php echo "<strong>Welcome: " . " " . $user_name . "</strong>" ?></h5>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <h6><a class="nav-link ml-3" href="freelancerProfile.php"><strong>View Profile</strong></a></h6>
            </li>
            <li class="nav-item">
              <h6><a class="nav-link" href="logout.php"><strong>Log Out</strong></a></h6>
            </li>
          </ul>
        </div>
        <p id="home-logo" class="text-white d-inline">The Freelancer</p>

      </nav>

        <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col" class="text-center">Company</th>
                <th scope="col" class="text-center">Job</th>
                <th scope="col" class="text-center">Skill</th>
                <th scope="col" class="text-center">Offer Price</th>
                <th scope="col" class="text-center">View</th>
              </tr>
            </thead>
            <tbody>
            <?php 
            
            $table_array = array();
            for($index = 0; $index < count($job_names); $index++){
            
            //Iterate through the job ID's and temporarily grab each ID during each iteration.
            $job_id = $_job_id[$index];

            //Iterate through the company ID's.
            for($index2 = 0; $index2 < count($_company_id); $index2++){

              //If the company ID == the temporary job ID, then the two are related via foreign key.
              if($_company_id[$index2] == $job_id){

                //Now we can grab the company name for display.
                $company_name = $_company_name[$index2]; 
                $company_mission = $_mission_statement[$index2];
                $company_table_array[] = $company_name;
                $mission_table_array[] = $company_mission;
                ?>
                <tr>
                  <td class="text-center"><?php echo $company_name; ?></td>
                  <td class="text-center"><?php echo $_job_names[$index]; ?></td>
                  <td class="text-center"><?php echo $client_skill; ?></td>
                  <td class="text-center"><?php echo '$' . $_job_hourly_rates[$index]; ?></td>
                  <td class="text-center"><button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-primary" id="select-<?php echo $index?>">Select</button></td>
                </tr>       
          <?php }
              }
            }?>
            </tbody>
          </table>

          <!-- Modal -->
          <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
            
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header bg-primary">
                  <h3 class="modal-title text-white text-center" id="company-name"></h3>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                  <p id="job-name"></p>
                  <p id="job-description"></p>
                  <p id="company-mission"></p>
                </div>
                <div class="modal-footer bg-primary d-flex justify-content-center">
                  <h4 id="hourly-rate" class="text-white"></h4>
                </div>
              </div>
              
            </div>
          </div>

          <script type="text/javascript">

              //Get the number of jobs.
              var numberOfJobs = <?php echo count($jobs_array); ?>;

              //Get the job names.
              var jobNames = <?php echo json_encode($_job_names); ?>;

              //Get the job ID's
              var jobIDs = <?php echo json_encode($_job_id); ?>;

              //Get the company ID's
              var companyIDs = <?php echo json_encode($_company_id); ?>;

              //Get the job descriptions.
              var jobDescriptions = <?php echo json_encode($_job_descriptions); ?>;

              //Get the company names.
              var companyNames = <?php echo json_encode($company_table_array); ?>;

              //Get the company mission statements.
              var companyMissions = <?php echo json_encode($mission_table_array); ?>;

              //Get the hourly rates for each job.
              var hourlyRates = <?php echo json_encode($_job_hourly_rates); ?>;

              var selectBtnElements = [];
              
              //Array to store the ID's of the job description.
              var selectButtonIDs = [];

              for(var index = 0; index < numberOfJobs; index++){
                
                //Grab the select button element.
                selectBtnElements.push(document.getElementById('select-' + index));

                //Grab the ID's of the select button elements. 
                selectBtnID = selectBtnElements[index].getAttribute("id");

                //Add each ID to the array.
                selectButtonIDs.push(selectBtnID);
                
              }

              //Grab ID of selected button.
              var selectID;
              $("button").click(function() {

                selectID = this.id;

                //Grab the last character of the ID.
                var lastCharacter = selectID.slice(-1);

                //Grab the job name at last character.
                jobName = jobNames[lastCharacter];

                //Grab the job description at lastCharacter.
                var jobDescription = jobDescriptions[lastCharacter];

                //Grab the hourly rate at the last character.
                var hourlyRate = hourlyRates[lastCharacter];

                //Grab the company name at the last character.
                var companyName = companyNames[lastCharacter];

                //Grab the company mission statement at the last character.
                var missionStatement = companyMissions[lastCharacter];

                //Grab the element with ID of company-name.
                var companyNameTag = document.getElementById("company-name");

                //Grab the element with ID of job-name.
                var jobNameTag = document.getElementById("job-name");

                //Grab the element with ID of job-description.
                var jobDescriptionTag = document.getElementById("job-description");
                
                //Grab the element with ID of company-mission.
                var companyMissionTag = document.getElementById("company-mission");
                
                //Grab the element with ID of hourly-rate.
                var hourlyRateTag = document.getElementById("hourly-rate");

                companyNameTag.innerHTML = companyName;
                jobNameTag.innerHTML = jobName;
                jobDescriptionTag.innerHTML = "<strong>Job Description:</strong> " + jobDescription;
                companyMissionTag.innerHTML = "<strong>Company Mission:</strong> " + missionStatement;
                hourlyRateTag.innerHTML = "Pay: $" + hourlyRate + "/hr";

              });

        </script>
<?php
  include 'footer.php';
?>