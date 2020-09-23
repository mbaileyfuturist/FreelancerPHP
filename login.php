<?php
  include 'header.php';
?>
    <body>
        
        <div class="d-flex justify-content-center login-container">
            <form>
                <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">Stay signed in</label>
                </div>
                <small id="emailHelp" class="form-text text-muted">Dont have an account? <a href="signup.php" class="text-info">sign up here.</a></small>
                <button type="submit" class="btn btn-primary mt-3">Submit</button>
              </form>
        </div>
<?php
  include 'footer.php';
?>