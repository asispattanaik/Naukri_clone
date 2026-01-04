<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Mynaukri</title>
   <!-- head  start -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">  
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<!-- head end -->
    <script
    src="https://kit.fontawesome.com/24c494a6b6.js"
    crossorigin="anonymous"
  ></script>
  <link rel="icon" href="https://static.naukimg.com/s/7/103/i/naukriIcon.74e6a29a.png" type="">
   <link rel="stylesheet" href="index.css">
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">
   <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@700&display=swap" rel="stylesheet">

</head>
<body>
    <!--start -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
     crossorigin="anonymous">
   </script> 

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
      <h5 id="offcanvasRightLabel">Login</h5>
      <p><a  target ="_blank" href="register.php">Register for free</a></p>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">


      <form method="POST" action="auth.php">

  <div class="mb-3">
    <label class="form-label">Email ID</label>
    <input type="email" name="email" class="form-control" required>
  </div>

  <div class="mb-3">
    <label class="form-label">Password</label>
    <input type="password" name="password" class="form-control" required>
    <div class="form-text text-end">Forgot Password?</div>
  </div>

  <button type="submit" class="btn btn-primary w-100" id="login">
    Login
  </button>

</form>

  
          <!-- <div class="mb-3 form-check">
            <button id="passwardCheck">Forget Passward?</button>
          </div> -->
  
          <!--div onclick="mylogin()" type="submit" class="btn btn-primary" id="login">
            <a  target ="_blank" href="candidate_dashboard.php" style="color: rgb(255, 255, 255);">Login</a>
          </div>-->
        </form>
  
       
        <p id="or">or</p>
          <div id="GoogleSignIn">
            <i class="fa-brands fa-google" id="icon"></i>
            <a target="_blank"  href="https://account.google.com/" >Sign in with Google</a>
          </div>
    </div>
  </div>
<!--body ends -->



<!-- home page -->
    <div id="navBar">
        <div id="logo">
<img src="https://static.naukimg.com/s/4/100/i/naukri_Logo.png" alt="">
        </div>
        <div id="navItem">




            
<div class="dropdown">
    <button class="dropbtn">Jobs</button>
    <div class="dropdown-content">
      <a href="jobs.php">Search Jobs</a>
      <a href="#">Create Free job alert</a>
      <a href="#">Jobs By location </a>
      <a href="#">Jobs By skill </a>
      <a href="#">Jobs By Designation  </a>
      <a href="#">Jobs By Company </a>
      <a href="#">Browse all Jobs</a>
    </div>
  </div>  
   <div class="dropdown">
    <button class="dropbtn">Recruiters</button>
    <div class="dropdown-content">
      <a href="#">Browse all recruiters</a>
      <a href="#">recruiter  connections </a>
      <a href="#">Go to Naukrirecruiters</a>
    </div>
  </div>
  <div class="dropdown">
    <button class="dropbtn">Companies</button>
    <div class="dropdown-content">
      <a href="#">Browse all companies</a>
      <a href="#">About companies</a>
      <a href="#">Interview Questions</a>
      <a href="#">Write company Review</a>
      <a href="#">Company Review</a> 
    </div>
  </div>
  <div class="dropdown">
    <button class="dropbtn">Services</button>
    <div class="dropdown-content">
      <a href="#"> Resume writing</a>
      <a href="#">Jobs For you</a>
      <a href="#">Recruiters reach</a>
      <a href="#">Courses</a> 
      <a href="#">Other</a> 
    </div>
  </div>
  <div class="dropdown">
    <button class="dropbtn">Tools</button>
    <div class="dropdown-content">
      <a href="#">Career Dashboard</a>
      <a href="#">Your next carrer move</a>
      <a href="#">Skill Trends</a>
      <a href="#">Naukri Lab</a> 
    </div>
  </div>
<span class="dropdown">
  <button class="dropbtn">Recruiter Dashboard</button>
  <span class="dropdown-content">
    <a href="recruiter_register.php">Register</a>
    <a href="recruiter_login.php">Login</a>
  </span>
</span>



  </div>
        <div id="navButton">
            <div><button id="btn-light" class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Login</button></div>
            <div ><button class="btn-orange"> <a href="register.php">Register</a></button> </div>

        </div>
    </div>
    <div id="head1">
    <div><h1>Find your dream job now</h1></div>
    <div><p>5+ lakh jobs for you to explore</p></div>
   </div>  
   <div id="searchBar">
