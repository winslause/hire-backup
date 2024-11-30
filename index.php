<?php
// session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database configuration
//include 'config.php';
include('login.php');
// include("resetpassword.php");

if (isset($_POST['register'])) {
  // Get form inputs
  $name = $_POST['name'];
  $email = $_POST['emailid'];
  $phone = $_POST['phone'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];

  // Check if password matches confirm password
  if ($password != $confirm_password) {
    $error = "Passwords do not match!";
  } else {
    // Check if the email already exists in the database
    $sql = "SELECT email1 FROM users WHERE email1 = :email";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    // If the email exists, alert the user and redirect
    if ($result) {
      echo "<script>
                    alert('User already exists! Please log in or update your password.');
                    window.location.href = 'index.php';
                  </script>";
    } else {
      // Hash the password for security
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);

      // SQL query to insert the new user into the users table
      $sql = "INSERT INTO users(fname, email1, phone1, password1) 
                    VALUES(:name, :email, :phone, :hashed_password)";

      // Prepare the query
      $query = $dbh->prepare($sql);

      // Bind the parameters
      $query->bindParam(':name', $name, PDO::PARAM_STR);
      $query->bindParam(':email', $email, PDO::PARAM_STR);
      $query->bindParam(':phone', $phone, PDO::PARAM_STR);
      $query->bindParam(':hashed_password', $hashed_password, PDO::PARAM_STR);

      // Execute the query
      $query->execute();

      // Check if the user was added successfully
      $lastInsertId = $dbh->lastInsertId();
      if ($lastInsertId) {
        // Success message and redirect to the manage-users page
        $_SESSION['msg'] = "User registered successfully!";

        // Show success message with JavaScript alert
        echo "<script>
                        alert('Your registration was successful!');
                        window.location.href = 'index.php'; // Redirect after alert
                      </script>";
      } else {
        $error = "Something went wrong. Please try again!";
      }
    }
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>totoiscab</title>

  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Include Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="index.css">

</head>

<body>

  <!-- Navbar Section -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="uniqueNavbar">
    <a class="navbar-brand" href="#">
      <img style="padding: 10px; width: 90px; height: 90px; left:10px !important; border-radius: 50%;" src="images/totois.png" alt="Logo">
    </a>

    <button style="margin-right: 20px !important;" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto d-flex flex-row justify-content-between">
        <li class="nav-item">
          <a class="nav-link text-light" href="#" style="padding: 10px;">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="#about-us">Our services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="gallery.php">Gallery</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="#contact">Contact Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="https://totoiscabsandtravel.co.ke/roundcube/?_task=login" style="padding: 10px">Webmail</a>
        </li>
      </ul>
    </div>
  </nav>
  <style>
    /* General navbar style */
    .navbar-nav {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-wrap: nowrap;
      margin: 0;
    }

    /* Ensure nav items are spaced evenly */
    .navbar-nav .nav-item {
      margin: 0 10px;
    }

    /* Responsive adjustments for smaller screens */
    @media (max-width: 768px) {
      .navbar-nav {
        font-size: 14px;
        /* Adjust text size */
        justify-content: center;
        /* Ensure items are centered */
      }

      .nav-link {
        padding: 10px;
        white-space: nowrap;
        /* Prevent text from wrapping */
      }

      .navbar-nav .nav-item {
        margin: 0 5px;
        /* Reduced margin for smaller screens */
      }
    }
  </style>





  <!-- Full-Width Image Section -->
  <section class="image-section full-section-image" style="background-image: url('images/hire2.jpg');">
    <!-- Welcome Card -->
    <div id="welcomeCard">
      <p class="display-4 text-center" style="font-size:large;">WELCOME TO <br></p>
      <h1 class="display-4 text-center" style="font-size: 50px; font-weight: bold;font-family:'Times New Roman', Times, serif; color:rgb(8, 80, 104);"> TotoisCabs</h1>
      <div class="text-center mt-3">
        <a href="#about-us1" class="btn btn-success" style="font-size:small !important;">Know More About Us</a>
      </div>
    </div>
  </section>

  <!-- Our Services Section -->
  <section id="about-us" class="container py-5">
    <h2 class="text-center mb-4" style="color: #198754; margin-top: 80px">Our Services</h2>

    <!-- Carousel Wrapper -->
    <div id="aboutCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
      <div class="carousel-inner">

        <!-- Card 1 -->
        <div class="carousel-item active">
          <div class="row d-flex align-items-center">
            <div class="col-md-6">
              <img src="images/hire2.jpg" class="d-block w-100" alt="Service 1" style="height: 300px; object-fit: cover;">
            </div>
            <div class="col-md-6">
              <h4>Individual Taxi Services</h4>
              <p>We offer personalized taxi services for your specific needs. Whether for business or leisure, our reliable drivers and well-maintained vehicles ensure a comfortable, seamless journey.</p>
              <a href="gallery.php" class="btn btn-success">Learn More</a>
            </div>
          </div>
        </div>

        <!-- Card 2 -->
        <div class="carousel-item">
          <div class="row d-flex align-items-center">
            <div class="col-md-6">
              <img src="images/image2.png" class="d-block w-100" alt="Service 2" style="height: 300px; object-fit: cover;">
            </div>
            <div class="col-md-6">
              <h4>Chauffeur Driven Executive Vehicle Hire Services</h4>
              <p>Experience luxury with our professional chauffeur-driven executive vehicles, providing comfort and style for your business or special events.</p>
              <a href="gallery.php" class="btn btn-success">Learn More</a>
            </div>
          </div>
        </div>

        <!-- Card 3 -->
        <div class="carousel-item">
          <div class="row d-flex align-items-center">
            <div class="col-md-6">
              <img src="images/image3.png" class="d-block w-100" alt="Service 3" style="height: 300px; object-fit: cover;">
            </div>
            <div class="col-md-6">
              <h4>Corporate Taxi Plans</h4>
              <p>TortoiseCabs offers flexible corporate taxi plans tailored to your business needs, ensuring reliable and efficient transportation for employees and clients.</p>
              <a href="gallery.php" class="btn btn-success">Learn More</a>
            </div>
          </div>
        </div>

      </div>

      <!-- Carousel Controls -->
      <button class="carousel-control-prev" type="button" data-bs-target="#aboutCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#aboutCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </section>


  <!-- about our profile -->
  <section id="about-us1" class="container py-5" style="background-color: #072D4B; color: white !important;">
    <h2 class="text-center mb-4" style="margin-top: 80px;">About Us</h2>

    <div class="row">
      <div class="col-lg-6">
        <h4>Who We Are</h4>
        <p>
          Totois Cabs & Travel was established in January 2019 as a Taxi and Car Rental company, with a mission to bridge the transportation gap in Kenya. We are dedicated to providing easy, reliable, and flexible taxi transportation services with customer-centric payment plans.
        </p>
        <p>
          Our professional drivers are well-versed with the various parts of Nairobi and are equipped to cater to a wide range of industries. We also prioritize driver training to ensure that they fully understand our clients' expectations and communicate effectively to provide exceptional service.
        </p>
        <p>
          With our 24/7 call services, clients have access to dependable taxi services throughout Nairobi, and we offer exclusive full-day services for clients who need transportation throughout the day. Additionally, we provide travel services beyond Nairobi to various destinations within East Africa.
        </p>
      </div>

      <div class="col-lg-6">
        <h4>Our Services</h4>
        <ul>
          <li><strong>Individual Taxi Services:</strong> Convenient and reliable taxi rides tailored to your personal needs.</li>
          <li><strong>Corporate Taxi Plans:</strong> Flexible and cost-effective plans designed for businesses and corporate clients.</li>
          <li><strong>Self-Drive Vehicle Hire:</strong> Rent a car and drive yourself with easy access to our fleet of well-maintained vehicles.</li>
          <li><strong>Chauffeur-Driven Executive Vehicle Hire:</strong> Luxury, professional chauffeured rides for business or special occasions.</li>
          <li><strong>Airport Transfers:</strong> Smooth, punctual transportation to and from airports for both local and international travelers.</li>
          <li><strong>Air Ticketing:</strong> We provide comprehensive air ticketing services for both domestic and international flights.</li>
          <li><strong>Hotel Bookings or Reservations:</strong> Convenient hotel booking and reservation services to ensure your stay is comfortable and hassle-free.</li>
        </ul>
      </div>
    </div>


  </section>




  <!-- packages section -->
  <section id="packages" class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-12 text-center">
          <!-- Add the title "OUR PACKAGES" -->
          <h2 id="animatedTitle" class="mb-4 " style="color: #198754 !important;;"></h2>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="card p-3 shadow">
            <h3 class="card-title">Individual Taxi Services</h3>
            <p class="card-text">
              Totois Cabs allows customers to utilize our services and settle the bills later, meaning that the customer does not have to worry about their taxi costs every time they take a ride.
            </p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="card p-3 shadow">
            <h3 class="card-title">Corporate Taxi Services</h3>
            <p class="card-text">
              Available for any firm that will need taxi services. We have designed our products such that the company can settle the bills monthly or quarterly depending on their utility.
            </p>
          </div>
        </div>
        <div class="col-lg-4 col-md-12 mb-4">
          <div class="card p-3 shadow">
            <h3 class="card-title">VIP Taxi Services</h3>
            <p class="card-text">
              Offering premium taxi services with top-notch vehicles and experienced drivers. Designed for clients who value comfort and luxury during their rides.
            </p>
          </div>
        </div>

        <div class="col-lg-4 col-md-12 mb-4">
          <div class="card p-3 shadow">
            <h3 class="card-title">Air Ticketing</h3>
            <p class="card-text">
              We provide comprehensive air ticketing services for both domestic and international flights, ensuring a smooth travel experience.
            </p>
          </div>
        </div>

        <div class="col-lg-4 col-md-12 mb-4">
          <div class="card p-3 shadow">
            <h3 class="card-title">Hotel Bookings or Reservations</h3>
            <p class="card-text">
              Convenient hotel booking and reservation services to ensure your stay is comfortable and hassle-free, whether for business or leisure.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>



  <!-- charges section -->
  <section id="charges" class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-12 text-center">
          <h2 class="mb-4" style="color:#198754;">Our Charges</h2>
          <p class="lead">
            Our prices are the most competitive in the market for the quality services that we offer.
            You are rest assured that none of our competitors can match our prices and the quality of
            vehicles we use.
          </p>
          <p class="text-muted">Corporate clients attract a structured payment plan as follows:</p>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8 mb-4">
          <div class="card p-3 shadow-sm">
            <h3 class="card-title text-center">Small and Medium-Sized Enterprises (SMEs)</h3>
            <p class="card-text text-center">
              Monthly Credit Facilities
            </p>
          </div>
        </div>
        <div class="col-lg-6 col-md-8 mb-4">
          <div class="card p-3 shadow-sm">
            <h3 class="card-title text-center">Other Corporate Institutions</h3>
            <p class="card-text text-center">
              Monthly / Quarterly Credit Facilities
            </p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12 text-center">
          <p class="text-muted mt-4">No deposits are required unless otherwise agreed.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Hidden Form for Booking -->
  <!-- Example Row -->
  <?php

  $email = isset($_SESSION['login']) ? $_SESSION['login'] : null;

  if ($email) {
    // Prepare the SQL query
    $sql = "SELECT * FROM users WHERE email1 = :email";
    $query = $dbh->prepare($sql);

    // Bind the email parameter
    $query->bindParam(':email', $email, PDO::PARAM_STR);

    // Execute the query
    $query->execute();

    // Fetch all the results as objects
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    // Check if any results were returned
    if ($query->rowCount() > 0) {
      foreach ($results as $result) { ?>

        <section style="background-image: url('images/back.jpg'); background-size: cover; background-position: center; background-color: transparent !important;">
          <div id="bookingForm"
            style="display:none; margin-top:20px; "
            class="container justify-content-center align-items-center">
            <div class="card p-4 shadow-sm" style=" width: 100%; margin:20px; border: 2px solid white; background-color: transparent;">
              <h3 class="card-title text-center text-light mb-4" style="margin-top:80px;">Make Your Booking</h3>
              <form class="container text-light" method="POST" action="login.php" style="background-color: transparent; width: 100%; padding: 20px; border: none;">

                <div class="mb-3">
                  <label for="name" class="form-label">Full Name</label>
                  <input type="text" class="form-control" id="name" name="name7" placeholder="<?php echo htmlentities($result->fname); ?>" required>
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Email Address</label>
                  <input type="email" class="form-control" id="email" name="email7" placeholder="<?php echo htmlentities($result->email1); ?>" required required>
                </div>
                <div class="mb-3">
                  <label for="phone" class="form-label">Phone Number</label>
                  <input type="tel" class="form-control" id="phone" name="phone7" placeholder="<?php echo htmlentities($result->phone1); ?>" required>
                </div>
                <div class="mb-3">
                  <label for="idnumber" class="form-label">ID Number</label>
                  <input type="text" class="form-control" id="idnumber" name="idnumber" required>
                </div>
                <div class="mb-3">
                  <label for="ptime" class="form-label">Pickup Time</label>
                  <input type="datetime-local" class="form-control" id="ptime" name="ptime" required>
                </div>
                <div class="mb-3">
                  <label for="pickup" class="form-label">Pickup Location</label>
                  <input type="text" class="form-control" id="pickup" name="pickup" required>
                </div>
                <div class="mb-3">
                  <label for="dreturn" class="form-label">Date of Return(optional)</label>
                  <input type="datetime-local" class="form-control" id="dreturn" name="dreturn">
                </div>
                <div class="mb-3">
                  <label for="vtype" class="form-label">Service Category</label>
                  <select id="vehicle-category" name="vtype" class="form-select" required>
                    <option value="" disabled selected>Select Category</option>
                    <option value="standard-taxi">Standard Taxi Services</option>
                    <option value="self-drive">Self-Drive Hire/Chauffeur-Driven Hires</option>
                    <option value="executive">Executive Chauffeur-Driven Rides</option>
                    <option value="executive">Other</option>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="pickup" class="form-label">Desired Vehicle</label>
                  <input type="text" class="form-control" id="pickup" name="vehclename" required>
                </div>
                <div class="text-center">
                  <button type="submit" name="book" class="btn btn-primary w-100">Submit</button>
                </div>
              </form>
            </div>
          </div><?php }
            }
          }  ?>


    <?php

    ?>
    <?php
    // Check if 'login' is set in the session
    if (isset($_SESSION['login']) && strlen($_SESSION['login']) == 0) { ?>
      <div class="modal-footer justify-content-center">
        <p>You must login before you make any bookings! <a href="#register-section" id="showRegisterLink" data-bs-dismiss="modal">Register/Login</a></p>
      </div>
    <?php } ?>

    </div>
    </div>
        </section>
        <!-- submit data into booking page -->

        <!-- hidden form for register -->
        <section id="bookingForm" class="my-5 text-light" style="display:none; 
           margin: 20px auto !important;
           background-image: url('images/back.jpg'); 
           background-size: cover; 
           background-position: center; 
           padding: 20px !important; 
           max-width: 100% !important;">

          <div class="container">
            <div class="row justify-content-center">
              <div class="col-md-6 col-lg-6 col-12"> <!-- Ensuring responsiveness for small screens -->
                <h2 class="text-center mb-4" style="margin-top:100px;">Register before making any reservations</h2>
                <form method="POST" action="index.php" name="signup" onsubmit="return valid();">
                  <!-- Name Input -->
                  <div class="mb-3">
                    <label for="register-name" class="form-label">Full Name</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="fas fa-user"></i></span>
                      <input type="text" name="name" class="form-control" id="register-name" placeholder="Enter your name" required>
                    </div>
                  </div>

                  <!-- Email Input -->
                  <div class="mb-3">
                    <label for="register-email" class="form-label">Email Address</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                      <input type="email" name="emailid" class="form-control" id="emailid" placeholder="Enter your email" required>
                      <span id="user-availability-status"></span> <!-- Display email availability message here -->
                      <div id="loaderIcon" style="display:none;"><img src="https://app.lottiefiles.com/animation/311c575f-a667-4434-a857-5dadf4901282" alt="Loading..."></div>
                    </div>
                  </div>

                  <!-- Phone Input -->
                  <div class="mb-3">
                    <label for="register-phone" class="form-label">Phone Number</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="fas fa-phone"></i></span>
                      <input type="text" name="phone" class="form-control" id="register-phone" placeholder="Enter your phone number" required>
                    </div>
                  </div>

                  <!-- Password Input -->
                  <div class="mb-3">
                    <label for="register-password" class="form-label">Password</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="fas fa-lock"></i></span>
                      <input type="password" name="password" class="form-control" id="register-password" placeholder="Enter your password" required>
                      <span class="input-group-text" onclick="togglePasswordVisibility('register-password', 'password-eye')" style="cursor: pointer;">
                        <i id="password-eye" class="fas fa-eye"></i>
                      </span>
                    </div>
                    <div id="password-error" class="text-danger" style="display: none;">Password must be at least 8 characters long and include a mix of uppercase, lowercase, numbers, and special characters.</div>
                  </div>

                  <!-- Confirm Password Input -->
                  <div class="mb-3">
                    <label for="register-confirm-password" class="form-label">Confirm Password</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="fas fa-lock"></i></span>
                      <input type="password" name="confirm_password" class="form-control" id="register-confirm-password" placeholder="Confirm your password" required>
                      <span class="input-group-text" onclick="togglePasswordVisibility('register-confirm-password', 'confirm-password-eye')" style="cursor: pointer;">
                        <i id="confirm-password-eye" class="fas fa-eye"></i>
                      </span>
                    </div>
                  </div>


                  <!-- Register Button -->
                  <button type="submit" id="submit" name="register" class="btn btn-success w-100 mb-3">Register</button>

                  <!-- Already Registered? Login link -->
                  <p class="text-center">Already registered? <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a></p>
                </form>
              </div>
            </div>
          </div>
        </section>
        <!-- JavaScript to toggle password visibility -->
        <script>
          function togglePasswordVisibility(inputId, iconId) {
            const passwordField = document.getElementById(inputId);
            const eyeIcon = document.getElementById(iconId);

            if (passwordField.type === "password") {
              passwordField.type = "text";
              eyeIcon.classList.remove('fa-eye');
              eyeIcon.classList.add('fa-eye-slash');
            } else {
              passwordField.type = "password";
              eyeIcon.classList.remove('fa-eye-slash');
              eyeIcon.classList.add('fa-eye');
            }
          }
        </script>



        <!-- Login Modal -->
        <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="login.php" method="POST">
                  <!-- Email Input -->
                  <div class="mb-3">
                    <label for="login-email" class="form-label">Email Address</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                      <input type="email" name="emaillogin" class="form-control" id="login-email" placeholder="Enter your email" required>
                    </div>
                  </div>

                  <!-- Password Input -->
                  <div class="mb-3">
                    <label for="login-password" class="form-label">Password</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="fas fa-lock"></i></span>
                      <input type="password" name="passlogin" class="form-control" id="login-password" placeholder="Enter your password" required>
                      <span class="input-group-text" onclick="togglePasswordVisibility('login-password', 'login-password-eye')" style="cursor: pointer;">
                        <i id="login-password-eye" class="fas fa-eye"></i>
                      </span>
                    </div>
                  </div>

                  <!-- Login Button -->
                  <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
                </form>
              </div>
              <div class="modal-footer justify-content-center">
                <p><a href="#register-section" data-bs-dismiss="modal">Register</a></p>
                <p><a href="#" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal" data-bs-dismiss="modal">Forgot Password?</a></p>
                <p><a href="#" data-bs-toggle="modal" data-bs-target="#resetPasswordModal" data-bs-dismiss="modal">Reset Password</a></p>
              </div>
            </div>
          </div>
        </div>

        <!-- Forgot Password Modal -->
        <div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="forgotPasswordModalLabel">Forgot Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="resetpassword.php" method="POST">
                  <!-- Email Input -->
                  <div class="mb-3">
                    <label for="forgot-password-email" class="form-label">Email Address</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                      <input type="email" name="forgotpasswordemail" class="form-control" id="forgot-password-email" placeholder="Enter your email" required>
                    </div>
                  </div>

                  <!-- Submit Button -->
                  <button type="submit" name="sendresetlink" class="btn btn-primary w-100">Send Reset Link</button>
                </form>
              </div>
              <div class="modal-footer justify-content-center">
                <p>Remember your password? <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">Login</a></p>
              </div>
            </div>
          </div>
        </div>

        <!-- Reset Password Modal -->
        <div class="modal fade" id="resetPasswordModal" tabindex="-1" aria-labelledby="resetPasswordModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="resetPasswordModalLabel">Reset Your Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="resetpassword.php" method="POST">
                  <!-- Email Input -->
                  <div class="mb-3">
                    <label for="reset-password-email" class="form-label">Email Address</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                      <input type="email" name="resetpasswordemail" class="form-control" id="reset-password-email" placeholder="Enter your email" required>
                    </div>
                  </div>

                  <!-- Received Password Input -->
                  <div class="mb-3">
                    <label for="reset-received-password" class="form-label">Password from Email(current password)</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="fas fa-lock"></i></span>
                      <input type="password" name="receivedpassword" class="form-control" id="reset-received-password" placeholder="Enter the password received from email" required>
                      <span class="input-group-text" onclick="togglePasswordVisibility('reset-received-password', 'reset-received-password-eye')" style="cursor: pointer;">
                        <i id="reset-received-password-eye" class="fas fa-eye"></i>
                      </span>
                    </div>
                  </div>

                  <!-- New Password Input -->
                  <div class="mb-3">
                    <label for="reset-new-password" class="form-label">New Password</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="fas fa-lock"></i></span>
                      <input type="password" name="newpassword" class="form-control" id="reset-new-password" placeholder="Enter new password" required>
                      <span class="input-group-text" onclick="togglePasswordVisibility('reset-new-password', 'reset-new-password-eye')" style="cursor: pointer;">
                        <i id="reset-new-password-eye" class="fas fa-eye"></i>
                      </span>
                    </div>
                  </div>

                  <!-- Submit Button -->
                  <button type="submit" name="resetpassword" class="btn btn-primary w-100">Reset Password</button>
                </form>
              </div>
              <div class="modal-footer justify-content-center">
                <p>Back to <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">Login</a></p>
              </div>
            </div>
          </div>
        </div>
        <!-- JavaScript to toggle password visibility -->
        <script>
          function togglePasswordVisibility(inputId, iconId) {
            const passwordField = document.getElementById(inputId);
            const eyeIcon = document.getElementById(iconId);

            if (passwordField.type === "password") {
              passwordField.type = "text";
              eyeIcon.classList.remove('fa-eye');
              eyeIcon.classList.add('fa-eye-slash');
            } else {
              passwordField.type = "password";
              eyeIcon.classList.remove('fa-eye-slash');
              eyeIcon.classList.add('fa-eye');
            }
          }


          function togglePasswordVisibility(inputId, eyeIconId) {
            const input = document.getElementById(inputId);
            const eyeIcon = document.getElementById(eyeIconId);

            if (input.type === "password") {
              input.type = "text";
              eyeIcon.classList.remove("fa-eye");
              eyeIcon.classList.add("fa-eye-slash");
            } else {
              input.type = "password";
              eyeIcon.classList.remove("fa-eye-slash");
              eyeIcon.classList.add("fa-eye");
            }
          }
        </script>


        <!-- Contact Us Section -->
        <section id="contact" class="py-5 bg-light">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-lg-6 text-center">
                <h2 class="mb-4" style="color:#198754; margin-top:50px;">Contact Us</h2>
                <p class="lead">We’re here to assist you. Get in touch for inquiries or assistance. We look forward to hearing from you!</p>
              </div>
            </div>
            <div class="row mt-4">
              <!-- Contact Form -->
              <div class="col-lg-6 col-md-12 mb-4">
                <form class="p-5 bg-white shadow-lg rounded" method="POST" action="sendemail.php">
                  <div class="form-group mb-4">
                    <label for="name" class="font-weight-bold">Your Name</label>
                    <input type="text" name="name" class="form-control form-control-lg" id="name" placeholder="Enter your name" required>
                  </div>
                  <div class="form-group mb-4">
                    <label for="email" class="font-weight-bold">Your Email</label>
                    <input type="email" name="email" class="form-control form-control-lg" id="email1" placeholder="Enter your email" required>
                  </div>
                  <div class="form-group mb-4">
                    <label for="message" class="font-weight-bold">Your Message</label>
                    <textarea class="form-control form-control-lg" name="message" id="message" rows="5" placeholder="Enter your message" required></textarea>
                  </div>
                  <button type="submit" name="submit" class="btn btn-success btn-block btn-lg" style="width: auto; display: block; 
  margin: 0 auto; border-radius: 6px; background-color:#28a745 !important;">Send Message</button>
                </form>
              </div>
              <!-- Contact Details -->
              <div class="col-lg-6 col-md-12 mb-4">
                <div class="bg-white p-5 shadow-lg rounded h-100 d-flex flex-column justify-content-center">
                  <h4 class="mb-4 font-weight-bold">Get in Touch</h4>
                  <p class="mb-3">
                    <i class="fas fa-phone-alt text-primary"></i>
                    <strong>Phone:</strong>
                    <a href="tel:+254758077188" class="text-dark">+254 758 077188</a>
                  </p>
                  <p class="mb-3">
                    <i class="fas fa-envelope text-primary"></i>
                    <strong>Email:</strong>
                    <a href="mailto:totoiscabs@gmail.com" class="text-dark">totoiscabs@gmail.com</a>
                  </p>
                  <p class="mb-3">
                    <i class="fas fa-map-marker-alt text-primary"></i>
                    <strong>Location:</strong> Karen Road, Number 76/77 opposite The Hub – 00100, Nairobi
                  </p>
                  <!-- Button to Trigger the Form Section -->
                  <button id="bookRideBtn" class="btn btn-success mb-3">BOOK A RIDE</button>
                </div>
              </div>
            </div>
          </div>
        </section>









        <h2 id="animatedTitle" class="mb-4" style="color: #198754;"></h2>

        <footer class="custom-footer">
          <div class="footer-overlay">
            <div class="footer-section bg-success-light">
              <div class="container">
                <div class="row align-items-center text-center">
                  <!-- Logo Section -->
                  <div class="col-md-4 mb-3 mb-md-0">
                    <img src="images/totois.png" alt="TotoisCabs Logo" class="footer-logo">
                  </div>

                  <!-- Social Media Icons Section -->
                  <div class="col-md-4 mb-3 mb-md-0">
                    <ul class="social-icons list-inline">
                      <li class="list-inline-item">
                        <a href="https://facebook.com" target="_blank" rel="noopener noreferrer" class="text-primary">
                          <i class="fab fa-facebook-f"></i>
                        </a>
                      </li>
                      <li class="list-inline-item">
                        <a href="https://twitter.com" target="_blank" rel="noopener noreferrer" class="text-info">
                          <i class="fab fa-twitter"></i>
                        </a>
                      </li>
                      <li class="list-inline-item">
                        <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" class="text-danger">
                          <i class="fab fa-instagram"></i>
                        </a>
                      </li>
                      <li class="list-inline-item">
                        <a href="https://linkedin.com" target="_blank" rel="noopener noreferrer" class="text-secondary">
                          <i class="fab fa-linkedin-in"></i>
                        </a>
                      </li>
                    </ul>
                  </div>

                  <!-- Contact Info Section -->
                  <div class="col-md-4">
                    <p class="mb-0">
                      <strong>Contact Us:</strong> +254 758 077188 <br>
                      <a href="mailto:totoiscabs@gmail.com" class="text-light">totoiscabs@gmail.com</a>
                    </p>
                  </div>
                </div>

                <!-- New Links: Admin Login and User Logout -->
                <div class="row mt-3">
                  <div class="col-md-12 text-center">
                    <a href="admin/index.php" class="text-light me-3">Admin Login</a>
                    <?php
                    // Check if 'login' is set in the session
                    if (isset($_SESSION['login']) && strlen($_SESSION['login']) != 0) { ?>

                      <a href="logout.php" class="text-light">User Logout</a>

                    <?php } ?>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </footer>




        <!-- ajax for email check -->
        <script type="text/javascript">
          function checkAvailability() {
            // Show loading icon while waiting for the response
            $("#loaderIcon").show();

            // AJAX request to check if the email is available
            jQuery.ajax({
              url: "check-email.php", // PHP script that checks email availability
              data: 'emailid=' + $("#emailid").val(), // Send the email ID to the backend
              type: "POST",
              success: function(data) {
                // Display the result of the email check
                $("#user-availability-status").html(data);
                // Hide the loading icon once the result is received
                $("#loaderIcon").hide();
              },
              error: function() {
                console.log("Error occurred while checking email availability.");
              }
            });
          }

          // Password validation function
          function valid() {
            if (document.signup.password.value != document.signup.confirmpassword.value) {
              alert("Password and Confirm Password do not match!");
              document.signup.confirmpassword.focus();
              return false;
            }
            return true;
          }
        </script>




        <script>
          document.getElementById('showRegisterLink').addEventListener('click', function() {
            // Get the register section element
            const registerSection = document.getElementById('register-section');

            // Show the registration form
            registerSection.style.display = 'block'; // Make the section visible

            // Add a small delay to allow the section to be displayed before scrolling
            setTimeout(() => {
              // Scroll to the register section smoothly
              registerSection.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
              });
            }, 10);
          });
        </script>

        <script>
          document.getElementById('register-password').addEventListener('input', function() {
            const password = this.value;
            const passwordError = document.getElementById('password-error');
            const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

            if (regex.test(password)) {
              passwordError.style.display = 'none'; // Hide error if password is valid
            } else {
              passwordError.style.display = 'block'; // Show error if password does not meet criteria
            }
          });
        </script>

        <script>
          document.getElementById('bookRideBtn').addEventListener('click', function() {
            // Get the form element
            const bookingForm = document.getElementById('bookingForm');

            // Show the form with animation
            bookingForm.style.display = 'flex'; // Make the form visible
            setTimeout(() => {
              bookingForm.classList.add('show'); // Apply animation after the form is visible
            }, 10); // Small delay to ensure the form is displayed before the animation starts

            // Scroll to the form to make it visible
            bookingForm.scrollIntoView({
              behavior: 'smooth',
              block: 'start'
            });
          });

          document.getElementById('rideForm').addEventListener('submit', function(event) {
            // Form will now submit to the server (no preventDefault)

            // Hide the form with animation after submission
            const bookingForm = document.getElementById('bookingForm');
            bookingForm.classList.remove('show'); // Remove animation class

            // Optional: Reset the form
            document.getElementById('rideForm').reset();

            // Hide the form after the animation finishes (to avoid abrupt hiding)
            setTimeout(() => {
              bookingForm.style.display = 'none'; // Make the form invisible after animation
            }, 500); // Match this timeout with the duration of the animation
          });
        </script>

        <script>
          // Select the navbar element
          const navbar = document.querySelector('.navbar');

          // Add a scroll event listener to change the navbar background color
          window.addEventListener('scroll', () => {
            // Check if the page has scrolled down
            if (window.scrollY > 0) {
              // Add the 'scrolled' class to change the background color
              navbar.classList.add('scrolled');
            } else {
              // Remove the 'scrolled' class when at the top of the page
              navbar.classList.remove('scrolled');
            }
          });

          window.onload = function() {
            document.querySelector('.loader-container').style.display = 'none';
          };
        </script>








        <script>
          // JavaScript to control when the welcome card appears
          document.addEventListener('DOMContentLoaded', function() {
            // Wait for the image animation to complete (2 seconds)
            setTimeout(function() {
              // Show the welcome card and apply the zoom-in animation
              var welcomeCard = document.getElementById('welcomeCard');
              welcomeCard.style.display = 'block'; // Make it visible
              welcomeCard.classList.add('zoomInCard'); // Apply the zoom-in animation
            }, 2000); // Match the delay with the image animation duration
          });
        </script>
        <script>
          document.addEventListener('DOMContentLoaded', function() {
            var titleText = "OUR PACKAGES";
            var index = 0;
            var animatedTitle = document.getElementById('animatedTitle');

            function typeTitle() {
              if (index < titleText.length) {
                animatedTitle.innerHTML += titleText.charAt(index);
                index++;
                setTimeout(typeTitle, 400); // Speed of typing effect
              }
            }

            typeTitle();
          });
        </script>
        <script>
          // Initialize the carousel instance
          const carouselElement = document.querySelector('#aboutCarousel');
          const carouselInstance = new bootstrap.Carousel(carouselElement, {
            interval: false, // We will control the timing manually
            wrap: true, // Allow the carousel to loop continuously
          });

          // Function to move the carousel smoothly without gaps
          function smoothSlide() {
            const activeSlide = carouselElement.querySelector('.carousel-item.active');
            let nextSlide = activeSlide.nextElementSibling;

            // If no next slide (end of carousel), loop back to the first
            if (!nextSlide) {
              nextSlide = carouselElement.querySelector('.carousel-item:first-child');
            }

            // Start moving the next slide in as the current slide moves out
            activeSlide.classList.remove('active'); // Remove active class from current slide
            nextSlide.classList.add('active'); // Add active class to the next slide

            // After a short delay, continue with the next slide
            setTimeout(smoothSlide, 3000); // Adjust 3000 for timing between slides
          }

          // Start the smooth sliding process
          setTimeout(smoothSlide, 3000); // Start the cycle after 3 seconds
        </script>


        <!-- back button -->
        <button id="backButton" class="btn btn-success">Back</button>
        <style>
          #backButton {
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            background-color: rgba(76, 175, 80, 0.5);
            ;

            color: white;
            cursor: pointer;
            border-radius: 5px;
            z-index: 1000;
          }

          #backButton:hover {
            background-color: rgba(76, 175, 80, 0.7);
          }
        </style>
        <script>
          document.getElementById("backButton").addEventListener("click", function() {
            window.history.back(); // Goes to the previous page
          });
          document.getElementById("backButton").addEventListener("click", function() {
            window.history.back(); // Goes to the previous page
          });
        </script>


        <!-- Include jQuery (before Bootstrap JS) -->
        <!-- Bootstrap JS, jQuery, and Popper.js for Navbar Toggling -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Footer Section -->
        <footer style="background-color: black; padding: 20px; text-align: center; position: relative; bottom: 0; width: 100%; border-top: 1px solid #eaeaea;">
          <p style="margin: 0; font-size: 14px; color: white;">
            &copy; Tortoise Cabs and Travels 2024. All rights reserved.
          </p>
        </footer>
</body>

</html>