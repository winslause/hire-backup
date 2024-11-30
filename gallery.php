<?php
session_start();
error_reporting(0);
include('config.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>totoiscab</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Include Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


  <style>
    html,
    body {
      overflow-x: hidden;
      /* Disable horizontal scrolling */
      margin: 0;
      padding: 0;
      width: 100%;
    }

    /* Image section slide-in animation */
    .image-section {
      animation: slideInImage 2s ease-in-out;
      /* You can change this animation to any effect you want for the image */
      width: 100%;
      height: 100vh;
      background-size: cover;
      background-position: center;
      display: flex;
      justify-content: center;
      align-items: center;
      position: relative;
    }

    /* Define the image slide-in keyframes */
    @keyframes slideInImage {
      0% {
        transform: translateY(-100%);
        opacity: 0;
        /* Fully transparent */
      }

      100% {
        transform: translateY(0);
        /* Image back to its original position */
        opacity: 1;
        /* Fully visible */
      }
    }

    /* Initially hide the welcome card */
    #welcomeCard {
      display: none;
      /* Hide the card initially */
      background: rgba(255, 255, 255, 0.6);
      /* Light background overlay */
      padding: 20px;
      border-radius: 10px;
      max-width: 80%;
      margin: 0 auto;
      position: relative;
    }

    /* Zoom-in animation for the welcome card */
    .zoomInCard {
      animation: zoomInCard 2s ease-in-out;
    }

    /* Define the zoom-in keyframes for the welcome card */
    @keyframes zoomInCard {
      0% {
        transform: scale(0);
        /* Start with the card very small */
        opacity: 0;
        /* Fully transparent */
      }

      100% {
        transform: scale(1);
        /* Normal size */
        opacity: 1;
        /* Fully visible */
      }
    }

    /* About Us section */
    #aboutCarousel {
      position: relative;
    }

    /* Position arrows outside the cards */
    .carousel-control-prev,
    .carousel-control-next {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      z-index: 5;
      /* Ensure arrows are above content */
      background-color: rgba(0, 0, 0, 0.7);
      /* Semi-transparent background */
      border: none;
      /* Remove borders */
      width: 40px;
      /* Optional: Adjust the width of the arrows */
      height: 40px;
      /* Optional: Adjust the height of the arrows */
      display: flex;
      justify-content: center;
      align-items: center;
      border-radius: 50%;
      /* Circular background */
    }

    /* Navbar Styling */
    #uniqueNavbar {
      position: fixed;
      /* Fixed at the top */
      width: 100%;
      top: 0;
      left: 0;
      z-index: 1030;
      /* Ensure it stays above other content */
      transition: background-color 0.3s ease;
      /* Smooth transition for color change */
    }

    /* Default navbar color (black) */
    #uniqueNavbar.navbar-dark {
      background-color: #000;
      /* Black background */
    }

    /* When scrolling down, the navbar will have a background color of rgba(0, 86, 179, 0.5) */
    .scrolled {
      background-color: rgba(40, 167, 69, 0.5) !important;
    }



    .card-img-hover img {
      width: 100%;
      height: auto;
      transition: transform 0.3s ease-in-out;
    }

    .card-img-hover img:hover {
      transform: scale(1.1);
    }

    /* Background image and footer overlay styling */
    .custom-footer {
      background-image: url('images/back2.jpg');
      background-size: cover;
      background-position: center;
      position: relative;
      padding: 50px 0;
    }

    .footer-overlay {
      background: rgba(0, 0, 0, 0.6);
      /* Dark overlay on background */
      padding: 30px;
    }

    /* Section inside the footer with light shading */
    .footer-section {
      background-color: rgba(40, 167, 69, 0.8);
      /* Light bg-success color */
      padding: 20px;
      border-radius: 10px;
      margin: 20px;
      color: #fff;
    }

    /* Logo animation: spin 360 degrees continuously */
    .footer-logo {
      max-width: 100px;
      animation: spin 4s linear infinite;
    }

    @keyframes spin {
      0% {
        transform: rotate(0deg);
      }

      100% {
        transform: rotate(360deg);
      }
    }

    /* Social media icon styles */
    .social-icons a {
      font-size: 24px;
      margin: 0 10px;
      transition: transform 0.3s ease;
    }

    .social-icons a:hover {
      transform: scale(1.2);
    }

    /* Responsive styling */
    @media (max-width: 768px) {
      .social-icons a {
        font-size: 20px;
      }
    }

    body {
      overflow: smooth !important;
      scroll-behavior: smooth !important;
    }
  </style>



</head>