<div><i class="fa-solid fa-magnifying-glass"></i></div>
<div><input id="serchIn" type="text" class="no-outline" placeholder="Enter skills / designation / companies"></div>
<div><input type="text" class="no-outline" placeholder="Enter location"></div>
<div><select id="experience" class="no-outline">
    <option value="">Select experience</option>
    <option value="fresher">Fresher(less than 1)</option>
    <option value="1 year">1 year</option>
    <option value="2 years">2 years</option>
    <option value="3 years">3 years</option>
    <option value="4 years">4 years</option>
    <option value="5 years">5 years</option>
    <option value="6 years">6 years</option>
    <option value="7 years">7 years</option>
  </select></div>
  <div><a href="jobs.php"><button id="searchbtn"> Search </button></a></div>
   </div>
  <div id="container1">
      <div id="comtainerImg">
          <img src="https://static.naukimg.com/s/0/0/i/homepage-register/airtel-logo.png" alt="">
          <img src="https://static.naukimg.com/s/0/0/i/homepage-register/amazon-large-logo.png" alt="">
          <img src="https://static.naukimg.com/s/0/0/i/homepage-register/flipkart-logo.png" alt="">
          <img src="https://static.naukimg.com/s/0/0/i/homepage-register/myntra-large-logo.png" alt="">
          <img src="https://static.naukimg.com/s/0/0/i/homepage-register/paytm-logo.png" alt="">
          <img src="https://static.naukimg.com/s/0/0/i/homepage-register/swiggy-logo.png" alt="">
      </div>
      <div id="containerDisplay">
          <h3>Increase your chance of hiring by almost 60%</h>
            <h5>
                More than 25000 are hiring by directly searcching for candidate on Naukri!  
                <span><i class="fa-solid fa-angle-right"></i></span>
            </h5>

      </div>
      <div id="containerBtn"><a href="register.php"><button class="btn-orange"> Register Now </button></a></div>
         
      
  </div>
<div >
    <h2 class="heading">Trending on Naukri today</h2>
</div>
<div id="trending"> 
   <!-- data from javascript -->
</div>
<div >
    <h2 class="heading">Featured companies actively hiring</h2>
</div>
<div id="feature">
 <!-- data from javascript -->
 <div>
     <img src="https://img.naukimg.com/logo_images/groups/v2/194354.gif" alt="">
     <div>
         <h4>HCL Technologies</h4>
         <span>3.8 | 16.4K reviews</span>
     </div>
     <p>Globally acclaimed tech company since 1991.</p>
     <button>View jobs</button>
 </div>
 
</div>
<div id="divBtn">
    <button class="btn-light">View all companies</button>
</div>

<div id="roles">
    <div id="roleInfo">
        <img src="https://static.naukimg.com/s/0/0/i/role-collection.png" alt="">
        <h2>Discover jobs across popular role</h2>
        <p>Select a role and we'll show you relevent jobs for it!</p>
    </div>
    <div id="roleType">
        <div>
            <h4>Full Stack Developer</h4>  
            <p>92.9K+ jobs <span><i class="fa-solid fa-angle-right"></i></span></p>
          </div>
          <div>
            <h4>Data Analyst</h4>  
            <p>92.9K+ jobs <span><i class="fa-solid fa-angle-right"></i></span></p>
          </div>
          <div>
            <h4>Associate Software Engineer</h4>  
            <p>92.9K+ jobs <span><i class="fa-solid fa-angle-right"></i></span></p>
          </div>
          <div>
            <h4>Business Analyst</h4>  
            <p>92.9K+ jobs <span><i class="fa-solid fa-angle-right"></i></span></p>
          </div>
          <div>
            <h4>MIS Executive</h4>  
            <p>92.9K+ jobs <span><i class="fa-solid fa-angle-right"></i></span></p>
          </div>
          <div>
            <h4>Business Development Executive</h4>  
            <p>92.9K+ jobs <span><i class="fa-solid fa-angle-right"></i></span></p>
          </div>    
    </div>
</div>


<div>
<h2 class="heading">Explore top companies hiring now</h2>
</div>
<div id="expComp">
    <div>
        <div><h4>Product</h4>
            <p>188 companies</p></div>
            <div class="arrow">
                <span><i class="fa-solid fa-angle-right"></i></span>
            </div>
    </div>
    <div>
        <div><h4>Internet</h4>
            <p>57 companies</p></div>
            <div class="arrow">
                <span><i class="fa-solid fa-angle-right"></i></span>
            </div>
    </div>
    <div>
        <div><h4>Fintech</h4>
            <p>16 companies</p></div>
            <div class="arrow">
                <span><i class="fa-solid fa-angle-right"></i></span>
            </div>
    </div>
    <div>
        <div><h4>Edtech</h4>
            <p>41 companies</p></div>
            <div class="arrow">
                <span><i class="fa-solid fa-angle-right"></i></span>
            </div>
    </div>

