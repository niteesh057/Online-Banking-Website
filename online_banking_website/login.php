<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <!-- favicon -->
    <link rel="icon" href="https://res.cloudinary.com/dwficcf7f/image/upload/v1681638409/mybank_tkz6wk.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        html,
        body {
            background-image: url('http://getwallpapers.com/wallpaper/full/a/5/d/544750.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            height: 100%;
            font-family: 'Numans', sans-serif;
        }

        .container {
            height: 100%;
            align-content: center;
        }

        .card {
            position: absolute;
            left: 30%;
            top: 20%;
            padding-left: 100px;
            padding-top: 40px;
            height: 370px;
            margin-top: auto;
            margin-bottom: auto;
            width: 400px;
            background-color: rgba(0, 0, 0, 0.5) !important;
        }

        .social_icon span {
            font-size: 60px;
            margin-left: 10px;
            color: #FFC312;
        }

        .social_icon span:hover {
            color: white;
            cursor: pointer;
        }

        .card-header h3 {
            color: white;
        }

        .social_icon {
            position: absolute;
            right: 20px;
            top: -45px;
        }

        .input-group-prepend span {
            width: 50px;
            background-color: #FFC312;
            color: black;
            border: 0 !important;
        }

        input:focus {
            outline: 0 0 0 0 !important;
            box-shadow: 0 0 0 0 !important;

        }

        .remember {
            color: white;
        }

        .remember input {
            width: 20px;
            height: 20px;
            margin-left: 15px;
            margin-right: 5px;
        }

        .login_btn {
            color: black;
            background-color: #FFC312;
            width: 100px;
        }

        .login_btn:hover {
            color: black;
            background-color: white;
        }
        span{
            color: red;
            font-size: 10px;
        }
    </style>
</head>

<body>
    <?php
        $usernameErr = $passwordErr = $bothErr = "";
        if($_SERVER["REQUEST_METHOD"]=="POST"){

            if(empty($_POST["username"])){
                $usernameErr="Field must be filled.";
            }
            if(empty($_POST["password"])){
                $passwordErr="Field must be filled.";
            }
            else{
                $mail = $_POST["username"];
                $password_1 = $_POST["password"];

                $host = "localhost";
                $username = "root";
                $password = "";
                $database = "online_banking";

                $conn = new mysqli($host, $username, $password, $database);
                if($conn->connect_error){
                    die("Connection failed:".$conn->connect_error);
                }
                elseif(($mail == "abc123@gmail.com") && ($password_1 == "password123")){
                    session_start();
                    $_SESSION['admin'] = ['admin'];
                    header("Location: admin.php");
                }
                else{
                    $stmt = mysqli_prepare($conn, "SELECT * FROM user_application_table WHERE email = ? AND password = ? AND activate_flag = 'y'");
                    mysqli_stmt_bind_param($stmt, "ss", $mail, $password_1);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    if(mysqli_num_rows($result)>0){
                        session_start();
                        $row = mysqli_fetch_assoc($result);
                        $_SESSION['name'] = $row['name'];
                        $_SESSION['account_number'] = $row['account_number'];
                        header("Location: userpage.php");
                    }
                    else{
                        $bothErr = "Incorrect Username or Password or Account is not activated";
                    }
                    mysqli_stmt_close($stmt);
                    mysqli_close($conn);
                }
            }
        }

    ?>
    <div class="container">
        <div class="d-flex justify-content-center h-100">
            <div class="card">
                <div class="card-header">
                    <h3>Log In</h3>
                </div>
                <div class="card-body">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="username" name="username">
                            <span><?php echo $usernameErr;?></span>
                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-lock"></i></span>
                            </div>
                            <input type="password" class="form-control" placeholder="password" name="password">
                            <span><?php echo $passwordErr;?></span>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Login" class="btn float-right login_btn">
                            <br>
                            <span><?php echo $bothErr;?></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>