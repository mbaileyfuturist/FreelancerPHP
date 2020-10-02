<?php
  include 'header.php';

  $errors = array('company_name' => '', 'address' => '', 'city' => '', 'state' => '', 'zip' => '', 'mission_statement' => '');

  if(isset($_POST['submit'])){
      
      //Database connection.
      include('config/db_connect.php');
      
      //Protection from SQLInjection.
      $company_name = mysqli_real_escape_string($conn, $_POST['company_name']);
      $address = mysqli_real_escape_string($conn, $_POST['address']);
      $city = mysqli_real_escape_string($conn, $_POST['city']);
      $zip = mysqli_real_escape_string($conn, $_POST['zip']);
      $mission_statement = mysqli_real_escape_string($conn, $_POST['mission_statement']);      

      //Form Validation for empty input.
      if(empty($_POST['company_name'])){
        $errors['company_name'] = 'Please enter a valid company name.';
      }
      if(empty($_POST['address'])){
        $errors['address'] = 'Please enter a valid address.';
      }
      if(empty($_POST['city'])){
        $errors['city'] = 'Please enter a valid city.';
      }
      if(empty($_POST['state'])){
        $errors['state'] = 'Please enter a valid state.';
      }
      if(empty($_POST['zip'])){
        $errors['zip'] = 'Please enter a valid zip.';
      }
      if(empty($_POST['mission_statement'])){
        $errors['mission_statement'] = 'Please enter a valid mission statement.';
      }

      if(!$empty){
        //SQL insert query
        $sql = "INSERT INTO company_info(company_name, address, city, state, zip, mission_statement) VALUES('$company_name', '$address', '$city', '$zip', '$mission_statement')";
      
        //Insert value.
        mysqli_query($conn, $sql);

        //Need to add header method to redirect to add jobs.
        
      }     
?>
    <body>

        <div class="profile-pic mt-3">
            <h2 class="mt-5 text-center text-white">profile pic</h2>
        </div>

        <div class="d-flex justify-content-center sign-up-container mt-5">

            <form action="companyInfo.php" method="POST">
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
                        <option>...</option>
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
                    <textarea type="text" class="form-control" id="mission_statement" name="mission_statement" rows="7" style="width:100%;" placeholder="Mission Statement"></textarea>
                    </div>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Done</button>
            </form>

        </div>
<?php
    include 'footer.php';
?>