<?php
  // Connect to database
  $conn = mysqli_connect("localhost", "root", "", "online_banking");

  // Check if connection is successful
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }

  // Get account number and activate flag value from AJAX request
  $accNo = $_POST['account_number'];
  $activateFlag = $_POST['activate_flag'];

  // Update activate_flag value in user_application_table
  $sql = "UPDATE user_application_table SET activate_flag = '$activateFlag' WHERE account_number = '$accNo'";
  if (mysqli_query($conn, $sql)) {
      echo "Record updated successfully";
  } else {
      echo "Error updating record: " . mysqli_error($conn);
  }

  // Close database connection
  mysqli_close($conn);
?>
