<?php
  include 'header.php';

  $errors = array('school_name' => '', 'degree_type' => '');

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
      $school_name = mysqli_real_escape_string($conn, $_POST['school_name']);
      $degree_type = mysqli_real_escape_string($conn, $_POST['degree_type']);
      

      //Form Validation for empty input.
      if(empty($_POST['school_name'])){
        $errors['school_name'] = 'Please enter a valid school name.';
      }
      if(empty($_POST['degree_type'])){
        $errors['degree_type'] = 'Please enter a valid degree.';
      }

      if(!$empty){
        //SQL insert query
        $sql = "INSERT INTO education(school_name, degree_type, id) VALUES('$school_name', '$degree_type', '$foreign_key')";
      
        //Insert value.
        mysqli_query($conn, $sql);
      }
     
      header("Location: projects.php");
  }
?>
    <body>
        
        <h5 class="text-center mt-5 mb-5">Please add the education you have relating to your skillset.</h5>

        <div class="mt-5 ml-5 mr-5 project-container">
         <form id="initialForm" action="education.php" method="POST">
             <div class="form-group">
               <label for="formGroupExampleInput">School Name</label>
               <input type="text" class="form-control" id="school_name" name="school_name" placeholder="School Name">
             </div>
             <div class="form-group">
               <label for="formGroupExampleInput2">Degree Type</label>
               <input type="text" class="form-control" id="degree_type" name="degree_type" placeholder="Degree name">
             </div>
 
             <button type="button" class="btn btn-primary" onclick="addEducation()">Add Education</button>
             <button type="submit" name="submit" class="btn btn-primary">Done</button>
           </form>
        </div>
        
     <!-- In House JS-->
     <script src="js/addEducation.js"></script>
<?php
  include 'footer.php';
?>