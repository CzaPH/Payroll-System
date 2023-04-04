<?php
include("config/config.php");
if (isset($_POST['submit'])) {
    // retrieve the username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // validate that both fields are not empty
    if (empty($username) || empty($password)) {
        echo "Please enter both your username and password.";
        exit();
    }

    // authenticate the user by checking against a database of users
    // you can replace this with your own database connection and query logic
   
    if ($username === $username && $password === $password) {
        // redirect to the dashboard page upon successful login
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Incorrect username or password.";
        exit();
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/style-login.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <img class="wave" src="img/wave.png">
    <div class="container">
        <div class="img">
            <div class="text-1"><span class="typing"></span></div>
            <img src="img/bg.png">
        </div>

        <div class="login-content">
            <form action="" method="post">
                <!-- <form action="index.html"> -->
                <img src="img/avatar.jpg">
                <h2 class="title">Welcome</h2>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">

                        <input type="text" name="username" class="input" placeholder="Username">
                    </div>
                </div>
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <input type="password" id="txtPassword" name="password" class="input" placeholder="Password">
                        <!-- <button type="button" id="btnToggle" class="toggle">
                            <i id="eyeIcon" class="fa-solid fa-eye"></i></button> -->
                    </div>
                </div>
                <!-- <a href="register_form.php">register now</a> -->
                <input type="submit" class="btn" value="Login" name="submit">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="js/main.js"></script>
</body>

</html>