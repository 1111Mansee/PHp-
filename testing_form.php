CREATE TABLE contact_form (
    id INT AUTO_INCREMENT PRIMARY KEY,
    phone_number VARCHAR(20) NOT NULL,
    email VARCHAR(255) NOT NULL,
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    submission_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);





<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    
    if (empty($name) || empty($email) || empty($message)) {
        echo "Error: Please fill in all fields.";
    } else {
        
        $conn = new mysqli("localhost", "username", "password", "database_name");
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "INSERT INTO contact_form (name, email, message) VALUES ('$name', '$email', '$message')";
        
        if ($conn->query($sql) === TRUE) {
            
            $to = "owner@example.com";
            $subject = "New Form Submission";
            $message = "Name: $name\nEmail: $email\nMessage: $message";
            mail($to, $subject, $message);
            
            echo "Success: Form submitted successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
        $conn->close();
    }
}
?>