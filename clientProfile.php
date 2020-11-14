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

  /**************************************************************************************************************/

  $company_jobs_query = "SELECT job_name, job_description, job_hourly_rate FROM jobs WHERE id = '$foreign_key'";

  $company_jobs_result = mysqli_query($conn, $company_jobs_query);

  while($company_jobs_row = mysqli_fetch_assoc($company_jobs_result)){
    $jobs_array[] = $company_jobs_row;
  }

  $_job_description = array();
  //Store job_name and job_hourly_rate intoand array.
  for($index = 0; $index < count($jobs_array); $index++){
    $job_name[] = json_encode($jobs_array[$index]['job_name']);
    $job_hourly_rate[] = json_encode($jobs_array[$index]['job_hourly_rate']);
    $job_description[] = json_encode($jobs_array[$index]['job_description']);

    $_job_name[] = trim($job_name[$index], '"');
    $_job_hourly_rate[] = trim($job_hourly_rate[$index], '"');
    $_job_description[] = trim($job_description[$index], '"');
  }

  //We will use this in jobDescription.php
  $_SESSION['job_name'] = $_job_name;
  $_SESSION['job_hourly_rate'] = $_job_hourly_rate;
  $_SESSION['job_description'] = $_job_description;

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
                  <td class="text-center"><button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-success" id="select-<?php echo $index?>">Select</button></td>
                </tr>
            <?php }?>
             
            </tbody>
          </table>

          <!-- Modal -->
          <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
            
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Modal Header</h4>
                </div>
                <div class="modal-body">
                  <p id="job-description"></p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
              
            </div>
          </div>

          <form action="clientProfile.php" method="POST">
            <div class="mt-5 mb-5 d-flex justify-content-center">
              <button class="btn btn-primary mr-3" name="submit-1" type="submit">Edit Profile</button>
              <button class="btn btn-primary mr-3" name="submit-2" type="submit">New Job</button>
              <button class="btn btn-primary mr-3" name="submit-3" type="submit">Contact</button>
              <button class="btn btn-primary" name="submit-4" type="submit">Done</button>
            </div>
          </form>

          <script type="text/javascript">

              //Get the number of jobs.
              var numberOfJobs = "<?php echo count($jobs_array); ?>";

              //Setting job descriptions from php array to js array for later use.
              var jobDescriptions = <?php echo json_encode($_job_description); ?>;

              var selectBtnElements = []
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

                //Grab the job description at lastCharacter.
                var jobDescription = jobDescriptions[lastCharacter];

                //Store the job description into the p tags within the modal-body div.
                var jobDescriptionTags = document.getElementById("job-description");
                
                jobDescriptionTags.innerHTML = jobDescription;
              });

        </script>

<?php
  include 'footer.php';
?>