<body>

  <!-- Navbar Section -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="uniqueNavbar">
    <a class="navbar-brand" href="#">
      <img style="padding: 10px; width: 100px; height: 100px; left:10px !important; border-radius: 50%;" src="images/totois.png" alt="Logo">
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
          <a class="nav-link text-light" href="index.php#about-us">Our services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="gallery.php">Gallery</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="index.php#contact">Contact Us</a>
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


  <!-- Our Services: Vehicle Profile Section -->
  <section id="vehicle-profile" class="container py-5">
    <h2 class="text-center mb-4" style="color: #28a745; margin-top:100px"><b>Our Vehicles</b></h2>

    <!-- Standard Taxi Services -->
    <h3 class="text-center text-success mb-4">Standard Taxi Services</h3>

    <div class="row">
      <?php
      $standard = "standard-taxi";
      $sql = "SELECT * FROM vehicles WHERE category = :standard ORDER BY id DESC";
      $query = $dbh->prepare($sql);
      $query->bindParam(':standard', $standard, PDO::PARAM_STR);
      $query->execute();
      $results = $query->fetchAll(PDO::FETCH_OBJ);

      if ($query->rowCount() > 0) {
        foreach ($results as $result) {
      ?>
          <div class="col-md-4 mb-4">
            <div class="card h-100">
              <div class="card-img-hover">
                <img src="./images/<?php echo htmlentities($result->image); ?>" class="card-img-top" alt="Toyota Axio/Fielder">
              </div>
              <div class="card-body">
                <h5 class="card-title text-center"><?php echo htmlentities($result->name); ?></h5>
                <p class="card-text text-center">Max passengers: <?php echo htmlentities($result->capacity); ?></p>
              </div>
            </div>
          </div>
      <?php
        }
      } else {
        echo "<p>No images found in the gallery.</p>";
      }
      ?>
    </div> <!-- Close Standard Taxi Services Row -->

    <!-- Self-Drive Hire/Chauffeur-Driven Hires -->
    <h3 class="text-center text-success mb-4">Self-Drive Hire/Chauffeur-Driven Hires</h3>

    <div class="row">
      <?php
      $standard = "self-drive";
      $sql = "SELECT * FROM vehicles WHERE category = :standard ORDER BY id DESC";
      $query = $dbh->prepare($sql);
      $query->bindParam(':standard', $standard, PDO::PARAM_STR);
      $query->execute();
      $results = $query->fetchAll(PDO::FETCH_OBJ);

      if ($query->rowCount() > 0) {
        foreach ($results as $result) {
      ?>
          <div class="col-md-4 mb-4">
            <div class="card h-100">
              <div class="card-img-hover">
                <img src="./images/<?php echo htmlentities($result->image); ?>" class="card-img-top" alt="Toyota Axio/Fielder">
              </div>
              <div class="card-body">
                <h5 class="card-title text-center"><?php echo htmlentities($result->name); ?></h5>
                <p class="card-text text-center">Max passengers: <?php echo htmlentities($result->capacity); ?></p>
              </div>
            </div>
          </div>
      <?php
        }
      } else {
        echo "<p>No images found in the gallery.</p>";
      }
      ?>
    </div> <!-- Close Self-Drive Hire/Chauffeur-Driven Hires Row -->

    <!-- Executive Chauffeur-Driven Rides -->
    <h3 class="text-center text-success mb-4">Executive Chauffeur-Driven Rides</h3>

    <div class="row">
      <?php
      $standard = "executive";
      $sql = "SELECT * FROM vehicles WHERE category = :standard ORDER BY id DESC";
      $query = $dbh->prepare($sql);
      $query->bindParam(':standard', $standard, PDO::PARAM_STR);
      $query->execute();
      $results = $query->fetchAll(PDO::FETCH_OBJ);

      if ($query->rowCount() > 0) {
        foreach ($results as $result) {
      ?>
          <div class="col-md-4 mb-4">
            <div class="card h-100">
              <div class="card-img-hover">
                <img src="./images/<?php echo htmlentities($result->image); ?>" class="card-img-top" alt="Toyota Axio/Fielder">
              </div>
              <div class="card-body">
                <h5 class="card-title text-center"><?php echo htmlentities($result->name); ?></h5>
                <p class="card-text text-center">Max passengers: <?php echo htmlentities($result->capacity); ?></p>
              </div>
            </div>
          </div>
      <?php
        }
      } else {
        echo "<p>No images found in the gallery.</p>";
      }
      ?>
    </div> <!-- Close Executive Chauffeur-Driven Rides Row -->

  </section>






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








  <!-- Bootstrap JS, jQuery, and Popper.js for Navbar Toggling -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

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



  <!-- Footer Section -->
  <footer style="background-color: black; padding: 20px; text-align: center; position: relative; bottom: 0; width: 100%; border-top: 1px solid #eaeaea;">
    <p style="margin: 0; font-size: 14px; color: white;">
      &copy; Tortoise Cabs and Travels 2024. All rights reserved.
    </p>
  </footer>
</body>

</html>