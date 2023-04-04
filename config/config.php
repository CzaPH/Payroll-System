<?php

$conn = mysqli_connect("localhost", "root", "", "payroll");


function filter($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>