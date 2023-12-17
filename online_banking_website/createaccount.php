<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application form</title>
    <!-- favicon -->
    <link rel="icon" href="https://res.cloudinary.com/dwficcf7f/image/upload/v1681638409/mybank_tkz6wk.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        .App_form {
            width: 40%;
            position: absolute;
            left: 30%;
            top: 10%;
            padding: 30px;
            color: black;
            background-color: rgb(246, 246, 160);
        }
        .navbar{
            background-color: black;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1;
        }
        .userName {
            position: absolute;
            right: 20px;
            top: 20px;
            color: aliceblue;
            cursor: pointer;
        }
        .bankName{
            position: absolute;
            top: 20px;
            left: 60px;
            color: aliceblue;
        }
        body{
            background-color: beige;
            margin-top: 50px; /* Set the margin-top to the height of the navbar */
        }
        span{
            color: red;
        }
        /* #snackbar {
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
        } */
    </style>
</head>
<body>
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <img src="https://res.cloudinary.com/dwficcf7f/image/upload/v1681638409/mybank_tkz6wk.png" width="30" height="30" class="d-inline-block align-top" alt=""/>
            <label class="bankName">My Bank</label>
            <a class="userName" href="index.php">Home</a>
        </a>
    </nav>
    <?php
        $mobileErr = $passwordErr = $confirmpasswordErr = $emailErr = $dobErr = "";
        if($_SERVER["REQUEST_METHOD"]=="POST"){

            if(empty($_POST["mobilenumber"])){
                $mobileErr = "Field must be filled.";
            }
            else{
                if(!preg_match ("/^[0-9]*$/",($_POST["mobilenumber"])) ){
                    $mobileErr = "Please enter a valid mobile number.";
                }
            }

            if(empty($_POST["email"])){
                $emailErr = "Field must be filled.";
            }
            else{
                if (!preg_match ("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^",($_POST["email"])) ){  
                    $emailErr = "Please enter a valid Email.";  
                }
            }

            if(empty($_POST["password"])){
                $passwordErr="Field must be filled.";
            }
            else{
                if(!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#$%^&+=!]).{9,}$/',($_POST["password"]))){
                    $passwordErr = "Please enter a Strong Password.";
                }
            }

            if(empty($_POST["confirmpassword"])){
                $confirmpasswordErr="Field must be filled.";
            }
            else{
                if(($_POST["password"]) != ($_POST["confirmpassword"])){
                    $confirmpasswordErr = "Password and Confirmpassword must be same.";
                }
            }

            if(empty($_POST["dob"])){
                $dobErr="Field must be filled.";
            }
            else{
                if(!preg_match('/^(19[6-9][0-9]|200[0-5])-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[01])$/', ($_POST["dob"]))) {
                    $dobErr = "User must be 18 years or above.";
                  }
            }

            $name = $_POST["name"];
            $mobile = $_POST["mobilenumber"];
            $email = $_POST["email"];
            $address = $_POST["address"];
            $dob = date('Y-m-d',strtotime($_POST["dob"]));
            $password_1 = $_POST["password"];

            $host = "localhost";
            $username = "root";
            $password = "";
            $database = "online_banking";

            $conn = new mysqli($host, $username, $password, $database);
            if($conn->connect_error){
                die("Connection failed:".$conn->connect_error);
            }
            else{

                // generate unique 12 digit account number
                function generate_account_number($conn) {
                    // use current timestamp as seed for random number generator
                    srand(time());
                    // generate random 12 digit number
                    $account_number = strval(rand(100000000000, 999999999999));
                    // check if account number already exists in database
                    $query = "SELECT COUNT(*) AS count FROM user_application_table WHERE account_number = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("s", $account_number);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc();
                    // if account number already exists, generate new one
                    if ($row['count'] > 0) {
                        generate_account_number($conn);
                    } else {
                        return $account_number;
                    }
                }

                $account_number = generate_account_number($conn);
                
                // check if account number already exists
                $sql = "SELECT account_number FROM user_application_table WHERE account_number = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $account_number);
                $stmt->execute();
                $stmt->store_result();
                $rnum = $stmt->num_rows;
                $stmt->close();

                if ($rnum > 0) {
                    // if account number already exists, generate new one and try again
                    $account_number = generate_account_number($conn);
                }
                
                // insert user data into database
                $sql = "INSERT INTO user_application_table (account_number, name, mobile_number, email, address, dob, password, account_bal, no_of_transactions) VALUES (?, ?, ?, ?, ?, ?, ?, 0, 0)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("issssss", $account_number, $name, $mobile, $email, $address, $dob, $password_1);
                $stmt->execute();
                $stmt->close();
                $conn->close();
            }
    
        }
 
    ?>

    <div class="App_form p-3 mb-2 bg-warning text-dark">
        <form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" id="myForm">
            <div class="form-group">
                <label for="exampleInputEmail1">Enter Full Name</label>
                <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Name" required name="name">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Mobile Number</label>
                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="+91......." required name="mobilenumber"><span><?php echo $mobileErr;?></span>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Address" required name="email"><span><?php echo $emailErr;?></span>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Address</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Address" required name="address">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Date of birth</label>
                <input type="date" class="form-control" id="exampleInputPassword1" required name="dob"><span><?php echo $dobErr;?></span>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Set Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required name="password"><span><?php echo $passwordErr;?></span>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Confirm Password</label>
                <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Password" required name="confirmpassword"><span><?php echo $confirmpasswordErr;?></span>
            </div>
            <button type="submit" class="btn btn-primary" >Submit</button>
        </form>
    </div>
    <!-- <div id="snackbar"><img src="icons/success.png" class="successImg"> Sent Successfully</div> -->
    <!-- <script>
        // snack
        function sentsuccess() {
            var x = document.getElementById("snackbar");
            var myForm = document.getElementById("myForm"); // assuming the form ID is "myForm"
            x.className = "show";
            setTimeout(function() { 
                x.className = x.className.replace("show", ""); 
                myPopup.classList.remove("show"); // close the popup after 3 seconds
                myForm.reset(); // reset the form fields
            }, 5000);
            }

        myForm.addEventListener("submit", function(event) {
            event.preventDefault(); // prevent form from submitting normally
            // do any necessary form processing here
            sentsucess(); // show snackbar
        });

    </script> -->
</body>
</html>