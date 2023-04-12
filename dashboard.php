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
    <script>
    $(document).ready(function() {
        $('#dataTable_1').DataTable();
    });
    </script>

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
                <span class="dashboard">Employee Profile</span>
            </div>
        </nav>

        <div class="home-content">
            <section class="attendance">
                <div class="attendance-list">
                    <!-- <button type="button" class="btn " data-toggle="modal" data-target="#modal-studentinfo">
                        Add Employee Information </button> -->
                    <form class="form-inline" action="addemployee.php" method="post">
                        <div class="form-group mx-sm-3 mb-2">
                            <input type="text" class="form-control" id="EmployeeId" name="employeeid"
                                placeholder="Employee Id">
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <input type="text" class="form-control" id="fname" name="firstname"
                                placeholder="First Name">
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <input type="text" class="form-control" id="lname" name="lastname" placeholder="Last Name">
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <input type="text" class="form-control" id="Schedule" name="schedule"
                                placeholder="Schedule">
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <input type="text" class="form-control" id="Position" name="position"
                                placeholder="Position">
                        </div>
                        <button type="submit" name="Add" class="btn btn-primary mb-2">Add Record</button>
                    </form>


                    <table id="dataTable_1" class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <!-- <th>QR Image</th> -->
                                <th>Employee id</th>
                                <th>Name</th>
                                <th>Tools</th>


                            </tr>
                        </thead>
                        <tbody>
                            <?php
                           $sql = "SELECT * from employees;";
                           $result = $conn->query($sql);
                           $i = 1;

                           if ($result->num_rows > 0) {
                           // output data of each row
                           while($row = $result->fetch_assoc()) {
                               echo "<tr>
                               <td>". $i ."</td>
                               <td>". $row['employee_id'] . "</td>
                               <td>" . $row['firstname'] . " " . $row['lastname'] . "</td>
                               <td><a href = 'employee_edit_record.php?id=" . $row['id'] . "'> <i class='far fa-edit text-info h4'></i></a> | ";
                               
                               
                               
              ?>

                            <a href="#" class="delete" data-employee_id="<?=$row['id']?>">
                                <i class="far fa-trash-alt text-danger h4"></i>
                            </a>
                            <?php

                  $i++;
                }
              } else {
                echo "<tr> <td colspan = '9'> NO RECORDS FOUND</td> </tr>";
              }
                         
                
                            ?>
                        </tbody>

                    </table>
                </div>
            </section>
            <script>
            $(function() {
                $(document).on('click', '.delete', function() {
                    var employee_id = $(this).data('employee_id');

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Once deleted, it cannot be undone. Proceed anyway?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: 'employee_delete_record.php',
                                method: 'POST',
                                data: {
                                    employee_id: employee_id,
                                    delete: `delete`
                                },
                                dataType: 'json',
                                success: function(response) {
                                    if (response == 'success') {
                                        Swal.fire('DELETED!',
                                            'Record has been deleted', 'success'
                                        );
                                        setInterval(
                                            function() {
                                                location.href = 'dashboard.php';
                                            }, 2000
                                        );
                                    }
                                }
                            });
                        }
                    });
                });
            });
            </script>

</body>

</html>