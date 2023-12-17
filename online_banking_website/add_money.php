<?php

    // connect to the database
    $conn = mysqli_connect("localhost", "root", "", "online_banking");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // get the account number and amount from the form submission
        $to_accountNumber = $_POST['accountNumber'];
        $amount = $_POST['amount'];

        // check if account number exists in user_application_table
        $account_number = 10001;
        $stmt = mysqli_prepare($conn, "SELECT COUNT(*) FROM user_application_table WHERE account_number = ? AND activate_flag = 'Y'");
        mysqli_stmt_bind_param($stmt, "i", $account_number);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $count = mysqli_fetch_assoc($result);
        // if account number does not exist, display an error message
        if ($count == 0) {
            echo "Error: Account number does not exist or is not activated.";
            exit();
        }
        // update the amount_bal column for the user
        $sql = "UPDATE user_application_table SET account_bal = account_bal + $amount WHERE account_number = '$to_accountNumber'";
        mysqli_query($conn, $sql);
        
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
        mysqli_stmt_bind_param($stmt, "siiis", $transaction_id, $account_number, $amount, $to_accountNumber, $date_time);
        mysqli_stmt_execute($stmt);


        $stmt = mysqli_prepare($conn, "SELECT no_of_transactions FROM user_application_table WHERE account_number = ?");
        mysqli_stmt_bind_param($stmt, "i", $to_accountNumber);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        $no_of_transactions = $row['no_of_transactions'];
        // Increment the no_of_transactions for the logged-in user
        $new_no_of_transactions = $no_of_transactions + 1;
        $stmt = mysqli_prepare($conn, "UPDATE user_application_table SET no_of_transactions = ? WHERE account_number = ?");
        mysqli_stmt_bind_param($stmt, "ii", $new_no_of_transactions, $to_accountNumber);
        mysqli_stmt_execute($stmt);

        // close the database connection
        mysqli_close($conn);

        // show success message
        echo "Money added successfully!";
        sleep(3); // wait for 3 seconds
        header("Location: admin.php"); // redirect the user to the dashboard
        exit();
    }
    
?>
