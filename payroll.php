<?php
include("config/config.php");
include "nav-Items.php";
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

                                <th>Name</th>
                                <th>Employee id</th>
                                <th>Date</th>
                                <th>Time in</th>
                                <th>Time out</th>
                                <th>Hours Worked</th>
                                <th>Late Penalty</th>
                                <th>Undertime Penalty</th>
                                <th>Overtime</th>
                                <th>Over break penalty</th>
                                <th>Salary</th>


                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                               
                               $sql = "SELECT * FROM attendance INNER JOIN employees ON attendance.employee_id = employees.employee_id";
                               $result = $conn->query($sql);

                                
                                if ($result->num_rows > 0) {
                                  // output data of each row
                                  while($row = $result->fetch_assoc()) {
                                    $employee_id = $row['employee_id'];
                                    $date = $row['date'];
                                    $time_in = strtotime($row['time_in']);
                                    $time_out = strtotime($row['time_out']);
                                    $end_break = strtotime($row['end_break']);
                                
                                    // Calculate hours worked
                                    $hours_worked = ($time_out - $time_in) / 3600; //Divided into 1 hour. 3,600 seconds is equivalent to 1 hour
                                
                                    // Check if employee is late
                                    $late_penalty = 0;
                                    $start_time = strtotime('8:00:00'); // assume work starts at 8 AM
                                    $end_time = strtotime('17:00:00'); // assume work ends at 5 PM
                                    if ($time_in > $start_time) {
                                      $late_penalty = 1;
                                    }
                                
                                    // Calculate overtime pay
                                    $overtime_pay = 0;
                                    if ($time_out > $end_time) {
                                      $overtime_minutes = ($time_out - $end_time) / 60;
                                      $overtime_pay = $overtime_minutes * 1; // deduction per minute is 1
                                    }
                                    //calculate overbreak
                                    $over_break_pay = 0;
                                    if ($end_break > strtotime('13:00:00')) { // break ends after 1 PM
                                        $over_break_minutes = ($end_break - strtotime('13:00:00')) / 60;
                                        $over_break_pay = $over_break_minutes * 1; // deduction per minute is 1
                                    }
                                                                    // Calculate undertime pay
                                    $undertime_pay = 0;
                                    if ($time_out < $end_time) {
                                    $undertime_minutes = ($end_time - $time_out) / 60;
                                    $undertime_pay = $undertime_minutes * 1; // deduction per minute is 1

                                    }
                                    // Calculate salary of late, overtime, and undertime pay
                                    $late_minutes = ($time_in - $start_time) / 60;
                                    $late_penalty = floor($late_minutes); // Round down to nearest integer
                                    $salary = 360 - floor($late_minutes) - floor($undertime_pay) - floor($over_break_pay);
                                    $undertime_pay_salary = -$undertime_pay; // negative value to indicate deduction

                                    // // Your existing code
                                    // $sql = "SELECT * FROM attendance INNER JOIN employees ON attendance.employee_id = employees.employee_id";
                                    // $result = $conn->query($sql);
                                    
                                    // if ($result->num_rows > 0) {
                                    //     while($row = $result->fetch_assoc()) {
                                    //         $employee_id = $row['employee_id'];
                                            // Calculate the salary
                                            // $salary = 360 - floor($late_minutes) - floor($undertime_pay) - floor($over_break_pay);
                                    
                                            // Insert the salary into the attendance table
                                            $insertSql = "UPDATE attendance SET salary='".$salary."' WHERE employee_id='".$row['employee_id']."' AND date='".$row['date']."'";
                                            $conn->query($insertSql);
                                    
                                            // Output the row data with the calculated salary
                                            echo "<tr>
                                                <td>".$row['firstname'].' '.$row['lastname']."</td>
                                                <td>". $row['employee_id'] . "</td>
                                                <td>" . $row['date'] . "</td> 
                                                <td>" . $row['time_in'] . "</td>
                                                <td>" .$row['time_out']. "</td>
                                                <td>" .number_format($hours_worked, 2).  "</td>
                                                <td>" .$late_penalty. "</td>
                                                <td>"  .number_format($undertime_pay, 2). "</td>
                                                <td>" .$overtime_pay. "</td>
                                                <td>" .$over_break_pay. "</td>
                                                <td>" .$row['salary']. "</td>
                                            </tr>";
                                        }
                                    } else {
                                        echo "No attendance record found.";
                                    }
                                                             
                                ?>
                            </tr>
                        </tbody>

                    </table>
                </div>
            </section>

</body>

</html>