<?php
session_start();
error_reporting(0);
include('config.php');
if (strlen($_SESSION['alogin']) == 0) {
  header('location:index.php');
} else {
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal</title>
    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
      /* Sidebar styles */
      .sidebar {
        position: fixed !important;
        top: 0 !important;
        left: 0 !important;
        z-index: 1050 !important;
        width: 250px !important;
        background-color: #212529 !important;
        /* Darker background color */
        color: white !important;
        height: 100% !important;
        display: block !important;
        /* Show sidebar by default */
      }

      .sidebar.active {
        display: block !important;
        /* Keep visible when active */
      }

      .sidebar-heading {
        font-size: 1.5rem;
        color: #f8f9fa;
        /* Light text color */
        padding: 15px;
        background-color: #343a40 !important;
        /* Dark header background */
      }

      .nav-link {
        color: #adb5bd !important;
        /* Light text for links */
      }

      .nav-link.active {
        background-color: #495057 !important;
        /* Highlight active link */
      }

      .nav-link:hover {
        background-color: #495057 !important;
        /* Darken on hover */
      }

      .content {
        margin-left: 250px !important;
        /* Ensure content is shifted for sidebar */
      }

      /* For mobile screens */
      @media (max-width: 767px) {
        .sidebar {
          display: none !important;
          /* Hide sidebar on mobile */
        }

        .sidebar.active {
          display: block !important;
          /* Show sidebar on mobile when toggled */
        }

        .content {
          margin-left: 0 !important;
          /* Ensure content takes full width on mobile */
        }
      }
    </style>

  </head>

  <body>

    <!-- Toggle button for mobile view -->
    <button class="btn toggle-sidebar d-md-none"><i class="fas fa-bars"></i></button>

    <!-- Sidebar -->
    <nav class="sidebar d-flex flex-column p-3">
      <div class="sidebar-heading">Admin Panel</div>
      <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
          <a href="home.php" class="nav-link active">
            <i class="fas fa-tachometer-alt"></i>
            Dashboard
          </a>
        </li>
        <li>
          <a href="managebookings.php" class="nav-link">
            <i class="fas fa-calendar-check"></i>
            Manage Bookings
          </a>
        </li>
        <li>
          <a href="managevehicles.php" class="nav-link">
            <i class="fas fa-images"></i>
            Manage Vehicles
          </a>
        </li>
        <li>
          <a href="manageusers.php" class="nav-link">
            <i class="fas fa-users"></i>
            Manage Users
          </a>
        </li>
        <li>
          <a href="managedrivers.php" class="nav-link">
            <i class="fas fa-car"></i>
            Manage Drivers
          </a>
        </li>
        <li>
          <a href="contactus.php" class="nav-link">
            <i class="fas fa-envelope"></i>
            Contact Us
          </a>
        </li>
        <li>
          <a href="logout.php" class="nav-link">
            <i class="fas fa-sign-out-alt"></i>
            Logout
          </a>
        </li>
        <li>
          <a href="changepassword.php" class="nav-link">
            <i class="fas fa-key"></i>
            Change Password
          </a>
        </li>
      </ul>
    </nav>

    <!-- Content Section -->
    <div class="content p-4">

      <!-- Manage vehicles -->
      <section id="add-vehicle" class="container my-5">
        <h2 class="text-center mb-4">Add Vehicle</h2>
        <form method="POST" action="managevehicles.php" class="bg-light p-4 rounded shadow-sm" enctype="multipart/form-data">
          <div class="row mb-3">
            <label for="vehicle-category" class="col-sm-3 col-form-label">
              <i class="fas fa-car-side"></i> Vehicle Category
            </label>
            <div class="col-sm-9">
              <select id="vehicle-category" name="vehicle_category" class="form-select" required>
                <option value="" disabled selected>Select Category</option>
                <option value="standard-taxi">Standard Taxi Services</option>
                <option value="self-drive">Self-Drive Hire/Chauffeur-Driven Hires</option>
                <option value="executive">Executive Chauffeur-Driven Rides</option>
              </select>
            </div>
          </div>

          <div class="row mb-3">
            <label for="vehicle-name" class="col-sm-3 col-form-label">
              <i class="fas fa-car"></i> Vehicle Name
            </label>
            <div class="col-sm-9">
              <input type="text" name="vehicle_name" id="vehicle-name" class="form-control" placeholder="Enter Vehicle Name" required>
            </div>
          </div>

          <div class="row mb-3">
            <label for="plate-number" class="col-sm-3 col-form-label">
              <i class="fas fa-hashtag"></i> Plate Number
            </label>
            <div class="col-sm-9">
              <input type="text" id="plate-number" name="plate_number" class="form-control" placeholder="Enter Plate Number" required>
            </div>
          </div>

          <div class="row mb-3">
            <label for="capacity" class="col-sm-3 col-form-label">
              <i class="fas fa-users"></i> Vehicle Capacity
            </label>
            <div class="col-sm-9">
              <input type="number" name="vehicle-capacity" id="capacity" class="form-control" placeholder="Enter Vehicle Capacity" required min="1">
            </div>
          </div>

          <div class="row mb-3">
            <label for="vehicle-image" class="col-sm-3 col-form-label">
              <i class="fas fa-image"></i> Upload Vehicle Image
            </label>
            <div class="col-sm-9">
              <input type="file" id="vehicle-image" name="photo" class="form-control" accept="image/*" required>
              <span id="file-error" style="color:red; display:none;">File size exceeds 2MB!</span>
            </div>
          </div>

          <div class="row">
            <div class="col-12 text-center">
              <button type="submit" name="submit" class="btn btn-success px-4 py-2">
                <i class="fas fa-save"></i> Save Vehicle
              </button>
            </div>
          </div>
        </form>
      </section>
      <?php
      if (isset($_POST['submit'])) {
        $category = $_POST['vehicle_category'];
        $vname = $_POST['vehicle_name'];
        $plate = $_POST['plate_number'];
        $capacity = $_POST['vehicle-capacity'];

        $imageName = $_FILES['photo']['name'];
        $imageTmp = $_FILES['photo']['tmp_name'];

        $uploadPath = "../images/" . $imageName;

        if (move_uploaded_file($imageTmp, $uploadPath)) {
          $sql = "INSERT INTO vehicles (category, name, plate, capacity, image) VALUES (:category, :vname, :plate, :capacity, :image_path)";
          $query = $dbh->prepare($sql);

          $query->bindParam(':category', $category, PDO::PARAM_STR);
          $query->bindParam(':vname', $vname, PDO::PARAM_STR);
          $query->bindParam(':plate', $plate, PDO::PARAM_STR);
          $query->bindParam(':capacity', $capacity, PDO::PARAM_STR);
          $query->bindParam(':image_path', $uploadPath, PDO::PARAM_STR);

          if ($query->execute()) {
            echo "<div class='alert alert-success mt-3'>Vehicle added to gallery successfully!</div>";
          } else {
            echo "<div class='alert alert-danger mt-3'>Error adding image to gallery. Please try again.</div>";
          }
        } else {
          echo "<div class='alert alert-danger mt-3'>Error uploading image. Please try again.</div>";
        }
      }
      ?>


      <!-- our vehicles -->
      <!-- Add this after the form for adding new images -->
      <div class="container mt-5">
        <h2 class="mb-4">Our Vehicles</h2>
        <div class="row">
          <?php
          $sql = "SELECT * FROM vehicles ORDER BY id DESC";
          $query = $dbh->prepare($sql);
          $query->execute();
          $results = $query->fetchAll(PDO::FETCH_OBJ);

          if ($query->rowCount() > 0) {
            foreach ($results as $result) {
          ?>
              <div class="col-md-4 mb-4">
                <div class="card">
                  <img src="../images/<?php echo htmlentities($result->image); ?>" class="card-img-top" alt="<?php echo htmlentities($result->category); ?>">
                  <div class="card-body">
                    <h5 class="card-title"><?php echo htmlentities($result->category); ?></h5>
                    <h5 class="card-title"><?php echo htmlentities($result->name); ?></h5>
                    <p class="card-text"><?php echo htmlentities($result->plate); ?></p>
                    <p class="card-text">Max Passengers: <?php echo htmlentities($result->capacity); ?></p>
                    <form action="managevehicles.php" method="POST">
                      <input type="hidden" name="delete_id" value="<?php echo htmlentities($result->id); ?>">
                      <button type="submit" class="btn btn-danger" name="deleteImage" onclick="return confirm('Are you sure you want to remov this vehicle?')">Delete</button>
                    </form>
                  </div>
                </div>
              </div>
          <?php
            }
          } else {
            echo "<p>No images found in the gallery.</p>";
          }
          ?>




          <?php
          if (isset($_POST['deleteImage'])) {
            $delete_id = $_POST['delete_id'];

            // First, get the image path to delete the file
            $sql = "SELECT image FROM vehicles WHERE id = :delete_id";  // Changed table name to 'vehicles'
            $query = $dbh->prepare($sql);
            $query->bindParam(':delete_id', $delete_id, PDO::PARAM_INT);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_OBJ);

            if ($result) {
              $image_path = "../images/" . $result->image;
              if (file_exists($image_path)) {
                unlink($image_path);  // Delete the image file
              }

              // Now delete the database entry
              $sql = "DELETE FROM vehicles WHERE id = :delete_id";  // Fixed table name to 'vehicles'
              $query = $dbh->prepare($sql);
              $query->bindParam(':delete_id', $delete_id, PDO::PARAM_INT);

              if ($query->execute()) {
                echo "<div class='alert alert-success mt-3'>Vehicle deleted successfully!</div>";
                echo "<script>window.location.href = 'managevehicles.php';</script>";  // Refresh page to update gallery
              } else {
                echo "<div class='alert alert-danger mt-3'>Error deleting vehicle. Please try again.</div>";
              }
            }
          }
          ?>

        </div>
      </div>



    </div>
    <script>
      document.getElementById('vehicle-image').addEventListener('change', function() {
        const file = this.files[0];
        const maxSize = 2 * 1024 * 1024; // 2MB in bytes

        if (file.size > maxSize) {
          document.getElementById('file-error').style.display = 'block';
          this.value = ''; // Clear the input if the file is too large
        } else {
          document.getElementById('file-error').style.display = 'none';
        }
      });
    </script>
    <!-- Bootstrap 5 JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
      // Toggle sidebar in mobile view
      const toggleSidebar = document.querySelector('.toggle-sidebar');
      const sidebar = document.querySelector('.sidebar');

      toggleSidebar.addEventListener('click', () => {
        sidebar.classList.toggle('active');
      });
    </script>

  </body>

  </html><?php } ?>