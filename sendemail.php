<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database configuration
include 'config.php';  // This includes your DB connection settings

// Import PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include Composer's autoloader
require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $name = $_POST['name'];
    $email = $_POST['email'];  // Sender's email from the form
    $message = $_POST['message'];

    // Validate inputs
    if (!empty($name) && !empty($email) && !empty($message)) {

        try {
            // Use the PDO connection defined in config.php
            // Assuming $pdo is already initialized in config.php

            // Insert the form data into the database
            $sql = "INSERT INTO form_submissions (name, email, message) VALUES (:name, :email, :message)";
            $stmt = $dbh->prepare($sql);
            $stmt->execute(['name' => $name, 'email' => $email, 'message' => $message]);

            // Send email using PHPMailer
            $mail = new PHPMailer(true);

            try {
                // Server settings
                $mail->SMTPDebug = 0;                               // Disable verbose debug output
                $mail->isSMTP();                                    // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';                     // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                             // Enable SMTP authentication
                $mail->Username = 'wenbusale383@gmail.com';         // Your company email address
                $mail->Password = 'bfmd neqb ltiv txrp';            // App Password (or regular password if no 2FA)
                $mail->SMTPSecure = 'tls';                          // Enable TLS encryption
                $mail->Port = 587;                                  // TCP port to connect to

                // Set the sender's email from the form (customer's email)
                $mail->setFrom($email, $name);                      // Customer's email and name

                // Set receiver's email (your company email)
                $mail->addAddress('wenbusale383@gmail.com');         // Receiver's email (you)

                // Content
                $mail->isHTML(true);                                // Set email format to HTML
                $mail->Subject = 'New email from your website';

                // Styled HTML email content
                $mail->Body = "
                    <html>
                    <head>
                        <style>
                            body {
                                font-family: Arial, sans-serif;
                                font-size: 24px;
                                line-height: 1.6;
                                margin: 0;
                                padding: 0;
                                background-color: #f4f4f4;
                            }
                            .email-container {
                                max-width: 90%;
                                margin: 20px auto;
                                padding: 20px;
                                background-color: #fff;
                                border-radius: 10px;
                                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                            }
                            h1 {
                                font-size: 24px;
                                margin-bottom: 20px;
                            }
                            p {
                                font-size: 24px;
                                margin-bottom: 10px;
                            }
                            .email-footer {
                                font-size: 24px;
                                color: #888;
                                text-align: center;
                                margin-top: 30px;
                            }
                        </style>
                    </head>
                    <body>
                        <div class='email-container'>
                            <h1>New Message from Your Website</h1>
                            <p><strong>Name:</strong> $name</p>
                            <p><strong>Email:</strong> $email</p>
                            <p><strong>Message:</strong><br> $message</p>
                        </div>
                        <div class='email-footer'>
                            <p>This email was sent by a client from your website.</p>
                        </div>
                    </body>
                    </html>
                ";

                // Send the email
                $mail->send();
                echo '<script>alert("Email Message has been sent!")</script>';
                echo '<script>window.location.href = "index.php";</script>';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } catch (PDOException $e) {
            echo "Database Error: " . $e->getMessage();
        }
    } else {
        echo "All fields are required.";
    }
}
