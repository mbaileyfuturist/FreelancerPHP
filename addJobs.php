<?php
include('header.php');
$array = array();
$job_names = array();
$job_descriptions = array();

  if(isset($_POST['submit-1'])){
    header('Location: companyInfo.php');
  } 

  if(isset($_POST['submit-2'])){

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

    //SQL insert query
    $sql = "INSERT INTO jobs(job_name, job_description, id) VALUES('$job_name', '$job_description', '$foreign_key')";
  
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
    }

  }

  if(isset($_POST['submit-3'])){
    header('Location: ClientHomePage.php');
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
        </div>

            <button type="submit" name="submit-1" class="btn btn-primary">Back</button>
            <button type="submit" name="submit-2" class="btn btn-primary">Add Job</button>
            <button type="submit" name="submit-3" class="btn btn-primary">Finish</button>
        </form>
        </div>   

        <div>
        <table class="table mt-5">
            <thead class="thead-dark">
              <tr>
                <th scope="col" class="text-center">#</th>
                <th scope="col" class="text-center">Job</th>
                <th scope="col" class="text-center">Description</th>
              </tr>
            </thead>
            <tbody>

            <?php for($index = 0;$index < count($array);$index++) { ?>
              <tr>
                <th scope="row" class="text-center"><?php $index ?></th>
                <td class="text-center"><?php echo $job_names[$index]?></td>
                <td class="text-center"><?php echo $job_descriptions[$index]?></td>
              </tr>
            <?php } ?>

            </tbody>
          </table>
        </div>

    <script src="js/addJob.js"></script>
<?php
    include 'footer.php'
?>