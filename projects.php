<?php
      include('header.php');
      $array = array();
      $project_names = array();
      $project_descriptions = array();

        if(isset($_POST['submit-1'])){
          header('Location: education.php');
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
        $project_name = mysqli_real_escape_string($conn, $_POST['project_name']);
        $project_description = mysqli_real_escape_string($conn, $_POST['project_description']);

          //SQL insert query
          $sql = "INSERT INTO projects(project_name, project_description, id) VALUES('$project_name', '$project_description', '$foreign_key')";
        
          //Insert values into table.
          mysqli_query($conn, $sql);

          //Retreive project name and description based on foreign key.
          $selectQuery = "SELECT * FROM projects WHERE id = $foreign_key";

          //Make Query and get result.
          $result = mysqli_query($conn, $selectQuery);

          while($row = mysqli_fetch_assoc($result)) {
              $array[] = $row;
          }

          for($index = 0; $index < count($array); $index++){
            $project_names[] = json_encode($array[$index]['project_name']);
            $project_descriptions[] = json_encode($array[$index]['project_description']);
          }

        }

        if(isset($_POST['submit-3'])){
          header('Location: profileDescription.php');
        }
?>

<body>

      <h5 class="text-center mt-5">Please enter the name and description of the best projects you've worked on.</h5>
      <div class="mt-5 ml-5 mr-5 project-container">
            <form id="initialForm" action="projects.php" method="POST">
              <div id="initial-input">
              <div class="form-group">
                  <label for="formGroupExampleInput">Project Name</label>
                  <input type="text" class="form-control project_name" name="project_name" id="project_name" placeholder="Project Name">
                  </div>
                  <div class="form-group">
                      <label for="formGroupExampleInput2">Project Description</label>
                      <textarea type="text" class="form-control project_description" name="project_description" id="project_description" placeholder="Project description..." rows="7"></textarea>
                  </div>
              </div>
                  <button type="submit" name="submit-1" class="btn btn-primary">back</button>
                  <button type="submit" name="submit-2" class="btn btn-primary">add project</button>
                  <button type="submit" name="submit-3" class="btn btn-primary">next</button>
            </form>
        </div>

        <div>
        <table class="table mt-5">
            <thead class="thead-dark">
              <tr>
                <th scope="col" class="text-center">#</th>
                <th scope="col" class="text-center">Project</th>
                <th scope="col" class="text-center">Description</th>
              </tr>
            </thead>
            <tbody>

            <?php for($index = 0;$index < count($array);$index++) { ?>
              <tr>
                <th scope="row" class="text-center"><?php $index ?></th>
                <td class="text-center"><?php echo $project_names[$index]?></td>
                <td class="text-center"><?php echo $project_descriptions[$index]?></td>
              </tr>
            <?php } ?>

            </tbody>
          </table>
        </div>
      
     <!-- In House JS-->
     <script src="js/addProjects.js"></script>

<?php
  include 'footer.php';
?>