</div>

<div id="vidProfile">
    <div>
        <div >
            <h2>Stand out among recruits with video profile </h2>
        </div>
        <div id="vidBox">
          <div >
            <p>Available for both Android and iOS apps</p>
           <div id="vidInput"><input id="inputNum1" type="text" class="no-outline" placeholder="Enter mobile Number...">
            <button id="vidBtn">Get link</button>
        </div> 
           
          </div>
        </div>
        <div id="vidBaseImg">
        <div><img src="#" alt=""></div>
        <div><img src="#" alt=""></div>
    </div>
    </div>
    <div >
        <img src="https://static.naukimg.com/s/0/0/i/download-app-link/MaskGroup_v4.png" alt="">
    </div>
</div>
<div class="applyFooter">
               
    <div>
        <h6>Information</h6>
        <p>About Us</p>
        <p>Terms & Conditions</p>
        <p>Privacy Policy</p>
        <p>Careers with Us</p>
        <p>Sitemap</p>
        <p>Contact Us</p>
        <p>FAQs</p>
        <p>Summons / Notices</p>
        <p>Grievances</p>
        <p>Fraud Alert</p>
        <p>Trust and Safety</p> <br>
        <h6>Naukri on Mobile</h6>
        <img src="https://iconape.com/wp-content/files/dw/351333/svg/351333.svg" alt="">
    </div>
    <div>
        <h6>Jobseekers</h6>
        <p>Register Now</p>
        <p>Search Jobs</p>
        <p>Login</p>
        <p>Create Job Alert</p>
        <p>Report a Problem</p>
        <p>Naukri Blogs</p>
        <p>Mobile Site</p> <br>
        <h6>Browse Jobs</h6>
        <p>Browse All Jobs</p>
        <p>Premium MBA Jobs</p>
        <p>Premium Engineering <br> Jobs</p>
        <p>Govt. Jobs</p>
        <p>International Jobs</p>
        <p>Jobs in Gulf</p>
        <p>Jobs by Company</p>
        <p>Jobs by Category</p>
        <p>Jobs by Designation</p>
        <p>Jobs by Location</p>
        <p>Jobs by Skill</p>
    </div>
    <div>
        <h6>Jobseeker Services</h6>
        <p>Priority Applicant                        </p>
        <p>Resume Display</p>
        <p>Resume Writing</p>
        <p>Jobs4U</p>
        <p>Recruiter Connection</p>
        <p>Job Search Booster</p> <br>
        <h6>Naukri Learning</h6>
        <p>Software and Technology</p>
        <p>Artificial Intelligence and <br> Data Science</p>
        <p>Management</p>
        <p>Finance</p>
        <p>Creativity and Design</p>
        <p>Emerging Technologies</p>
        <p>Engineering-non CS</p>
        <p>Healthcare</p>
        <p>Energy and Environment</p>
        <p>Social sciences</p>
        <p>Personal growth</p>
    </div>
    <div>
        <h6>Employers</h6>
        <p>Job Posting</p>
        <p>Resume Database Access</p>
        <p>Recruiter Login</p>
        <p>Naukri RMS</p>
        <p>Buy Resume Packages Online</p>
        <p>Transition Services</p>
        <p>Report a Problem</p>
        <p>Recruiters from USA, call</p>
        <p>Toll Free # 1866-557-3340</p> <br>
        <h6>Ambition Box</h6>
        <p>Interview Questions</p>
        <p>About Companies</p>
        <p>Share Interview Advice</p>
        <p>Write Company Review</p>
        <p>Company Reviews</p>
        <p>Company Salaries</p>
        <br>
        <p>Follow Us</p>
        <a href="https://www.facebook.com/login/"><i class="fb socialLogo fa-brands fa-facebook-square"></i></a>
        <a href="https://twitter.com/login/"><i class="twitter socialLogo fa-brands fa-twitter-square"></i></a>
          <a href="https://www.linkedin.com/login/"><i class="linkedin socialLogo fa-brands fa-linkedin"></i></a> 
      
    </div>

</div>
<p class="copyrightPart">All rights reserved @AsisPattanaik 2025</p>

<hr>
</body>
</html>
<script src="index.js"></script>
