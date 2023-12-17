<?php
session_start();
if (!isset($_SESSION['admin']) ){
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
    <title>Admin</title>
    <!-- favicon -->
    <link rel="icon" href="https://res.cloudinary.com/dwficcf7f/image/upload/v1681638409/mybank_tkz6wk.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
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

        .sideNavUN {
            margin-left: 20px;
            color: rgb(114, 119, 124);
        }
        .newAppRequest{
            position: absolute;
            top: 14%;
            left: 17%;
            width: 70%;
            background-color: antiquewhite;
            border-radius: 6px;
            padding: 15px;
            padding-bottom: 0px;
        }
        .existingAcc{
            position: absolute;
            top: 54%;            
            left: 17%;
            width: 70%;
            background-color: antiquewhite;
            border-radius: 6px;
            padding: 15px;
            padding-bottom: 0px;
        }
        .popup {
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
            border: 1px solid #888888;
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
        h1{
            text-align: center;
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
    </style>
</head>

<body>
    <nav class="navbar navbar-light bg-light">
        <div class="navbar-brand" href="#">
            <div class="container" onclick="myFunction(this)">
                <div class="bar1"></div>
                <div class="bar2"></div>
                <div class="bar3"></div>
            </div>
            <div id="mySidenav" class="sidenav">
                <label class="sideNavUN">Admin</label>
                <a href="#" id="logoutLink" onclick="logout()">Log out</a>
            </div>
            <img src="https://res.cloudinary.com/dwficcf7f/image/upload/v1681638409/mybank_tkz6wk.png" width="30"
                height="30" class="d-inline-block align-top" alt="" />
            <label class="bankName">My Bank</label>
            <div id="logoutDrp">
                <div class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Admin</div>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a href="#" id="logoutLink" onclick="logout()">Log out</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="newAppRequest">
        <table class="table table-dark">
            <thead>
                <tr>
                    <th scope="col">Account No</th>
                    <th scope="col">User Name</th>
                    <th scope="col">Balance</th>
                    <th scope="col">Activate</th>
                    <th scope="col">Reject</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Establish database connection
                    $conn = mysqli_connect("localhost", "root", "", "online_banking");

                    // Check if connection is successful
                    if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                    }
                    else{
                        // Retrieve data from user_application_table where active flag is N
                        $sql = "SELECT * FROM user_application_table WHERE activate_flag ='N'";
                        $result = mysqli_query($conn, $sql);

                        // Populate table with retrieved data
                        if (mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row["account_number"] . "</td>";
                                echo "<td>" . $row["name"] . "</td>";
                                echo "<td>" . $row["account_bal"] . "</td>";
                                echo "<td><button id='activateAcc' class='btn btn-success'>Activate</button></td>";
                                echo "<td><button id='removeAcc' class='btn btn-danger' onclick='removeUser(\"" . $row['account_number'] . "\")'>Remove</button></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No new account requests</td></tr>";
                        }
                        // Close database connection
                        mysqli_close($conn);
                    }
                ?>            
            </tbody>
        </table>
    </div>
    <div class="existingAcc">
        <table class="table table-dark">
            <thead>
                <tr>
                    <th scope="col">Account No</th>
                    <th scope="col">User Name</th>
                    <th scope="col">Deposit Money</th>
                    <th scope="col">De Activate</th>
                    <th scope="col">Remove</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // connect to the database
                    $conn = mysqli_connect("localhost", "root", "", "online_banking");

                    // query to select users with activate flag Y
                    $sql = "SELECT * FROM user_application_table WHERE activate_flag = 'Y' AND LENGTH(account_number) = 12";
                    $result = mysqli_query($conn, $sql);

                    // loop through the result and generate the table rows
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['account_number'] . "</td>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>";
                            echo "<a id='myButton' class='btn btn-success' onclick='showPopup(\"" . $row['account_number'] . "\")'>+ Add Money</a>";
                            echo "</td>";
                            echo "<td>";
                            echo "<button id='deactivateAcc' class='btn btn-warning' onclick='deactivateUser(\"" . $row['account_number'] . "\")'>De Activate</button>";
                            echo "</td>";
                            echo "<td>";
                            echo "<button id='removeAcc' class='btn btn-danger' onclick='removeUser(\"" . $row['account_number'] . "\")'>Remove</button>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No users found.</td></tr>";
                    }
                    // close the database connection
                    mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </div>

    <!-- add money popup -->
    <div id="myPopup" class="popup">
        <div class="popup-content">
            <h1>Add Money</h1>
            <form id="transferForm" method="POST" action="add_money.php">
                <div class="form-group">
                    <label for="accountNumber">Account Number:</label>
                    <input type="text" class="form-control" id="accountNumber" name="accountNumber" readonly>
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
                    Add
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div id="snackbar"><img src="icons/success.png" class="successImg"> Added Successfully</div>

    <script>

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
                document.getElementById("mySidenav").style.width = "200px";
                openFlag = true;
            }
            else {
                document.getElementById("mySidenav").style.width = "0";
                openFlag = false;
            }
        }

        //for accepting the user in the bank
        $(document).ready(function() {
            // Listen for click event on activate button
            $('#activateAcc').click(function() {
                // Get the account number of the selected row
                var accNo = $(this).closest('tr').find('td:eq(0)').text();

                // Send AJAX request to update the database
                $.ajax({
                url: 'update_account.php',
                type: 'POST',
                data: {
                    account_number: accNo,
                    activate_flag: 'Y'
                },
                success: function(response) {
                    // Reload the page to update the table immediately
                    location.reload();
                }
                });
            });
        });

        //for removing the user from the database
        function removeUser(accountNumber) {
            if (confirm("Are you sure you want to remove this user?")) {
                $.ajax({
                    url: "remove_user.php",
                    type: "POST",
                    data: { account_number: accountNumber },
                    success: function(result) {
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        alert("Error: " + error);
                    }
                });
            }
        }

        //FOR DEACTIVATING THE USER
        function deactivateUser(accountNumber) {
            if (confirm("Are you sure you want to de-activate this account?")) {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    location.reload();
                }
                };
                xhttp.open("GET", "deactivate_user.php?account_number=" + accountNumber, true);
                xhttp.send();
            }
        }

        //add_money popup
        myButton.addEventListener("click", function () {
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

        // showing account_number in popup
        function showPopup(accountNumber) {
            // show the popup
            document.getElementById("myPopup").style.display = "block";
            // set the account number in the popup form
            document.getElementById("accountNumber").value = accountNumber;
        }

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