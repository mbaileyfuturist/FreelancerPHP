<?php
  include 'header.php';
?>
    <body>
    
        <div class="profile-pic mt-3">
            <h2 class="mt-5 text-center text-white">Compnay Logo</h2>
          </div>
    
          <h4 class="text-center mt-3">Company name</h4>
          <h4 class="text-center mt-2">Company Address</h4>

          <div class="mt-5 mb-5" style="width:50%;margin-left:25%;">
              <h5 class="text-center Company-description">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Illum reprehenderit culpa veniam iure cum modi hic eligendi accusantium impedit, dolorem vero quam eveniet ex perspiciatis beatae nihil. Repudiandae, aliquid neque!
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores, rem! Enim ex saepe ut facilis aliquid inventore. Ipsa illum, nemo facere cum fugiat nostrum commodi voluptas dignissimos adipisci, sapiente laborum.
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis excepturi ipsa autem mollitia nam a. Consequatur obcaecati perspiciatis illum suscipit ullam impedit velit beatae, quos architecto eligendi accusantium, laborum dolorem.
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio cumque delectus, enim illo suscipit exercitationem unde eos hic eveniet voluptatibus inventore eligendi quod modi reprehenderit omnis officiis qui, expedita aperiam!
              </h5>
          </div>

          <table class="table list-of-projects-company-offers">
            <thead class="thead-dark">
              <tr>
                <th scope="col" class="text-center">Project</th>
                <th scope="col" class="text-center">Skill Required</th>
                <th scope="col" class="text-center">Offer Price</th>
                <th scope="col" class="text-center">View</th>

              </tr>
            </thead>
            <tbody>
            
                <tr>
                  <td class="text-center">Project A</td>
                  <td class="text-center">Java</td>
                  <td class="text-center">$400</td>
                  <td class="text-center"><a href="jobDescription.php"><button class="btn btn-success">Select</button></a></td>
                </tr>
              <tr>
                <td class="text-center">Project B</td>
                <td class="text-center">PHP</td>
                <td class="text-center">$300</td>
                <td class="text-center"><button class="btn btn-success">Select</button></td>

              </tr>
              <tr>
                <td class="text-center">Project C</td>
                <td class="text-center">C++</td>
                <td class="text-center">$25/hr</td>
                <td class="text-center"><button class="btn btn-success">Select</button></td>

              </tr>
              <tr>
                <td class="text-center">Project D</td>
                <td class="text-center">AngularJS</td>
                <td class="text-center">$75,000/yr</td>
                <td class="text-center"><button class="btn btn-success">Select</button></td>

              </tr>
            </tbody>
          </table>

          <div class="mt-5 mb-5 d-flex justify-content-center">
            <button class="btn btn-primary mr-3" type="submit">Contact</button>
            <a href="jobDescription.php"><button class="btn btn-primary" type="submit">Done</button></a>
          </div>
<?php
  include 'footer.php';
?>