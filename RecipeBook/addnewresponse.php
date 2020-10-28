<?php
$servername = "localhost";
$username = "azure";
$password = "6#vWHD_$";
$dbname = "localdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

$sql = "INSERT INTO recipe (RecipeName, Servings, PreparationTime, Ratings)
VALUES ('Pumpkin Coffee', '2', '30', '5')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?> 