<?php
    include 'header.php'
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>
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
                    <textarea type="text" class="form-control" id="mission_statement" name="mission_statement" rows="7" style="width:100%;" placeholder="Mission Statement"></textarea>
                    </div>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Done</button>
            </form>   

      </div>
      
    </body>
</html>
<?php
    include 'footer.php'
?>