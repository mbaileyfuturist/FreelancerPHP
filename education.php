<?php
  include 'header.php';
?>
    <body>
        
        <h5 class="text-center mt-5 mb-5">Please add the education you have relating to your skillset.</h5>

        <div class="mt-5 ml-5 mr-5 project-container">
         <form id="initialForm">
             <div class="form-group">
               <label for="formGroupExampleInput">School Name</label>
               <input type="text" class="form-control" id="schoolNameInput" placeholder="School Name">
             </div>
             <div class="form-group">
               <label for="formGroupExampleInput2">Degree Type</label>
               <input type="text" class="form-control" id="degreeInput" placeholder="Degree name">
             </div>
 
             <button type="button" class="btn btn-primary" onclick="addEducation()">Add Education</button>
             <button type="submit" class="btn btn-primary"><a href="profileDescription.php">Done</a></button>
           </form>
        </div>
        
     <!-- In House JS-->
     <script src="js/addEducation.js"></script>
<?php
  include 'footer.php';
?>