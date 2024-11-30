<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Full-screen height with btn-success background */
    body {
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: #28a745;
      /* btn-success background */
    }

    /* Centered login form */
    .login-container {
      background-color: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 400px;
    }

    /* Form input styles */
    .form-control {
      margin-bottom: 15px;
    }

    .text-center {
      margin-bottom: 20px;
    }
  </style>
</head>

<body>
  <?php
  session_start();
  include('config.php');
  if (isset($_POST['submit'])) {
    $email = $_POST['name'];
    $password = $_POST['password'];
    $sql = "SELECT username,password FROM admin WHERE username=:email and password=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
      $_SESSION['alogin'] = $_POST['name'];
      echo "<script type='text/javascript'> document.location = 'home.php'; </script>";
    } else {

      echo "<script>alert('Invalid Details');</script>";
    }
  }

  ?>

  <!-- admin Login Form Container -->
  <div class="login-container">
    <h3 class="text-center">Admin Sign In</h3>
    <form action="index.php" method="POST">
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" name="name" class="form-control" id="username" placeholder="Enter username" required>
      </div>
      <!-- Password Input with Eye Icon -->
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <div class="input-group">
          <input type="password" name="password" class="form-control" id="password" placeholder="Enter password" required>
          <span class="input-group-text" style="cursor: pointer; height: 37px;" onclick="togglePasswordVisibility('password', 'password-eye')">
            <i id="password-eye" class="fas fa-eye"></i>
          </span>
        </div>
      </div>
      <div class="d-grid gap-2">
        <button type="submit" name="submit" class="btn btn-success">Submit</button>
        <center>
          <p>Back <a href="../index.php">Home</a></p>
        </center>
      </div>
    </form>
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
  </script>
  <!-- Font Awesome CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <!-- Bootstrap 5 JS and dependencies (Popper, etc.) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>