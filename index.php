<?php
include("config/config.php");
include('alert.php');

session_start();
date_default_timezone_set("Asia/Hong_Kong");

if (isset($_POST['time_in'])) {


   $employee_id = mysqli_real_escape_string($conn, $_POST['employee_id']);
   $time_in = date('H:i:s');
   $time_out = date('H:i:s');
   $logdate = date('Y-m-d');

   // sql code which check student_id exist in the database
   $query = "SELECT * FROM employees WHERE employee_id = '$employee_id'";

   // execute the query and get the result object
   $result = mysqli_query($conn, $query);
   
   // check the number of rows returned
   if (mysqli_num_rows($result) <= 0) {
    echo "<script>
    Swal.fire({
      title: 'Employee Id No. is not existing in database',
      text: 'Record was not saved',
      icon: 'error',
      showCloseButton: true
    }).then(function(isConfirm) {
      if (isConfirm) {
        window.location = 'index.php';
      }
    });
    </script>";   
} else {
   // ???
   $select = " SELECT * FROM attendance WHERE employee_id = '$employee_id' AND date = '$logdate'";

   $result = mysqli_query($conn, $select);

   if (mysqli_num_rows($result) > 0) {
    echo "<script>
          Swal.fire({
            title: 'Id no. is already timed in',
            text: 'Record was not saved',
            icon: 'error',
            showCloseButton: true
          }).then(function(isConfirm) {
            if (isConfirm) {
              window.location = 'index.php';
            }
          });
          </script>";
  }else{
    $insert = "INSERT INTO attendance (employee_id, time_in, date) 
    VALUES('$employee_id', '$time_in', '$logdate')";
    // $update = "UPDATE attendance SET time_in = '$time_in', time_out = '$time_out' WHERE employee_id = '$employee_id'";

   mysqli_query($conn, $insert);
   echo "<script>
   Swal.fire({
     position: 'center',
     title: 'Time in!',
     icon: 'success',
     showCloseButton: false,
     timer: 1500
   }).then(function(isConfirm) {
     if (isConfirm) {
       window.location = 'index.php';
     }
   });
   </script>";
}
}
}
if (isset($_POST['time_out'])) {
    $employee_id = mysqli_real_escape_string($conn, $_POST['employee_id']);
    $time_out = date('H:i:s');
    $logdate = date('Y-m-d');

    $update = "UPDATE attendance SET time_out = '$time_out' WHERE employee_id = '$employee_id' AND date = '$logdate'";

    mysqli_query($conn, $update);

    echo "<script>
        Swal.fire({
            position: 'center',
            title: 'Time out!',
            icon: 'success',
            showCloseButton: false,
            timer: 1500
        }).then(function(isConfirm) {
            if (isConfirm) {
                window.location = 'index.php';
            }
        });
    </script>";
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
            <img src="img/clock.png">
        </div>

        <div class="login-content">
            <form action="" method="post">
                <!-- <form action="index.html"> -->
                <!-- <img src="img/avatar.jpg"> -->
                <h1>Current Time:</h1>
                <h2 id="time"></h2>
                <!-- <h2 class="title">Welcome</h2> -->

                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">

                        <input type="text" name="employee_id" class="input" placeholder="Employee ID No.">
                    </div>
                </div>
                <!-- <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <input type="password" id="txtPassword" name="password" class="input" placeholder="Password">
                        <button type="button" id="btnToggle" class="toggle">
                            <i id="eyeIcon" class="fa-solid fa-eye"></i></button>
                    </div>
                </div> -->

                <input type="submit" class="btn" value="Time In" name="time_in">
                <input type="submit" class="btn" value="Break" name="break">
                <input type="submit" class="btn" href="timeout.php" value="Time Out" name="time_out">
                <a href="login.php">login now</a>
                <!-- <select>
                    <option value="">Time in</option>
                    <option value="us">Break</option>
                    <option value="ca">Time Out</option>
                </select> -->
            </form>
        </div>
    </div>
    <script>
    function updateTime() {
        var now = new Date();
        var timeElem = document.getElementById("time");
        timeElem.innerHTML = now.toLocaleTimeString();
    }

    setInterval(updateTime, 1000);
    </script>
</body>

</html>