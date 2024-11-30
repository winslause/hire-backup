<?php
session_start();
include('config.php');


if (isset($_POST['login'])) {
    // Get form data
    $email = $_POST['emaillogin'];
    $password = $_POST['passlogin'];

    // Prepare SQL query to select the user based on the email
    $sql = "SELECT email1, password1 FROM users WHERE email1 = :email";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();

    // Check if email exists in the database
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Verify if the entered password matches the hashed password stored in the database
        if (password_verify($password, $user['password1'])) {
            // Set session variable on successful login
            $_SESSION['login'] = $email;
            $_SESSION['user'] = $user['email1'];
            // Alert the user and redirect
            echo "<script>
                    alert('You are logged in!');
                    window.location.href = 'index.php'; // Redirect after alert
                  </script>";
            exit;
        } else {
            $error = "Invalid password. Please try again.";
            echo "<script>
                    alert('Invalid password. Please try again!');
                    window.location.href = 'index.php'; // Redirect after alert
                  </script>";
        }
    } else {
        echo "<script>
                    alert('email or password is incorrect. Please try again or create an account');
                    window.location.href = 'index.php'; // Redirect after alert
                  </script>";
    }
}
?>

<!-- Displaying the error message if login fails -->
<?php if (isset($error)): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>


<?php
// Check if the form has been submitted
if (isset($_POST['book'])) {
    // Retrieve form data from the POST request
    $name2 = $_POST['name7'];
    $email3 = $_POST['email7'];
    $phone2 = $_POST['phone7'];
    $idnumber2 = $_POST['idnumber'];
    $ptime = $_POST['ptime'];
    $pickup = $_POST['pickup'];
    $dreturn = $_POST['dreturn'];
    $vtype = $_POST['vtype'];
    $nvehicle = $_POST['vehclename'];

    // Prepare SQL query to insert data into the booking table
    $sql = "INSERT INTO booking (name1, email1, phone1, idnumber, pickdate, picklocation, returnd, vehicle, vname1) 
            VALUES (:name2, :email3, :phone2, :idnumber2, :ptime, :pickup, :dreturn, :vtype, :nvehicle)";

    // Prepare the statement
    $query = $dbh->prepare($sql);
    // Bind parameters
    $query->bindParam(':name2', $name2, PDO::PARAM_STR);
    $query->bindParam(':email3', $email3, PDO::PARAM_STR);
    $query->bindParam(':phone2', $phone2, PDO::PARAM_STR);
    $query->bindParam(':idnumber2', $idnumber2, PDO::PARAM_STR);
    $query->bindParam(':ptime', $ptime, PDO::PARAM_STR);
    $query->bindParam(':pickup', $pickup, PDO::PARAM_STR);
    $query->bindParam(':dreturn', $dreturn, PDO::PARAM_STR);
    $query->bindParam(':vtype', $vtype, PDO::PARAM_STR);
    $query->bindParam(':nvehicle', $nvehicle, PDO::PARAM_STR);

    // Execute the query
    if ($query->execute()) {
        // If the data was successfully inserted, display a success message
        echo "<script>alert('Your booking was successful!');</script>";
        echo "<script>window.location.href = 'index.php';</script>";
    } else {
        // If there was an error, display an error message
        echo "Error: Could not save booking.";
    }
}
?>