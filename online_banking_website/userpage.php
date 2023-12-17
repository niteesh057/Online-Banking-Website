<?php
session_start();
if (!isset($_SESSION['name']) || !isset($_SESSION['account_number'])) {
    header("Location: login.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
    <!-- favicon -->
    <link rel="icon" href="https://res.cloudinary.com/dwficcf7f/image/upload/v1681638409/mybank_tkz6wk.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        .transactionData {
            position: absolute;
            top: 50%;
            left: 20%;
            width: 60%;
            background-color: antiquewhite;
            border-radius: 6px;
            padding: 15px;
        }
        .popupBody {
            display: flex;
            justify-content: center;
            position: absolute;
            top: 10%;
            left: 5%;
            right: 5%;
        }
        .popUp {
            padding: 40px;
            background-color: yellow;
            border-radius: 6px;
            margin: 60px;
        }

        .mainLabel {
            display: flex;
            justify-content: center;
            size: 10px;
            font-size: x-large;
            font-weight: 800;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        }

        .navbar {
            background-color: black;
            height: 60px;
        }

        .userName {
            position: absolute;
            right: 20px;
            top: 20px;
            color: aliceblue;
            cursor: pointer;
        }

        .bankName {
            position: absolute;
            top: 20px;
            left: 110px;
            color: aliceblue;
        }

        .align-top {
            position: absolute;
            left: 70px;
            top: 15px;
        }

        body {
            background-color: rgb(88, 87, 73);
            font-family: "Lato", sans-serif;

        }

        .sidenav {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 60px;
            left: 0;
            background-color: #111;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 10px;
        }

        .sidenav a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 20px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }

        .sidenav a:hover {
            color: #f1f1f1;
        }

        .sidenav .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }

        @media screen and (max-height: 450px) {
            .sidenav {
                padding-top: 15px;
            }

            .sidenav a {
                font-size: 15px;
            }
        }

        .container {
            display: inline-block;
            cursor: pointer;
            position: absolute;
            left: 10px;
            top: 10px;
        }

        .bar1,
        .bar2,
        .bar3 {
            width: 35px;
            height: 5px;
            background-color: yellow;
            margin: 6px 0;
            transition: 0.4s;
        }

        .change .bar1 {
            transform: translate(0, 11px) rotate(-45deg);
        }

        .change .bar2 {
            opacity: 0;
        }

        .change .bar3 {
            transform: translate(0, -11px) rotate(45deg);
        }

        .accountTransfer {
            list-style-type: none;
            cursor: pointer;
            color: black;
        }

        .dropdown-item {
            margin-left: 40px;
        }
        
        #logoutDrp {
            color: aliceblue;
            position: absolute;
            right: 80px;
            top: 15px;
        }

        .trnsferIcon {
            width: 50px;
            display: flex;
            justify-content: center;
        }

        .moneyTransfer {
            display: flex;
            justify-content: center;
        }

        .sideNavUN {
            margin-left: 20px;
            color: rgb(114, 119, 124);
        }

        .transferPopup {
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            display: none;
        }

        .popup-content {
            background-color: white;
            margin: 10% auto;
            padding: 20px;
            width: 30%;
            font-weight: bolder;
        }

        .popup-content button {
            display: block;
            margin: 0 auto;
        }

        .show {
            display: block;
        }

        .footerButtons {
            display: flex;
            align-items: flex-end;
        }

        #snackbar {
            visibility: hidden;
            min-width: 250px;
            margin-left: -125px;
            background-color: #333;
            color: #fff;
            text-align: center;
            border-radius: 2px;
            padding: 16px;
            position: fixed;
            z-index: 1;
            left: 50%;
            bottom: 30px;
            font-size: 17px;
        }

        #snackbar.show {
            visibility: visible;
            -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
            animation: fadein 0.5s, fadeout 0.5s 2.5s;
        }

        @-webkit-keyframes fadein {
            from {
                bottom: 0;
                opacity: 0;
            }

            to {
                bottom: 30px;
                opacity: 1;
            }
        }

        @keyframes fadein {
            from {
                bottom: 0;
                opacity: 0;
            }

            to {
                bottom: 30px;
                opacity: 1;
            }
        }

        @-webkit-keyframes fadeout {
            from {
                bottom: 30px;
                opacity: 1;
            }

            to {
                bottom: 0;
                opacity: 0;
            }
        }

        @keyframes fadeout {
            from {
                bottom: 30px;
                opacity: 1;
            }

            to {
                bottom: 0;
                opacity: 0;
            }
        }

        .successImg {
            width: 20px;
        }
        .logout{
            min-width: 130px;
        }
        .transfer_icons{
            width: 15px;
            height: 15px;
        }
        
    </style>
</head>

