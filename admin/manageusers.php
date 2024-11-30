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

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
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
      <!-- manage clients -->
      <section id="our-clients" class="container mt-5">
        <h2 class="text-center mb-4">Manage Resgistered users</h2>
        <!-- <p>These messages have already been mailed to you</p> -->

        <!-- Table for Bookings -->
        <!-- Table for Bookings -->
        <div class="table-responsive">
          <table id="bookingsTable" class="table table-striped table-bordered table-hover">
            <thead class="thead-dark">
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $sql = "SELECT * FROM users";
              $query = $dbh->prepare($sql);
              $query->execute();
              $results = $query->fetchAll(PDO::FETCH_OBJ);
              $cnt = 1;
              if ($query->rowCount() > 0) {
                foreach ($results as $result) { ?>
                  <tr>
                    <td><?php echo htmlentities($cnt); ?></td>
                    <td><?php echo htmlentities($result->fname); ?></td>
                    <td><?php echo htmlentities($result->email1); ?></td>
                    <td><?php echo htmlentities($result->phone1); ?></td>
                    <td>
                      <a style="margin: 5px;" href="manageusers.php?delete_id=<?php echo htmlentities($result->id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this message?')">Delete</a>
                    </td>
                  </tr>
              <?php $cnt = $cnt + 1;
                }
              } ?>
            </tbody>
          </table>
        </div>

      </section>
      <?php
      if (isset($_GET['delete_id'])) {
        $delete_id = $_GET['delete_id'];
        $sql = "DELETE FROM users WHERE id = :delete_id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':delete_id', $delete_id, PDO::PARAM_INT);
        $query->execute();

        if ($query->rowCount() > 0) {
          $msg = "User deleted successfully";
          echo "<script>window.location.href = 'manageusers.php';</script>";  // Refresh page to update gallery
        } else {
          $error = "Something went wrong. Please try again";
        }
      }


      ?>



    </div>
    <!-- Initialize DataTables -->
    <script>
      $(document).ready(function() {
        $('#bookingsTable').DataTable({
          "paging": true, // Enable pagination
          "pageLength": 10, // Records per page
          "lengthChange": true, // Allow changing number of records per page
          "searching": true, // Enable search/filter
          "ordering": true, // Enable column sorting
          "info": true, // Display table information
          "autoWidth": false // Disable auto-width to ensure proper sizing
        });
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

  </html><?php } ?>