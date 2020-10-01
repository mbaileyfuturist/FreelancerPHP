<?php
  include 'header.php';

  $errors = array('project_name' => '', 'project_description' => '');

  if(isset($_POST['submit'])){
      
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

      /************************************************************************************************ */
      
      //Protection from SQLInjection.
      $project_name = mysqli_real_escape_string($conn, $_POST['project_name']);
      $project_description = mysqli_real_escape_string($conn, $_POST['project_description']);
      

      //Form Validation for empty input.
      if(empty($_POST['project_name'])){
        $errors['project_name'] = 'Please enter a valid project name.';
      }
      if(empty($_POST['project_description'])){
        $errors['project_description'] = 'Please enter a valid project description.';
      }

      if(!$empty){
        //SQL insert query
        $sql = "INSERT INTO projects(project_name, project_description, id) VALUES('$project_name', '$project_description', '$foreign_key')";
      
        //Insert value.
        mysqli_query($conn, $sql);
      }
     
      header("Location: profileDescription.php");
  }
?>
    <body>
        <h5 class="text-center mt-5 mb-5">Please add the name and description of the best projects you have worked on in the past.</h5>

       <div class="mt-5 ml-5 mr-5 project-container">
        <form id="initialForm" action="projects.php" method="POST">

          <div id="initial-input">
            <div class="form-group">
                <label for="formGroupExampleInput">Project Name</label>
                <input type="text" class="form-control" name="project_name" id="project_name" placeholder="Project Name">
              </div>
              <div class="form-group">
                <label for="formGroupExampleInput2">Project Description</label>
                <textarea type="text" class="form-control" name="project_description" id="project_description" placeholder="Project description..." rows="7"></textarea>
              </div>
          </div>

            <button type="button" class="btn btn-primary" onclick="addProjects()">Add Project</button>
            <button type="submit" name="submit" class="btn btn-primary">Done</button>
          </form>
       </div>
        
     <!-- In House JS-->
     <script src="js/addProjects.js"></script>
<?php
  include 'footer.php';
?>