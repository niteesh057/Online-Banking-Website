<?php
    session_start();
?>
<?php
    if (!isset($_SESSION['account_number'])) {
        header('Location: login.php');
        exit();
    }
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "online_banking";
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    $account_number =  $_SESSION['account_number'];

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }else{
        $stmt = mysqli_prepare($conn, "SELECT account_bal, no_of_transactions FROM user_application_table WHERE account_number = ?");
        mysqli_stmt_bind_param($stmt, "i", $account_number);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        $account_bal = $row['account_bal'];
        $no_of_transactions = $row['no_of_transactions'];
    }

    // Check if form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // Get the account number and amount from the form
        $to_account_number = $_POST['account_number'];
        $amount = $_POST['amount'];

        // Check if the account number exists in the user_application_table
        $stmt = mysqli_prepare($conn, "SELECT * FROM user_application_table WHERE account_number = ?");
        mysqli_stmt_bind_param($stmt, "i", $to_account_number);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        if (!$row) {
            // Display an error message if the account number doesn't exist
            echo "<script>alert('The account number you entered does not exist. Please try again.')</script>";
        }else{
            // Deduct the amount from the logged-in user's account balance
            $new_account_bal = $account_bal - $amount;

            // Update the user_accounts table with the new account balance
            $stmt = mysqli_prepare($conn, "UPDATE user_application_table SET account_bal = ? WHERE account_number = ?");
            mysqli_stmt_bind_param($stmt, "ii", $new_account_bal, $account_number);
            mysqli_stmt_execute($stmt);
            
            // Add the amount to the recipient's account balance
            $stmt = mysqli_prepare($conn, "SELECT account_bal FROM user_application_table WHERE account_number = ?");
            mysqli_stmt_bind_param($stmt, "i", $to_account_number);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_assoc($result);
            $to_account_bal = $row['account_bal'] + $amount;
            $stmt = mysqli_prepare($conn, "UPDATE user_application_table SET account_bal = ? WHERE account_number = ?");
            mysqli_stmt_bind_param($stmt, "ii", $to_account_bal, $to_account_number);
            mysqli_stmt_execute($stmt);

            
            // generate unique 13 digit transaction ID
            function generate_transaction_id($conn) {
                // generate random 13 digit number
                $transaction_id = strval(rand(1000000000000, 9999999999999));
                // check if transaction ID already exists in database
                $query = "SELECT COUNT(*) AS count FROM transaction_table WHERE transaction_id = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("s", $transaction_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                // if transaction ID already exists, generate new one
                if ($row['count'] > 0) {
                    return generate_transaction_id($conn);
                } else {
                    return $transaction_id;
                }
            }
            // Add the transaction to the transaction table
            $transaction_id = generate_transaction_id($conn);
            $date_time = date('Y-m-d H:i:s');
            $stmt = mysqli_prepare($conn, "INSERT INTO transaction_table (transaction_id, account_number, amount, to_account_number, date_time) VALUES (?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($stmt, "siiis", $transaction_id, $account_number, $amount, $to_account_number, $date_time);
            mysqli_stmt_execute($stmt);

            // Increment the no_of_transactions for the logged-in user
            $new_no_of_transactions = $no_of_transactions + 1;
            $stmt = mysqli_prepare($conn, "UPDATE user_application_table SET no_of_transactions = ? WHERE account_number = ?");
            mysqli_stmt_bind_param($stmt, "ii", $new_no_of_transactions, $account_number);
            mysqli_stmt_execute($stmt);

            $stmt = mysqli_prepare($conn, "SELECT no_of_transactions FROM user_application_table WHERE account_number = ?");
            mysqli_stmt_bind_param($stmt, "i", $to_account_number);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_assoc($result);
            $no_of_transactions = $row['no_of_transactions'];
            // Increment the no_of_transactions for the logged-in user
            $new_no_of_transactions = $no_of_transactions + 1;
            $stmt = mysqli_prepare($conn, "UPDATE user_application_table SET no_of_transactions = ? WHERE account_number = ?");
            mysqli_stmt_bind_param($stmt, "ii", $new_no_of_transactions, $to_account_number);
            mysqli_stmt_execute($stmt);


            // show success message
            echo "Money added successfully!";
            sleep(3); // wait for 3 seconds
            header("Location: userpage.php"); // redirect the user to the dashboard
            exit();
        }
    }
?>


