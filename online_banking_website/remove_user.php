<?php
// Establish database connection
$conn = mysqli_connect("localhost", "root", "", "online_banking");

// Check if connection is successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get account number from POST data
$accountNumber = $_POST['account_number'];

// Remove user from user_application_table where account_number matches
$sql = "DELETE FROM user_application_table WHERE account_number = '$accountNumber'";
if (mysqli_query($conn, $sql)) {
    echo "User removed successfully";
} else {
    echo "Error removing user: " . mysqli_error($conn);
}

// Close database connection
mysqli_close($conn);
?>
