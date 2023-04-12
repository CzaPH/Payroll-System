<?php
    include("config/config.php");
    $query=mysqli_query($conn,"SELECT * FROM attendance");
?>

<table>
    <tr>
        <th>Date</th>
        <th>Edit | View</th>
    </tr>

    <?php
if (isset($_POST['dateFrom'])) {


    //GETTING VALUE FROM FILTER
    $new_date = date('Y-m-d', strtotime($_POST['dateFrom']));
    //echo $new_date;

    $new_date2 = date('Y-m-d', strtotime($_POST['dateTo']));
    //echo $new_date2;

    $dateFrom = date('Y-m-d', strtotime($_POST['dateFrom']));
    $dateTo = date('Y-m-d', strtotime($_POST['dateTo']));

    while($row=mysqli_fetch_array($query)){

    //FILTERING USING DATES
    if (date('Y-m-d', strtotime($row['date']))>$dateFrom && date('Y-m-d', strtotime($row['date'])) < $dateTo){
    ?>

    <tr>
        <td><?php echo  $row['date'] ?></td>
    </tr>

    <?php }
} 

}
?>

</table>