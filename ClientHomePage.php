<?php

    session_start();

    include 'header.php';

    //Database connection.
    include('config/db_connect.php');

    //Retreive the skill and username from the corresponding sessions variable.
    $client_skill = $_SESSION['skill'];
    $user_name = $_SESSION['user_name'];

    //Select all users where work_hire = Work and skill = skill of the client.
    $freelancers_name_query = "SELECT id, first_name, last_name, skill FROM users WHERE work_hire = 'Work' AND skill = '$client_skill'";

    $freelancers_name_result = mysqli_query($conn, $freelancers_name_query);

    while($row = mysqli_fetch_assoc($freelancers_name_result)) {
      $array[] = $row;
    }

    for($index = 0; $index < count($array); $index++){
      $freelancer_id[] = json_encode($array[$index]['id']);
      $freelancer_first_name[] = json_encode($array[$index]['first_name']);
      $freelancer_last_name[] = json_encode($array[$index]['last_name']);
      $freelancer_skill[] = json_encode($array[$index]['skill']); 

      //Remove begining and end quotes.
      $_freelancer_id[] = trim($freelancer_id[$index], '"');
      $_freelancer_first_name[] = trim($freelancer_first_name[$index], '"');
      $_freelancer_last_name[] = trim($freelancer_last_name[$index], '"');
      $_freelancer_skill[] = trim($freelancer_skill[$index], '"');
    }

    /**************************************************************************************************************** */
    //Select freelancers hourly_pay, bio, and services based on the freelancer_id array.
    for($index = 0; $index < count($array); $index++){
      $freelancers_bio_query = "SELECT hourly_pay, bio, services FROM profile_info WHERE id = '$_freelancer_id[$index]'";

      $freelancers_bio_results = mysqli_query($conn, $freelancers_bio_query);

      while($row = mysqli_fetch_assoc($freelancers_bio_results)) {
        $freelancers_bio_array[] = $row;
      }
    }

    $freelancers_bio = array();
    $freelancers_hourly_pay = array();
    for($index = 0; $index < count($freelancers_bio_array); $index++){
      $freelancers_bio[] = json_encode($freelancers_bio_array[$index]['bio']);
      $freelancers_hourly_pay[] = json_encode($freelancers_bio_array[$index]['hourly_pay']);
      $freelancers_services[] = json_encode($freelancers_bio_array[$index]['services']);

      $_freelancers_bio[] = trim($freelancers_bio[$index], '"');
      $_freelancers_hourly_pay[] = trim($freelancers_hourly_pay[$index], '"');
      $_freelancers_services[] = trim($freelancers_services[$index], '"');
    }

?>
    <body>
        
      <nav id = "signup-banner" class="navbar navbar-expand-lg navbar-light bg-primary">
        <h5 id="user-name" class="text-white"><?php echo "<strong>Welcome: " . " " . $user_name . "</strong>" ?></h5>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <h6><a class="nav-link ml-3" href="clientProfile.php"><strong>Profile</strong></a></h6>
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
                <th scope="col" class="text-center">Full Name</th>
                <th scope="col" class="text-center">Bio</th>
                <th scope="col" class="text-center">Hourly Rate</th>
                <th scope="col" class="text-center">View</th>
              </tr>
            </thead>
            <tbody>

            <?php for($index = 0; $index < count($array); $index++) {?>
              <tr>
                <td class="text-center"><?php echo $_freelancer_first_name[$index] . " " . $_freelancer_last_name[$index];?></td>
                <td class="text-center" style="width:30%"><?php echo $_freelancers_bio[$index]; ?></td>
                <td class="text-center"><?php echo '$' . $_freelancers_hourly_pay[$index]; ?></td>
                <td class="text-center"><button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-primary" id="select-<?php echo $index?>">Select</button></td>
              </tr>
            <?php } ?>
              
            </tbody>
          </table>

          <!-- Modal -->
          <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
            
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header  bg-primary">
                  <h4 id="full-name" class="text-white"></h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                  <p id="bio"></p>
                  <p id="service-description"></p>
                </div>
                <div class="modal-footer bg-primary d-flex justify-content-center">
                  <h4 id="hourly-rate" class="text-white"></h4>
                </div>
              </div>
              
            </div>
          </div>

          <script type="text/javascript">

              //Get the number of jobs.
              var numberOfServices = "<?php echo count($array); ?>";

              console.log(numberOfServices);

              //Grab the freelancers first name.
              var firstNames = <?php echo json_encode($_freelancer_first_name); ?>;

              //Grab the freelancers last name.
              var lastNames = <?php echo json_encode($_freelancer_last_name); ?>;

              //Grab the freelancers bios.
              var freelancersBios = <?php echo json_encode($_freelancers_bio); ?>;

              //Grab the services the freelancers offers.
              var serviceDescriptions = <?php echo json_encode($_freelancers_services); ?>;

              //Grab the hourly rates the freelancers charge.
              var hourlyRates = <?php echo json_encode($_freelancers_hourly_pay); ?>;

              var selectBtnElements = [];

              //Array to store the ID's of the service description.
              var selectButtonIDs = [];

              for(var index = 0; index < numberOfServices; index++){
                
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
                var serviceDescription = serviceDescriptions[lastCharacter];

                //Grab the freelancers bio at last character.
                var freelancersBio = freelancersBios[lastCharacter];

                //Grab the first name at last character.
                var firstName = firstNames[lastCharacter];

                //Grab the last name at last character.
                var lastName = lastNames[lastCharacter];

                //Grab the hourly rate at the last character.
                var hourlyRate = hourlyRates[lastCharacter];

                //Grab the element with the tag name full-name. 
                var fullNameTag = document.getElementById("full-name");

                //Grab the element with the tag name service-description.
                var serviceDescriptionTags = document.getElementById("service-description");
                
                //Grab the element with the tag name bio.
                var bioTag = document.getElementById("bio");

                //Grab the element with the tag name hourly-rate.
                var hourlyRateTag = document.getElementById("hourly-rate");

                fullNameTag.innerHTML = firstName + " " + lastName;
                serviceDescriptionTags.innerHTML = "<strong>Services: </strong>" + serviceDescription;
                bioTag.innerHTML = "<strong>Bio:</strong> " + freelancersBio;
                hourlyRateTag.innerHTML = "Pay: $" + hourlyRate + "/hr";
              });

        </script>

<?php
  include 'footer.php';
?>