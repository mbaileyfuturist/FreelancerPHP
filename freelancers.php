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
              <a class="nav-link" href="#">Log Out</a>
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
                <th scope="col" class="text-center">Full Name</th>
                <th scope="col" class="text-center">Bio</th>
                <th scope="col" class="text-center">Skill</th>
                <th scope="col" class="text-center">Hourly Rate</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center">First Last</td>
                <td class="text-center" style="width:30%">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Id soluta repellendus laboriosam facilis hic expedita corrupti tempora placeat perspiciatis! Dolorum consequatur, nulla minima aliquam tempore error hic! Nesciunt, officia at!</td>
                <td class="text-center">Java</td>
                <td class="text-center">$18</td>
              </tr>
              <tr>
                <td class="text-center">First Last</td>
                <td class="text-center">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Laudantium pariatur minus ipsam, harum sint doloribus recusandae, error molestiae voluptates reprehenderit eum, ex iure? Reiciendis repellendus beatae eveniet delectus quia explicabo!</td>
                <td class="text-center">PHP</td>
                <td class="text-center">$22</td>
              </tr>
              <tr>
                <td class="text-center">First Last</td>
                <td class="text-center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias enim distinctio repellendus eligendi nisi officia dicta sapiente obcaecati corporis ut eveniet assumenda numquam mollitia, fuga ratione consequuntur id quia eius?</td>
                <td class="text-center">C++</td>
                <td class="text-center">$25</td>
              </tr>
              <tr>
                <td class="text-center">First Last</td>
                <td class="text-center">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugiat delectus laudantium ipsa dignissimos impedit enim at non veritatis ex libero deserunt incidunt, quasi repellat rerum nisi architecto id quis. Animi.</td>
                <td class="text-center">AngularJS</td>
                <td class="text-center">$30</td>
              </tr>
            </tbody>
          </table>
<?php
  include 'footer.php';
?>