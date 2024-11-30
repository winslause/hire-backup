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
        <h2 class="text-center mb-4">Our Client Booking Record</h2>

        <!-- Table for Bookings -->
        <div class="table-responsive">
          <h4><u>Unconfirmed Bookings</u></h4>

          <!-- Filter and Sort Form -->
          <!-- <div class="d-flex mb-3 align-items-center">
            <form method="get" action="managebookings.php" class="form-inline d-flex" style="padding: 10px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); max-width: 600px; margin-bottom: 20px; background-color: #f9f9f9; border-radius: 8px;"> -->
          <!-- 'Show' Dropdown -->
          <!-- <label for="records" class="mr-2" style="margin-right: 10px;">Filter</label>
              <select name="records" id="records" class="form-control" style="width: 100px; margin-right: 20px; padding: 5px;">
                <option value="5" <?php if (isset($_GET['records']) && $_GET['records'] == 5) echo 'selected'; ?>>5</option>
                <option value="10" <?php if (isset($_GET['records']) && $_GET['records'] == 10) echo 'selected'; ?>>10</option>
                <option value="50" <?php if (isset($_GET['records']) && $_GET['records'] == 50) echo 'selected'; ?>>50</option>
                <option value="100" <?php if (isset($_GET['records']) && $_GET['records'] == 100) echo 'selected'; ?>>100</option>
                <option value="all" <?php if (isset($_GET['records']) && $_GET['records'] == 'all') echo 'selected'; ?>>More than 100</option>
              </select> -->

          <!-- 'Order By' Dropdown -->
          <!-- <label for="order" class="mr-2" style="margin-right: 10px;">Order By</label>
              <select name="order" id="order" class="form-control" style="width: 120px; margin-right: 20px; padding: 5px;">
                <option value="desc" <?php if (isset($_GET['order']) && $_GET['order'] == 'desc') echo 'selected'; ?>>New First</option>
                <option value="asc" <?php if (isset($_GET['order']) && $_GET['order'] == 'asc') echo 'selected'; ?>>Older First</option>
              </select> -->

          <!-- Apply Button -->
          <!-- <button type="submit" class="btn btn-success" style="padding: 5px 10px;">Apply</button>
            </form>
          </div> -->

          <!-- Table Structure -->
          <table id="bookingsTable" class="table table-striped table-bordered table-hover">
            <thead class="thead-dark">
              <tr style="font-size: 14px; ">
                <th>#</th>
                <th>Client Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>ID Number</th>
                <th>Date to be Picked</th>
                <th>Location</th>
                <th>Date/Time to be Returned</th>
                <th>Type of service</th>
                <th>Vehicle</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              // Set default values
              $order = isset($_GET['order']) ? $_GET['order'] : 'desc';

              // Fetch all bookings without limit since DataTables handles pagination
              $sql = "SELECT * FROM booking WHERE confirm = 0 ORDER BY id $order";
              $query = $dbh->prepare($sql);
              $query->execute();
              $results = $query->fetchAll(PDO::FETCH_OBJ);
              $cnt = 1;

              if ($query->rowCount() > 0) {
                foreach ($results as $result) { ?>
                  <tr style="font-size: 14px; ">
                    <td><?php echo htmlentities($cnt); ?></td>
                    <td><?php echo htmlentities($result->name1); ?></td>
                    <td><?php echo htmlentities($result->email1); ?></td>
                    <td><?php echo htmlentities($result->phone1); ?></td>
                    <td><?php echo htmlentities($result->idnumber); ?></td>
                    <td><?php echo htmlentities($result->pickdate); ?></td>
                    <td><?php echo htmlentities($result->picklocation); ?></td>
                    <td><?php echo htmlentities($result->returnd); ?></td>
                    <td><?php echo htmlentities($result->vehicle); ?></td>
                    <td><?php echo htmlentities($result->vname1); ?></td>
                    <td>
                      <a title="Confirm the booking is completed" style="margin: 5px;" class="btn btn-warning btn-sm"
                        href="managebookings.php?edit_id=<?php echo htmlentities($result->id); ?>">
                        Confirm
                      </a>

                      <a title="Cancel and remove this booking" style="margin: 5px;" href="managebookings.php?delete_id=<?php echo htmlentities($result->id); ?>"
                        class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to cancel and remove this booking?')">
                        Delete
                      </a>
                    </td>
                  </tr>
              <?php $cnt = $cnt + 1;
                }
              } ?>
            </tbody>
          </table>
        </div>





        <!-- Table for Bookings -->
        <div class="table-responsive">
          <h5><u>Confirmed Bookings</u></h5>
          <!-- Filter and Sort Form -->
          <!-- <div class="d-flex mb-3 align-items-center">
            <form method="get" action="managebookings.php" class="form-inline d-flex" style="padding: 10px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); max-width: 600px; margin-bottom: 20px; background-color: #f9f9f9; border-radius: 8px;"> -->
          <!-- 'Show' Dropdown -->
          <!-- <label for="records" class="mr-2" style="margin-right: 10px;">Filter</label>
              <select name="records" id="records" class="form-control" style="width: 100px; margin-right: 20px; padding: 5px;">
                <option value="5" <?php if (isset($_GET['records']) && $_GET['records'] == 5) echo 'selected'; ?>>5</option>
                <option value="10" <?php if (isset($_GET['records']) && $_GET['records'] == 10) echo 'selected'; ?>>10</option>
                <option value="50" <?php if (isset($_GET['records']) && $_GET['records'] == 50) echo 'selected'; ?>>50</option>
                <option value="100" <?php if (isset($_GET['records']) && $_GET['records'] == 100) echo 'selected'; ?>>100</option>
                <option value="all" <?php if (isset($_GET['records']) && $_GET['records'] == 'all') echo 'selected'; ?>>More than 100</option>
              </select> -->

          <!-- 'Order By' Dropdown -->
          <!-- <label for="order" class="mr-2" style="margin-right: 10px;">Order By</label>
              <select name="order" id="order" class="form-control" style="width: 120px; margin-right: 20px; padding: 5px;">
                <option value="desc" <?php if (isset($_GET['order']) && $_GET['order'] == 'desc') echo 'selected'; ?>>New First</option>
                <option value="asc" <?php if (isset($_GET['order']) && $_GET['order'] == 'asc') echo 'selected'; ?>>Older First</option>
              </select> -->

          <!-- Apply Button -->
          <!-- <button type="submit" class="btn btn-primary" style="padding: 5px 10px;">Apply</button>
            </form> -->
          <!-- </div> -->

          <!-- Table Section -->
          <div class="container mt-5">
            <!-- Table Structure with Unique ID -->
            <table id="uniqueBookingsTable" class="table table-striped table-bordered table-hover">
              <thead class="thead-dark">
                <tr style="font-size: 14px;">
                  <th>#</th>
                  <th>Client Name</th>
                  <th>Email</th>
                  <th>Phone Number</th>
                  <th>ID Number</th>
                  <th>Date to be Picked</th>
                  <th>Location</th>
                  <th>Date/Time to be Returned</th>
                  <th>Type of service</th>
                  <th>Vehicle</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <!-- PHP Backend to Handle Data Fetching with Filters -->
                <?php
                // Fetch and apply the filters
                $limit = isset($_GET['records']) ? $_GET['records'] : 10;  // Default limit to 10
                $order = isset($_GET['order']) ? $_GET['order'] : 'desc';   // Default order to newest first

                // Adjust the SQL query based on the filters
                $sql = "SELECT * FROM booking WHERE confirm = 1 ORDER BY pickdate $order";

                // Check if a limit is set
                if ($limit != 'all') {
                  $sql .= " LIMIT :limit";
                }

                // Prepare and execute the query
                $query = $dbh->prepare($sql);
                if ($limit != 'all') {
                  $query->bindParam(':limit', $limit, PDO::PARAM_INT);
                }
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                $cnt = 1;

                // Check if there are results
                if ($query->rowCount() > 0) {
                  foreach ($results as $result) { ?>
                    <tr style="font-size: 14px; ">
                      <td><?php echo htmlentities($cnt); ?></td>
                      <td><?php echo htmlentities($result->name1); ?></td>
                      <td><?php echo htmlentities($result->email1); ?></td>
                      <td><?php echo htmlentities($result->phone1); ?></td>
                      <td><?php echo htmlentities($result->idnumber); ?></td>
                      <td><?php echo htmlentities($result->pickdate); ?></td>
                      <td><?php echo htmlentities($result->picklocation); ?></td>
                      <td><?php echo htmlentities($result->returnd); ?></td>
                      <td><?php echo htmlentities($result->vehicle); ?></td>
                      <td><?php echo htmlentities($result->vname1); ?></td>
                      <td>
                        <a title=" Remove this booking" style="margin: 5px;" href="managebookings.php?delete_id=<?php echo htmlentities($result->id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to Remove this booking?')">Delete</a>
                      </td>
                    </tr>
                <?php $cnt++;
                  }
                } ?>
              </tbody>
            </table>
          </div>
        </div>







      </section>

      <?php
      if (isset($_GET['edit_id'])) {
        $edit_id = $_GET['edit_id'];  // Use 'edit_id' here
        $con = 1;  // Confirmation status

        // Update the 'confirm' column in the 'booking' table for the booking with the given id
        $query = "UPDATE booking SET confirm = :con WHERE id = :edit_id";  // Use 'id' instead of 'user_id'
        $updateQuery = $dbh->prepare($query);  // Prepare the correct query
        $updateQuery->bindParam(':edit_id', $edit_id, PDO::PARAM_INT);  // Bind the correct id (booking id)
        $updateQuery->bindParam(':con', $con, PDO::PARAM_INT);  // Bind the confirmation status

        if ($updateQuery->execute()) {
          // Redirect to 'managebookings.php' after successful update
          echo "<script>
                window.location.href = 'managebookings.php';
              </script>";
        } else {
          // Handle errors more specifically
          $errorInfo = $updateQuery->errorInfo();
          echo "Error updating confirmation: " . $errorInfo[2];
        }
      }
      ?>



      <?php
      if (isset($_GET['delete_id'])) {
        $delete_id = $_GET['delete_id'];
        $sql = "DELETE FROM booking WHERE id = :delete_id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':delete_id', $delete_id, PDO::PARAM_INT);
        $query->execute();

        if ($query->rowCount() > 0) {
          $msg = "Deleted successfully";
          echo "<script>
        window.location.href = 'managebookings.php';
      </script>";
        } else {
          $error = "Something went wrong. Please try again";
        }
      }


      ?>

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

    <!-- DataTables Initialization -->
    <script>
      $(document).ready(function() {
        $('#bookingsTable').DataTable({
          "pageLength": 10, // Number of records per page
          "ordering": true, // Enable sorting
          "order": [
            [0, 'asc']
          ], // Set default sort order
          "searching": true, // Enable searching
          "lengthMenu": [5, 10, 25, 50, 100] // Set available page size options
        });
      });
    </script>

    <!-- DataTables Initialization with Unique Table ID -->
    <script>
      $(document).ready(function() {
        $('#uniqueBookingsTable').DataTable({
          "pageLength": 10, // Number of records per page
          "ordering": true, // Enable sorting
          "order": [
            [5, 'desc']
          ], // Set default sort order (column index starts at 0; here, 'pickdate' column)
          "searching": true, // Enable searching
          "lengthMenu": [5, 10, 25, 50, 100], // Set available page size options
          "columnDefs": [{
              "orderable": false,
              "targets": 10
            } // Disable ordering for the "Actions" column
          ]
        });
      });
    </script>
  </body>

  </html><?php } ?>