<?php
include 'header.php';
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

            <button type="button" class="btn btn-primary" onclick="addJobs()">Add Job</button>
            <button type="submit" name="submit" class="btn btn-primary">Done</button>
        </form>
        </div>   
    </body>

    <script src="js/addJob.js"></script>
<?php
    include 'footer.php'
?>