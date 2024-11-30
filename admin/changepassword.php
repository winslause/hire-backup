<?php
session_start();
error_reporting(0);
include('config.php');
if (strlen($_SESSION['alogin']) == 0) {
  header('location:index.php');
} else {
  if (isset($_POST['change_password'])) {
    $admin_id = $_SESSION['alogin'];
    $current_password = $_POST['currentPassword'];
    $new_password = $_POST['newPassword'];
    $confirm_password = $_POST['confirmPassword'];

    // Verify current password
    $sql = "SELECT password FROM admin WHERE username = :admin_id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':admin_id', $admin_id, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_OBJ);

    if ($current_password == $result->password) {
      if ($new_password == $confirm_password) {
        $sql = "UPDATE admin SET password = :new_password WHERE username = :admin_id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':new_password', $new_password, PDO::PARAM_STR);
        $query->bindParam(':admin_id', $admin_id, PDO::PARAM_STR);
        $query->execute();

        echo "<script>alert('Password changed successfully');</script>";
        echo "<script>window.location.href='home.php'</script>";
      } else {
        echo "<script>alert('New password and confirm password do not match');</script>";
      }
    } else {
      echo "<script>alert('Current password is incorrect');</script>";
    }
  }
}
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

    <!-- MAIN CONTENT -->
    <main class="content px-3 py-2" style="width:100%; left:0px;">
      <div class="container-fluid" style=" display:block; text-align: center;">
        <div class="mb-3">
          <h1>Change Password</h1>
        </div>
      </div>

      <div class="container mt-4">
        <div class="row">
          <div class="col-md-6 offset-md-3">
            <form action="changepassword.php" method="POST">
              <div class="mb-3">
                <label for="currentPassword" class="form-label">Current Password</label>
                <input type="password" class="form-control" id="currentPassword" name="currentPassword" required>
              </div>
              <div class="mb-3">
                <label for="newPassword" class="form-label">New Password</label>
                <input type="password" class="form-control" id="newPassword" name="newPassword" required>
              </div>
              <div class="mb-3">
                <label for="confirmPassword" class="form-label">Confirm New Password</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
              </div>
              <button type="submit" class="btn btn-primary" name="change_password">Change Password</button>
            </form>
          </div>
        </div>
      </div>
    </main>


  </div>

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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Enable tooltips
    document.addEventListener('DOMContentLoaded', function() {
      var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
      tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
      });
    });
  </script>


</body>

</html>