<body>

    <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "online_banking";
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        $account_number =  $_SESSION['account_number'];

        if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        }
        else{
            $stmt = mysqli_prepare($conn, "SELECT * FROM transaction_table WHERE account_number = ? OR to_account_number = ? ORDER BY date_time DESC");
            mysqli_stmt_bind_param($stmt, "ii", $account_number, $account_number);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            $transactions = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $to_account_number = $row['to_account_number'];
                $transaction_id = $row['transaction_id'];
                $from_acount_number = $row['account_number'];
                $date = $row['date_time'];
                $amount = $row['amount'];
                $transaction = array("transaction_id" => $transaction_id, "amount" => $amount, "date_time" => $date, "to_account_number" => $to_account_number, "account_number" => $from_acount_number);
                $transactions[] = $transaction;
            }

            $stmt = mysqli_prepare($conn, "SELECT * FROM user_application_table WHERE account_number = ?");
            mysqli_stmt_bind_param($stmt, "i", $account_number);
            mysqli_stmt_execute($stmt);
            $result_1 = mysqli_stmt_get_result($stmt);
            $row_1 = mysqli_fetch_assoc($result_1);

            $account_bal = $row_1['account_bal'];
            $no_of_transactions = $row_1['no_of_transactions'];

            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        }
        
    ?>

    <nav class="navbar navbar-light bg-light">
        <div class="navbar-brand" href="#">
            <div class="container" onclick="myFunction(this)">
                <div class="bar1"></div>
                <div class="bar2"></div>
                <div class="bar3"></div>
            </div>
            <div id="mySidenav" class="sidenav">
                <label class="sideNavUN"><?php echo $_SESSION['name'] ?></label>
                <a href="#">View/Edit profile</a>
                <a href="#">Money transfer</a>
                <a href="#" id="logoutLink" onclick="logout()">Log out</a>
            </div>
            <img src="https://res.cloudinary.com/dwficcf7f/image/upload/v1681638409/mybank_tkz6wk.png" width="30"
                height="30" class="d-inline-block align-top" alt="" />
            <label class="bankName">My Bank</label>
            <div id="logoutDrp">
                <div class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['name'] ?></div>
                <div class="dropdown-menu logout" aria-labelledby="dropdownMenuButton">
                    <a href="#" id="logoutLink" onclick="logout()"><strong>Log out</strong></a>
                </div>
            </div>
        </div>
    </nav>
    <form action="" name="transaction-form">
        <div class="popupBody">
            <div class="popUp totalAmount">
                <label class="mainLabel" name="currentbalance"><?php echo $account_bal; ?></label>
                Current balance
            </div>
            <div class="popUp noofTransactions">
                <label class="mainLabel" name="no-of-transactions"><?php echo $no_of_transactions; ?></label>
                Total no of transactions
            </div>
            <a class="popUp accountTransfer" id="moneyTransferPopup">
                <div class="moneyTransfer"><img src="icons/transfer.png" alt="" class="trnsferIcon" /></div>
                Money transfer
            </a>
        </div>
    </form>
    <div id="myPopup" class="transferPopup">
        <div class="popup-content">
            <h1>Money Transfer</h1>
            <form id="transferForm" method="post" action="transactions.php">
                <div class="form-group">
                    <label for="accountNumber">Account Number</label>
                    <input type="text" class="form-control" id="accountNumber" name="account_number" aria-describedby="accountNumberHelp">
                </div>
                <div class="form-group">
                    <label for="amount">Enter Amount</label>
                    <input type="number" class="form-control" id="amount" name="amount">
                </div>
                <div class="footerButtons">
                    <button id="closePopup" class="btn btn-danger" name="close">
                    Close
                    </button>
                    <button id="sendMoney" class="btn btn-success" type="submit" name="send" onclick="sentsucess()">
                    Send
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="transactionData">
        <table class="table table-dark" id="transaction-table-body">
            <thead>
                <tr>
                    <th scope="col">Sent to</th>
                    <th scope="col">Transaction ID</th>
                    <th scope="col">From</th>
                    <th scope="col">Date</th>
                    <th scope="col">Amount</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($transactions as $transaction) { ?>
                <tr>
                    <td><?php echo $transaction['to_account_number']; ?></td>
                    <td><?php echo $transaction['transaction_id']; ?></td>
                    <td><?php echo $transaction['account_number']; ?></td>
                    <td><?php echo $transaction['date_time']; ?></td>
                    <td><?php if ($transaction['to_account_number'] == $account_number) { ?>
                            <img src="icons/plus_icon_green.png" class="transfer_icons">
                        <?php } else if ($transaction['account_number'] == $account_number) { ?>
                            <img src="icons/minus_icon_red.png" class="transfer_icons">
                        <?php } ?> <?php echo $transaction['amount']; ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    <div id="snackbar"><img src="icons/success.png" class="successImg"> Sent Successfully</div>

    <script>

        // for logout button
        function logout() {
            // Send logout request to server using AJAX
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'logout.php');
            xhr.onload = function() {
                // Redirect to login page
                window.location.href = 'login.php';
            };
            xhr.send();
        }
        
        let openFlag = false;

        function myFunction(x) {
            x.classList.toggle("change");
            if (!openFlag) {
            document.getElementById("mySidenav").style.width = "220px";
            openFlag = true;
            } else {
            document.getElementById("mySidenav").style.width = "0";
            openFlag = false;
            }
        }

        const moneyTransferPopup = document.getElementById("moneyTransferPopup");
        const closePopup = document.getElementById("closePopup");
        const myPopup = document.getElementById("myPopup");
        const snackbar = document.getElementById("snackbar");

        moneyTransferPopup.addEventListener("click", function () {
            myPopup.classList.add("show");
        });

        closePopup.addEventListener("click", function () {
            myPopup.classList.remove("show");
        });

        window.addEventListener("click", function (event) {
            if (event.target == myPopup) {
            myPopup.classList.remove("show");
            }
        });

        // snack
        function sentsucess() {
            var x = document.getElementById("snackbar");
            x.className = "show";
            setTimeout(function() { 
                x.className = x.className.replace("show", ""); 
                myPopup.classList.remove("show"); // close the popup after 3 seconds
            }, 3000);
        }
    </script>

</body>

</html>