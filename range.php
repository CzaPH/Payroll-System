<?php
	require 'conn.php';
	if(ISSET($_POST['search'])){
		$date1 = date("Y-m-d", strtotime($_POST['date1']));
		$date2 = date("Y-m-d", strtotime($_POST['date2']));
		$query=mysqli_query($conn, "SELECT *,SUM(salary) as TotalSalary, COUNT(salary) AS DaysofWork
		FROM `attendance` 
        INNER JOIN employees ON attendance.employee_id = employees.employee_id
        WHERE date(`date`) 
        BETWEEN '$date1' AND '$date2'
		GROUP BY attendance.employee_id") or die(mysqli_error());
		$row=mysqli_num_rows($query);
		if($row>0){
			while($fetch=mysqli_fetch_array($query)){
?>
	<tr>
		<td><?php echo $fetch['employee_id']?></td>
		<td><?php echo $fetch['firstname'] ?> <?php echo $fetch['lastname'] ?></td>
		<td><?php echo $fetch['DaysofWork']?></td>
		<td></td>
		<td><?php echo $fetch['TotalSalary']?></td>
	</tr>
<?php
			}
		}else{
			echo'
			<tr>
				<td colspan = "4"><center>Record Not Found</center></td>
			</tr>';
		}
	}else{
		$query=mysqli_query($conn, "SELECT * ,SUM(salary) as TotalSalary, COUNT(salary) AS DaysofWork 
		FROM `attendance` 
		INNER JOIN employees ON attendance.employee_id = employees.employee_id 
		GROUP BY attendance.employee_id") or die(mysqli_error());
		while($fetch=mysqli_fetch_array($query)){
?>
	<tr>
		<td><?php echo $fetch['employee_id']?></td>
		<td><?php echo $fetch['firstname'] ?> <?php echo $fetch['lastname'] ?></td>
		<td><?php echo $fetch['DaysofWork']?></td>
		<td></td>
		<td><?php echo $fetch['TotalSalary']?></td>
	</tr>
<?php
		}
	}
?>