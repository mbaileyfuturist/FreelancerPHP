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
    //Select all users where work_hire = Work AND skill = skill of the client.
    $freelancers_bio_query = "SELECT hourly_pay, bio FROM profile_info";
      
    
    $freelancers_bio_results = mysqli_query($conn, $freelancers_bio_query);

    while($row = mysqli_fetch_assoc($freelancers_bio_results)) {
      $freelancers_bio_array[] = $row;
    }

    $freelancers_bio = array();
    $freelancers_hourly_pay = array();
    for($index = 0; $index < count($freelancers_bio_array); $index++){
      $freelancers_bio[] = json_encode($freelancers_bio_array[$index]['bio']);
      $freelancers_hourly_pay[] = json_encode($freelancers_bio_array[$index]['hourly_pay']);

      $_freelancers_bio[] = trim($freelancers_bio[$index], '"');
      $_freelancers_hourly_pay[] = trim($freelancers_hourly_pay[$index], '"');
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
              <a class="nav-link" href="#">Profile <span class="sr-only">(current)</span></a>
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
                <th scope="col" class="text-center">Skill</th>
                <th scope="col" class="text-center">Hourly Rate</th>
              </tr>
            </thead>
            <tbody>

            <?php for($index = 0; $index < count($array); $index++) {?>
              <tr>
                <td class="text-center"><?php echo $_freelancer_first_name[$index] . " " . $_freelancer_last_name[$index];?></td>
                <td class="text-center" style="width:30%"><?php echo $_freelancers_bio[$index]; ?></td>
                <td class="text-center"><?php echo $_freelancer_skill[$index]; ?></td>
                <td class="text-center"><?php echo "$" . $_freelancers_hourly_pay[$index]; ?></td>
              </tr>
            <?php } ?>
              
            </tbody>
          </table>
<?php
  include 'footer.php';
?>