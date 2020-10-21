<?php
  include 'header.php';
?>
    <body>
        
      <nav class="navbar navbar-expand-lg navbar-light bg-secondary">
        <a class="navbar-brand" href="#">Username</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Profile <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="logout.php">Log Out</a>
            </li>
          </ul>
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
          </form>
        </div>
      </nav>

        <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col" class="text-center">Company</th>
                <th scope="col" class="text-center">Project</th>
                <th scope="col" class="text-center">Skill</th>
                <th scope="col" class="text-center">Offer Price</th>
                <th scope="col" class="text-center">View</th>

              </tr>
            </thead>
            <tbody>
            
                <tr>
                  <td class="text-center">Company A</td>
                  <td class="text-center">Project A</td>
                  <td class="text-center">Java</td>
                  <td class="text-center">$400</td>
                  <td class="text-center"><a href="jobDescription.php"><button class="btn btn-success">Select</button></a></td>
                </tr>
              <tr>
                <td class="text-center">Company B</td>
                <td class="text-center">Project B</td>
                <td class="text-center">PHP</td>
                <td class="text-center">$300</td>
                <td class="text-center"><button class="btn btn-success">Select</button></td>

              </tr>
              <tr>
                <td class="text-center">Company C</td>
                <td class="text-center">Project C</td>
                <td class="text-center">C++</td>
                <td class="text-center">$25/hr</td>
                <td class="text-center"><button class="btn btn-success">Select</button></td>

              </tr>
              <tr>
                <td class="text-center">Company A</td>
                <td class="text-center">Project A</td>
                <td class="text-center">AngularJS</td>
                <td class="text-center">$75,000/yr</td>
                <td class="text-center"><button class="btn btn-success">Select</button></td>

              </tr>
            </tbody>
          </table>
<?php
  include 'footer.php';
?>