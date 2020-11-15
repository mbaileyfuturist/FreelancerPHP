<?php

  include 'header.php';

  session_start();

  //Database connection.
  include('config/db_connect.php');

  //Retreive the skill from the corresponding sessions variable.
  $client_skill = $_SESSION['skill'];

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
    $company_query = "SELECT company_name, id FROM company_info where id = '$_client_id[$index]'";

    $result3 = mysqli_query($conn, $company_query);

    while($company_name_row = mysqli_fetch_assoc($result3)){
      $companies_array[] = $company_name_row;
    }
  }

  //Store company names into an array.
  for($index = 0; $index < count($_client_id); $index++){
    $company_name[] = json_encode($companies_array[$index]['company_name']);
    $_company_name[] = trim($company_name[$index],'"');

    $company_id[] = json_encode($companies_array[$index]['id']);
    $_company_id[] = trim($company_id[$index], '"');
    //echo $_company_name[$index] . "<br>";
  }

?>

    <body>
        
      <nav class="navbar navbar-expand-lg navbar-light bg-secondary">
        <a class="navbar-brand" href="#">Username</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="freelancerProfile.php">Profile <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="logout.php">Log Out</a>
            </li>
          </ul>
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
          </form>
        </div>
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

            for($index = 0; $index < count($job_names); $index++){
            $job_id = $_job_id[$index];
            for($index2 = 0; $index2 < count($_company_id); $index2++){
              if($_company_id[$index2] == $job_id){
                $company_name = $_company_name[$index2]; ?>
                <tr>
                <td class="text-center"><?php echo $company_name; ?></td>
                <td class="text-center"><?php echo $_job_names[$index2]; ?></td>
                <td class="text-center"><?php echo $_client_skill[$index2]; ?></td>
                <td class="text-center"><?php echo $_job_hourly_rates[$index2]; ?></td>
                <td class="text-center"><button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-success" id="select-<?php echo $index?>">Select</button></td>
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

          <script type="text/javascript">

              //Get the number of jobs.
              var numberOfJobs = "<?php echo count($jobs_array); ?>";

              //Setting job descriptions from php array to js array for later use.
              var jobDescriptions = <?php echo json_encode($_job_descriptions); ?>;

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