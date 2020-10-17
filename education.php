<?php

include('header.php');
$array = array();
$school_names = array();
$degree_types = array();

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
  $school_name = mysqli_real_escape_string($conn, $_POST['school_name']);
  $degree_type = mysqli_real_escape_string($conn, $_POST['degree_type']);

    //SQL insert query
    $sql = "INSERT INTO education(school_name, degree_type, id) VALUES('$school_name', '$degree_type', '$foreign_key')";
  
    //Insert values into table.
    mysqli_query($conn, $sql);

    //Retreive project name and description based on foreign key.
    $selectQuery = "SELECT * FROM education WHERE id = $foreign_key";

    //Make Query and get result.
    $result = mysqli_query($conn, $selectQuery);

    while($row = mysqli_fetch_assoc($result)) {
        $array[] = $row;
    }

    for($index = 0; $index < count($array); $index++){
      $school_names[] = json_encode($array[$index]['school_name']);
      $degree_types[] = json_encode($array[$index]['degree_type']);
    }

  }

  if(isset($_POST['submit-2'])){
    header('Location: projects.php');
  }
?>
    <body>
        
        <h5 class="text-center mt-5 mb-5">Please add the education you have relating to your skillset.</h5>

        <div class="mt-5 ml-5 mr-5 project-container">
         <form id="initialForm" action="education.php" method="POST">
         
         <div id="initial-input">
            <div class="form-group">
                  <label for="formGroupExampleInput">School Name</label>
                  <input type="text" class="form-control" id="school_name" name="school_name" placeholder="School Name">
                </div>
                <div class="form-group">
                  <label for="formGroupExampleInput2">Degree Type</label>
                  <input type="text" class="form-control" id="degree_type" name="degree_type" placeholder="Degree name">
                </div>
         </div> 
             <button type="submit" name="submit-1" class="btn btn-primary">Add Education</button>
             <button type="submit" name="submit-2" class="btn btn-primary">Next</button>
           </form>
        </div>

        <div>
        <table class="table mt-5">
            <thead class="thead-dark">
              <tr>
                <th scope="col" class="text-center">#</th>
                <th scope="col" class="text-center">School</th>
                <th scope="col" class="text-center">Degree</th>
              </tr>
            </thead>
            <tbody>

            <?php for($index = 0;$index < count($array);$index++) { ?>
              <tr>
                <th scope="row" class="text-center"><?php $index ?></th>
                <td class="text-center"><?php echo $school_names[$index]?></td>
                <td class="text-center"><?php echo $degree_types[$index]?></td>
              </tr>
            <?php } ?>

            </tbody>
          </table>
        </div>
        
     <!-- In House JS-->
     <script src="js/addEducation.js"></script>
<?php
  include 'footer.php';
?>