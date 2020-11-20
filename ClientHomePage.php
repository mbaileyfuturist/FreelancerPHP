<?php

    session_start();

    include 'header.php';

    //Database connection.
    include('config/db_connect.php');

    //Retreive the skill from the corresponding sessions variable.
    $client_skill = $_SESSION['skill'];

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
        
      <nav class="navbar navbar-expand-lg navbar-light bg-secondary">
        <a class="navbar-brand" href="#">Username</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="clientProfile.php">Profile <span class="sr-only">(current)</span></a>
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
                <td class="text-center"><button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-success" id="select-<?php echo $index?>">Select</button></td>
              </tr>
            <?php } ?>
              
            </tbody>
          </table>

          <!-- Modal -->
          <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
            
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 id="full-name"></h4>
                </div>
                <div class="modal-body">
                  <p id="bio"></p>
                  <p id="service-description"></p>
                </div>
                <div class="modal-footer">
                  <h4 id="hourly-rate"></h4>
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
                serviceDescriptionTags.innerHTML = "Services: " + serviceDescription;
                bioTag.innerHTML = "Bio: " + freelancersBio;
                hourlyRateTag.innerHTML = "$" + hourlyRate;
              });

        </script>

<?php
  include 'footer.php';
?>