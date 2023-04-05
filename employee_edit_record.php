<?php
require("config/config.php");

if (isset($_POST["btnsave"])) {
  $id = $_POST["id"];
  $employee_id = $_POST["employee_id"];
  $firstname = $_POST["firstname"];
  $lastname = $_POST["lastname"];
 

  if ($employee_id == "") {
    echo "Please input Employee Number!";
  } elseif ($firstname == "") {
    echo "Please input valid First Name!";
  } elseif ($lastname == "") {
    echo "Please input valid Last Name!";
  } else {


    $sql = "UPDATE employees SET employee_id = :employee_id, firstname = :firstname, lastname = :lastname WHERE id = :recordid";

    $result = $conn->prepare($sql);
    $values = array(":employee_id" => $employee_id, ":firstname" => $firstname, ":lastname" => $lastname, ":recordid" => $id);

    $result->execute($values);

    if ($result->rowCount() > 0) {
      echo "<script>alert('Record has been saved'); window.location = 'dashboard.php';</script>";
    } else {
      echo "<script>alert('No record has been saved'); window.location = 'employee_edit_record.php';  </script>";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit & Update Instructor Record</title>
    <link rel="stylesheet" href="css/edit.css" />
    <!-- Font Awesome Cdn Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</head>

<body>
    <div class="container">

        <!--main page-->
        <section class="main">
            <div class="main-top">
                <!-- <h1>Payroll System</h1> -->
            </div>

            <div class="form-container">
                <!--php code-->
                <?php

$sql = "SELECT * FROM employees WHERE id = ?";
$id = "";
$employee_id = "";
$firstname = "";
$lastname = "";
// $position = "";

try {
    $res = $conn->prepare($sql);
    $res->bind_param("i", $_REQUEST["id"]);
    $res->execute();

    $result = $res->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id = $row["id"];
        $employee_id  = $row["employee_id"];
        $firstname = $row["firstname"];
        $lastname = $row["lastname"];
        // $position = $row["position"];
    }
} catch (mysqli_sql_exception $e) {
    die("An error has occurred: " . $e->getMessage());
}

        ?>
                <form action="employee_edit_record.php" method="post">
                    <input type="hidden" name="id" value="<?php echo "$id" ?>">
                    <div>
                        <h1>Payroll System</h1>
                    </div>

                    <h3>Edit & Update Employee Record</h3>
                    <label>Employee Number:<br>
                        <input type="text" value="<?php echo "$employee_id" ?>" name="employee_id" required
                            placeholder="Employee Number"></label>
                    <label>First Name:<br>
                        <input type="text" value="<?php echo "$firstname" ?>" name="firstname" required
                            placeholder="First Name"></labe>
                        <label>Last Name:<br>
                            <input type="text" value="<?php echo "$lastname" ?>" name="lastname" required
                                placeholder="Last Name"> </label>
                        <!-- <label>Position:<br>
                            <input type="text" value="<?php echo "$position" ?>" name="position" required
                                placeholder="Position"> </label> -->



                        <input type="submit" name="btnsave" value="Save" class="form-btn">
                        <li>
                            <a href="dashboard.php">
                                <i class='bx bx-arrow-back'></i>
                                <span class="links_name"> Back</span>
                            </a>
                        </li>
                </form>
            </div>
</body>

</html>