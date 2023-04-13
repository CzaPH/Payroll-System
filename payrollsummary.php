<?php
require 'conn.php';
include "nav-Items.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta charset="UTF-8" />
        <title>Student Management</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
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
        <nav>
            <div class="sidebar-button">
                <span class="dashboard">PAYROLL SUMMARY</span>
            </div>
</nav>
        <div class="home-content">
            <section class="attendance">
		<form class="form-inline" method="POST" action="">
			<label>Date:</label>
			<input type="date" class="form-control" placeholder="Start"  name="date1" value="<?php echo isset($_POST['date1']) ? $_POST['date1'] : '' ?>" />
			<label>To</label>
			<input type="date" class="form-control" placeholder="End"  name="date2" value="<?php echo isset($_POST['date2']) ? $_POST['date2'] : '' ?>"/>
			&nbsp;&nbsp;<button class="btn btn-primary" name="search"><span class="glyphicon glyphicon-search"></span>SEARCH</button>&nbsp;&nbsp;<a href="payrollsummary.php" type="button" class="btn btn-success"><span class = "glyphicon glyphicon-refresh">RESET<span></a>
		</form>
		<br /><br />
		<div class="table-responsive">	
			<table class="table table-bordered">
				<thead class="alert-info">
					<tr>
						<th>Employee ID</th>
						<th>Name</th>
                        <th>Days of Work</th>
                        <th>Gross Pay</th>
                        <th>Deduction</th>
						<th>Net Salary</th>
					</tr>
				</thead>
				<tbody>
					<?php include'range.php'?>	
				</tbody>
			</table>
		</div>
            </section>

</body>

</html>