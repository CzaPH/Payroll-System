<?php
include("config/config.php");

if (isset($_POST['delete'])) {
  $employee_id = filter($_POST['employee_id']);

  $delete = $conn->prepare("DELETE FROM attendance WHERE id = ?");
  $delete->bind_param("i", $employee_id);
  $delete->execute();

  exit(json_encode('success'));
}

?>