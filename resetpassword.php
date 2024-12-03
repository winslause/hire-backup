<?php
 session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Load Composer's autoloader for PHPMailer
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include database connection
include 'config.php';

// Function to send email using PHPMailer
function sendPasswordEmail($email, $random_password)
{
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;
        $mail->Username   = 'wenbusale383@gmail.com'; // SMTP username
        $mail->Password   = '';    // SMTP password (Use App Password for Gmail)
        $mail->SMTPSecure = 'tls';                 // Enable TLS encryption
        $mail->Port       = 587;                   // TCP port to connect to

        //Recipients
        $mail->setFrom('wenbusale383@gmail.com', 'Your Company Name');
        $mail->addAddress($email); // Add the recipient's email

        //Content
        $mail->isHTML(true);  // Set email format to HTML
        $mail->Subject = 'Your Password Reset Request';
        $mail->Body    = "Your temporary password is: <b>$random_password</b>. Please use this to reset your password.";

        $mail->send();
        return true; // Email sent
    } catch (Exception $e) {
        return false; // Email not sent
    }
}

// Handle forgot password request (generating and sending new password)
if (isset($_POST['sendresetlink'])) {
    // Get the email from the forgot password modal
    $email = $_POST['forgotpasswordemail'];

    // Check if email exists in the database using PDO
    $sql = "SELECT * FROM users WHERE email1 = :email";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        // Generate a random password
        $random_password = bin2hex(random_bytes(4)); // Generates an 8-character password
        $hashed_password = password_hash($random_password, PASSWORD_DEFAULT);

        // Update the user's password in the database
        $update_sql = "UPDATE users SET password1 = :password WHERE email1 = :email";
        $update_stmt = $dbh->prepare($update_sql);
        $update_stmt->bindParam(':password', $hashed_password, PDO::PARAM_STR);
        $update_stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $update_stmt->execute();

        // Send the random password to the user's email using PHPMailer
        if (sendPasswordEmail($email, $random_password)) {
            echo "
    <script>
        // Display the success message in the modal
        alert('An email with a new password has been sent to your email address.');

        // Show the custom reset password modal after the alert
        window.onload = function() {
            var modal = document.getElementById('resetPasswordModal');
            modal.style.display = 'block'; // Display the modal
        };
    </script>

    <!-- Custom Reset Password Modal -->
    <div id='resetPasswordModal' style='display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5);'>
        <div style='background: #28a745; margin: 100px auto; padding: 20px; width: 80%; max-width: 400px;'>
            <h4>Reset Your Password</h4>
            <form method='POST' action='resetpassword.php'>
                <label for='email'>Email</label><br>
                <input type='email' name='resetpasswordemail' id='resetpasswordemail' required><br><br>
                <label for='receivedpassword'>Received Password</label><br>
                <input type='text' name='receivedpassword' id='receivedpassword' required><br><br>
                <label for='text'>New Password</label><br>
                <input type='password' name='newpassword' id='newpassword' required><br><br>
                <button type='submit' name='resetpassword'>Submit</button>
            </form>
            <button onclick='closeModal()' style='background: red; color: white; padding: 10px;'>Close</button>
        </div>
    </div>

    <script>
        // Function to close the modal
        function closeModal() {
            var modal = document.getElementById('resetPasswordModal');
            modal.style.display = 'none'; // Hide the modal
        }
    </script>
    ";
        } else {
            echo "
    <script>
        // Display the failure message
        alert('Failed to send email. Please try again.');

        // Redirect to index.php immediately after the alert
        window.location.href = 'index.php';
    </script>
    ";
        }
    } else {
        echo "
    <script>
        // Display the error message
        alert('No user found with this email address.');

        // Redirect to index.php immediately after the alert
        window.location.href = 'index.php';
    </script>
    ";
    }
}

// Handle reset password request (resetting to a new password)
if (isset($_POST['resetpassword'])) {
    // Get email, received password (from email), and new password from reset password modal
    $email = $_POST['resetpasswordemail'];
    $received_password = $_POST['receivedpassword'];
    $new_password = $_POST['newpassword'];

    // Check if the email exists in the database using PDO
    $sql = "SELECT * FROM users WHERE email1 = :email";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Verify the received password matches the hashed password in the database
        if (password_verify($received_password, $user['password1'])) {
            // Hash the new password
            $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Update the password in the database
            $update_sql = "UPDATE users SET password1 = :password WHERE email1 = :email";
            $update_stmt = $dbh->prepare($update_sql);
            $update_stmt->bindParam(':password', $hashed_new_password, PDO::PARAM_STR);
            $update_stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $update_stmt->execute();

            echo "
    <script>
        // Display the success message
        alert('Your password has been successfully updated!  You can now login.');
        
        // Immediately redirect to index.php
        window.location.href = 'index.php';
    </script>
    ";
        } else {
            
            echo "
    <script>
        // Display the success message in the modal
        alert('The password you entered does not match the password received from the email.');

        // Show the custom reset password modal after the alert
        window.onload = function() {
            var modal = document.getElementById('resetPasswordModal');
            modal.style.display = 'block'; // Display the modal
        };
    </script>

    <!-- Custom Reset Password Modal -->
    <div id='resetPasswordModal' style='display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5);'>
        <div style='background: #28a745; margin: 100px auto; padding: 20px; width: 80%; max-width: 400px;'>
            <h4>Reset Your Password</h4>
            <form method='POST' action='resetpassword.php'>
                <label for='email'>Email</label><br>
                <input type='email' name='resetpasswordemail' id='resetpasswordemail' required><br><br>
                <label for='receivedpassword'>Received Password</label><br>
                <input type='text' name='receivedpassword' id='receivedpassword' required><br><br>
                <label for='text'>New Password</label><br>
                <input type='password' name='newpassword' id='newpassword' required><br><br>
                <button type='submit' name='resetpassword'>Submit</button>
            </form>
            <button onclick='closeModal()' style='background: red; color: white; padding: 10px;'>Close</button>
        </div>
    </div>

    <script>
        // Function to close the modal
        function closeModal() {
            var modal = document.getElementById('resetPasswordModal');
            modal.style.display = 'none'; // Hide the modal
        }
    </script>
    ";
        }
    } else {
        echo "
    <script>
        // Display the error message
        alert('No user found with this email address.');

        // Redirect to index.php immediately after the alert
        window.location.href = 'index.php';
    </script>
    ";
    }
}
