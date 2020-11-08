<?php
  include('header.php');
  $array = array();
  $job_names = array();
  $job_descriptions = array();

  if(isset($_POST['submit-1'])){

    //Database connection.
    include('config/db_connect.php');

    //Retrive the last id from the users table to use as foriegn key later.
    $idquery = "SELECT * FROM users ORDER BY id DESC LIMIT 1";

    //Make Query and get result.
    $result = mysqli_query($conn, $idquery);

    //Fetch query as associative array.
    $lastrow = mysqli_fetch_assoc($result);

    //Store foreign key into variable to insert into our table later.
    $foreign_key = $lastrow['id'];

    /*************************************************************************************************/
    
    //Grab POST values from form.
    $job_name = mysqli_real_escape_string($conn, $_POST['job_name']);
    $job_description = mysqli_real_escape_string($conn, $_POST['job_description']);
    $job_hourly_rate = mysqli_real_escape_string($conn, $_POST['hourly_rate']);

    //SQL insert query
    $sql = "INSERT INTO jobs(job_name, job_description, job_hourly_rate, id) VALUES('$job_name', '$job_description', '$job_hourly_rate', '$foreign_key')";
  
    //Insert values into table.
    mysqli_query($conn, $sql);

    //Retreive project name and description based on foreign key.
    $selectQuery = "SELECT * FROM jobs WHERE id = $foreign_key";

    //Make Query and get result.
    $result = mysqli_query($conn, $selectQuery);

    while($row = mysqli_fetch_assoc($result)) {
        $array[] = $row;
    }

    for($index = 0; $index < count($array); $index++){
      $job_names[] = json_encode($array[$index]['job_name']);
      $job_descriptions[] = json_encode($array[$index]['job_description']);
      $job_hourly_rates[] = json_encode($array[$index]['job_hourly_rate']);

      $_job_names[] = trim($job_names[$index] , '"');
      $_job_descriptions[] = trim($job_descriptions[$index], '"');
      $_job_hourly_rates[] = trim($job_hourly_rates[$index], '"');
    }

  }

  if(isset($_POST['submit-2'])){
    header('Location: clientProfile.php');
  }
?>

    <body>
    <h5 class="text-center mt-5 mb-5">Please add the name and description of the jobs you are currently hiring for.</h5>

        <div class="mt-5 ml-5 mr-5 project-container">
        <form id="initialForm" action="addJobs.php" method="POST">

        <div id="initial-input">
            <div class="form-group">
                <label>Job Name</label>
                <input type="text" class="form-control" name="job_name" id="job_name" placeholder="job name">
            </div>
            <div class="form-group">
                <label>Job Description</label>
                <textarea type="text" class="form-control" name="job_description" id="job_description" placeholder="job description..." rows="7"></textarea>
            </div>
            <div class="form-group">
                <label>Hourly Rate</label>
                <input type="text" class="form-control" name="hourly_rate" id="hourly_rate" placeholder="hourly rate"></input>
            </div>
        </div>

            <button type="submit" name="submit-1" class="btn btn-primary">Add Job</button>
            <button type="submit" name="submit-2" class="btn btn-primary">Finish</button>
        </form>
        </div>   

        <div>
        <table class="table mt-5">
            <thead class="thead-dark">
              <tr>
                <th scope="col" class="text-center">#</th>
                <th scope="col" class="text-center">Job</th>
                <th scope="col" class="text-center">Description</th>
                <th scope="col" class="text-center">Job Hourly Rate</th>
              </tr>
            </thead>
            <tbody>

            <?php for($index = 0;$index < count($array);$index++) { ?>
              <tr>
                <th scope="row" class="text-center"><?php $index ?></th>
                <td class="text-center"><?php echo $_job_names[$index]?></td>
                <td class="text-center"><?php echo $_job_descriptions[$index]?></td>
                <td class="text-center"><?php echo $_job_hourly_rates[$index]?></td>
              </tr>
            <?php } ?>

            </tbody>
          </table>
        </div>

    <script src="js/addJob.js"></script>
<?php
    include 'footer.php'
?>