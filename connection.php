<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "wieg16";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];

$sql = "INSERT INTO curl (firstname, lastname) 
VALUES ('$firstname', '$lastname')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
