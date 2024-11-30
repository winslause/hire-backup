<?php
require_once("config.php");

// Check if email is provided
if (!empty($_POST["emailid"])) {
    $email = $_POST["emailid"];

    // Validate the email format
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        echo "error: You did not enter a valid email.";
    } else {
        // Query to check if email exists in the database
        $sql = "SELECT email1 FROM users WHERE email1 = :email";
        $query = $dbh->prepare($sql);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        if ($query->rowCount() > 0) {
            // If email exists
            echo "<span style='color:red'> Email already exists.</span>";
            echo "<script>$('#submit').prop('disabled', true);</script>";
        } else {
            // If email doesn't exist
            echo "<span style='color:green'> Email available for registration.</span>";
            echo "<script>$('#submit').prop('disabled', false);</script>";
        }
    }
}
