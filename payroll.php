<?php
include("config/config.php");
include "nav-Items.php";

// Get employee attendance record for the day
// if(isset($_POST['employee_id'])){
// $employee_id = filter_var($_POST['employee_id'], FILTER_SANITIZE_NUMBER_INT);
$employee_id = 1;
$date = date('Y-m-d');
$sql = "SELECT * FROM attendance WHERE employee_id = $employee_id ";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // Get time in and time out
  $row = mysqli_fetch_assoc($result);
  $time_in = strtotime($row['time_in']);
  $time_out = strtotime($row['time_out']);

  // Calculate hours worked
  $hours_worked = ($time_out - $time_in) / 3600;



  // Check if employee is late
  $late_penalty = 0;
  $start_time = strtotime('8:00:00'); // assume work starts at 8 AM
  $end_time = strtotime('17:00:00'); // assume work ends at 5 PM
  if ($time_in > $start_time) {
    $late_penalty = 1;
  }

  if ($time_out > $end_time) {
    $overtime_minutes = ($time_out - $end_time) / 60;
    $overtime_pay = $overtime_minutes * 1; // hourly rate is 60 pesos
  }




  // Calculate salary of late
$late_minutes = ($time_in - $start_time) / 60;
$late_penalty = floor($late_minutes); // Round down to nearest integer
$salary = 360 - $late_minutes - $overtime_pay;

// Calculate salary of overtime


//   $salary = 360 - ($late_penalty * 1);

} else {
  echo "No attendance record found for employee ID $employee_id on $date.";
}






mysqli_close($conn);

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta charset="UTF-8" />
        <title>Student Management</title>
        <meta charset="utf-8">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
            integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
            integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p"
            crossorigin="anonymous" />


        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js">
        </script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
        <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js">
        </script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <link href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css" rel="stylesheet">
        <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>

        <link rel="stylesheet" href="sidebar.css" />
        <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    </head>

<body>
    <div class="sidebar">
        <div class="logo-details">
            <span class="logo_name">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Administrator</span>
        </div>
        <?php navItems("Profile") ?>
    </div>
    <section class="home-section">
        <!-- <div class="header">
      <h3>COLLEGE OF COMPUTING STUDIES, INFORMATION AND COMMUNICATION TECHNOLOGY</h3>
    </div> -->
        <nav>
            <div class="sidebar-button">
                <i class="bx bx-menu sidebarBtn"></i>
                <span class="dashboard">Employee Profile</span>
            </div>
        </nav>

        <div class="home-content">
            <section class="attendance">
                <div class="attendance-list">


                    <table id="dataTable_1" class="table">
                        <thead>
                            <tr>

                                <!-- <th>QR Image</th> -->
                                <th>Employee id</th>
                                <th>Date</th>
                                <th>Time in</th>
                                <th>Time out</th>
                                <th>Hours Worked</th>
                                <th>Late Penalty</th>
                                <th>Overtime Penalty</th>
                                <th>Salary</th>


                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $employee_id; ?></td>
                                <td><?php echo $date; ?></td>
                                <td><?php echo date('h:i A', $time_in); ?></td>
                                <td><?php echo date('h:i A', $time_out); ?></td>
                                <td><?php echo $hours_worked; ?></td>
                                <td><?php echo $late_penalty; ?></td>
                                <td><?php echo $overtime_pay; ?></td>
                                <td><?php echo $salary; ?></td>
                            </tr>
                        </tbody>

                    </table>
                </div>
            </section>

</body>

</html>