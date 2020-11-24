<?php

  include 'header.php';

  session_start();

  $user_id = $_SESSION['id'];
  $company_name = $_SESSION['company_name'];

  if(isset($_POST['submit-1'])){
    header("Location: clientProfile.php");
  }

  if(isset($_POST['submit-2'])){
      
    //Database connection.
    include('config/db_connect.php');
    
    //Protection from SQLInjection.
    $company_name = mysqli_real_escape_string($conn, $_POST['company_name']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $zip = mysqli_real_escape_string($conn, $_POST['zip']);
    $mission_statement = mysqli_real_escape_string($conn, $_POST['mission_statement']);      

    //SQL update query
    $sql = "UPDATE company_info SET company_name = '$company_name', address = '$address', city = '$city', state = '$state', zip = '$zip', mission_statement = '$mission_statement' WHERE id = '$user_id'";
    
    //Insert value.
    mysqli_query($conn, $sql);
    
    
    header("Location: clientProfile.php");
  }
?>

    <body>

        <div id="signup-banner" class="bg-primary pt-2 mb-5">
          <p id="signup-logo" class="text-white d-inline ml-3">The Freelancer</p>
        </div>

        <h4 class="text-center mt-3"><?php echo $company_name ?></h4>

        <div class="d-flex justify-content-center sign-up-container mt-5">
        <div class="card" style="width: 33rem;border-style:solid;border-width:2px;border-color:#0275d8;">
            <div class="card-body">
            <h4 class="card-title signup-card-title text-dark"><strong>Edit Profile</strong></h4>
            <form action="editActiveClientProfile.php" method="POST">
                <div class="form-row">
                    <div class="form-group col-md-6">
                    <label>Company Name</label>
                    <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Company Name">
                    </div>
                </div>
                <div class="form-group">
                    <label>Company Address</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Company Address">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                    <label>City</label>
                    <input type="text" class="form-control" id="city" name="city">
                    </div>
                    <div class="form-group col-md-4">
                    <label>State</label>
                    <select id="state" name="state" class="form-control">
                        <option selected>Choose...</option>
                        <option>AZ</option>
                        <option>CA</option>
                        <option>MD</option>
                    </select>
                    </div>
                    <div class="form-group col-md-2">
                    <label>Zip</label>
                    <input type="text" class="form-control" id="zip" name="zip">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                    <label>Mission Statement</label>
                    <textarea type="text" class="form-control" id="mission_statement" name="mission_statement" rows="7" style="width:30rem;" placeholder="Mission Statement"></textarea>
                    </div>
                </div>
                <button type="submit" name="submit-1" class="btn btn-primary">Cancel</button>
                <button type="submit" name="submit-2" class="btn btn-primary">Update</button>
            </form>
            </div>
        </div>
      </div>
      
<?php
  include 'footer.php';
?>