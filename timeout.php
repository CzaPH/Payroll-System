<?php

include("config/config.php");
include('alert.php');

session_start();
date_default_timezone_set("Asia/Hong_Kong");

if (isset($_POST['timeOut'])) {


   $employee_id = mysqli_real_escape_string($conn, $_POST['employee_id']);
   $time_in = date('H:i:s');
   $logdate = date('Y-m-d');

   $select = " SELECT * FROM employees WHERE employee_id = '$employee_id' ";

   $result = mysqli_query($conn, $select);

   if (mysqli_num_rows($result) > 0) {

    //$error[] = 'Student Id No. is Aleady Exist!';

    // echo "<script>alert('Student Id No. is Aleady Exist!'); window.location = 'student.php';</script>";
    echo "<script>
          Swal.fire({
            title: 'Student Id No. is Aleady timed in',
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
    $insert = "INSERT INTO attendance (employee_id, time_out, date) 
    VALUES('$employee_id', '$time_out', '$logdate')";
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
?>