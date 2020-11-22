<?php
  include 'header.php';

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
    
    //Protection from SQLInjection.
    $company_name = mysqli_real_escape_string($conn, $_POST['company_name']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $zip = mysqli_real_escape_string($conn, $_POST['zip']);
    $mission_statement = mysqli_real_escape_string($conn, $_POST['mission_statement']);      

    //SQL insert query
    $sql = "INSERT INTO company_info(company_name, address, city, state, zip, mission_statement, id) VALUES('$company_name', '$address', '$city', '$state', '$zip', '$mission_statement', '$foreign_key')";
    
    //Insert value.
    mysqli_query($conn, $sql);
    
    //Need to add header method to redirect to add jobs.
    header("Location: addJobs.php");
  }
?>

    <body>

      <div id="signup-banner" class="bg-primary pt-2 mb-5">
        <p id="signup-logo" class="text-white d-inline ml-3">The Freelancer</p>
        <h5 class="text-white d-inline banner-text-profile-description">Almost done, just add a little bit more information about your company.</h5>
      </div>

      <h4 class="text-center mt-5">Full Name</h4>
      <h4 class="text-center mt-3">Skill Type</h4>

        <div class="d-flex justify-content-center mt-5">
        <div class="card" style="width: 33rem;border-style:solid;border-width:2px;border-color:#0275d8;">
          <div class="card-body">
          <h4 class="card-title signup-card-title text-dark"><strong>Company Information</strong></h4>
          <form action="companyInfo.php" method="POST">
                <div class="form-row">
                    <div class="form-group col-md-6">
                    <label class="text-dark"><strong>Company Name</strong></label>
                    <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Company Name">
                    </div>
                </div>
                <div class="form-group">
                    <label class="text-dark"><strong>Company Address</strong></label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Company Address">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                    <label class="text-dark"><strong>City</strong></label>
                    <input type="text" class="form-control" id="city" name="city">
                    </div>
                    <div class="form-group col-md-4">
                    <label class="text-dark"><strong>State</strong></label>
                    <select id="state" name="state" class="form-control">
                        <option selected>Choose...</option>
                        <option>AZ</option>
                        <option>CA</option>
                        <option>MD</option>
                    </select>
                    </div>
                    <div class="form-group col-md-2">
                    <label class="text-dark"><strong>Zip</strong></label>
                    <input type="text" class="form-control" id="zip" name="zip">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                    <label class="text-dark"><strong>Mission Statement</strong></label>
                    <textarea type="text" class="form-control" id="mission_statement" name="mission_statement" rows="7" style="width:30rem;" placeholder="Mission Statement"></textarea>
                    </div>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Done</button>
            </form>   
          </div>
        </div>
      </div>
      
<?php
  include 'footer.php';
?>