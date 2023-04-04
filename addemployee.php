<?php
require ('config/config.php');
include('alert.php');

if (isset($_POST["Add"])) {
  $employee_id = $_POST["employeeid"];
  $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
  $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
  $schedule = mysqli_real_escape_string($conn, $_POST['schedule']);
  $position = mysqli_real_escape_string($conn, $_POST['position']);

 
  $select = " SELECT * FROM employees WHERE employee_id = '$employee_id' ";

   $result = mysqli_query($conn, $select);

   if (mysqli_num_rows($result) > 0) {

    //$error[] = 'Student Id No. is Aleady Exist!';

    // echo "<script>alert('Student Id No. is Aleady Exist!'); window.location = 'student.php';</script>";
    echo "<script>
          Swal.fire({
            title: 'Student Id No. is Aleady Exist',
            text: 'Record was not saved',
            icon: 'error',
            showCloseButton: true
          }).then(function(isConfirm) {
            if (isConfirm) {
              window.location = 'dashboard.php';
            }
          });
          </script>";
  }else{
    $insert = "INSERT INTO employees (employee_id, firstname, lastname, schedule_id, position_id) 
    VALUES('$employee_id', '$firstname', '$lastname', '$schedule_id','$position_id')";
   mysqli_query($conn, $insert);
   echo "<script>
   Swal.fire({
     position: 'center',
     title: 'Record has been saved',
     icon: 'success',
     showCloseButton: false,
     timer: 1500
   }).then(function(isConfirm) {
     if (isConfirm) {
       window.location = 'dashboard.php';
     }
   });
   </script>";
}
}
?>