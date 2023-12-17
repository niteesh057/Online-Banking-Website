<?php
// connect to the database
$conn = mysqli_connect("localhost", "root", "", "online_banking");

// check if connection is successful
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// get the account number from the request
$accountNumber = $_GET["account_number"];

// update the activate_flag in the database
$sql = "UPDATE user_application_table SET activate_flag = 'N' WHERE account_number = '$accountNumber'";
$result = mysqli_query($conn, $sql);

// close the database connection
mysqli_close($conn);
?>
