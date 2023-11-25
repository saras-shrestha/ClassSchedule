<?php require_once('../Session/sessioncheck.php'); ?>
<?php 
	include('../includes/connection.php');
?>
<!DOCTYPE html>
<html>
<head>
	<!--start title-->
	    <?php 	include_once('../includes/title.php'); ?>
	<!--end title-->
	<link href="../css/admin.css" rel="stylesheet" type="text/css">	
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.0/css/jquery.dataTables.min.css">
</head>
<body> 
	<!-- navbar start -->
	<!-- navbar start -->
        <?php include_once('../includes/Admin-navbar.php'); ?>
         <!-- navbar end-->
	<!-- navbar end -->

    <div class="container"> 
    	<!--Start header-->
        <div class="header">
	        <div class="welcome-note">
	            <h3>Faculty</h3>
	        </div>

	        <div class="logout">
	            <a href="../logout.php">LogOut</a>
	        </div>
		</div>
	    <!--End header-->

        <div class="main-content">
          	<div class="display">
            <?php 
			$sql="SELECT * FROM faculty";
			$qry=mysqli_query($conn,$sql) or die (mysqli_error($conn));
			$count=mysqli_num_rows($qry);
			if($count>=1)
			{
				echo "<table border='1' cellspacing='0' id='myTable'>";
				echo "<thead><tr>
						<th>S.N.</th>
						<th>Faculty ID</th>
						<th>Name</th>
						<th>User Name</th>
						<th>Email</th>
						<th>Phone</th>
						<th>Loads</th>	
						<th>Status</th>									
					</tr></thead>";
				$i=0;
				echo "<tbody>";
				while($rows=mysqli_fetch_array($qry))
				{
					echo "<tr>
							<td>".++$i."</td>
							<td>".$rows['fid']."</td>
							<td>".$rows['fname']."</td>";						

						$sql_stat="SELECT * FROM users WHERE uid=".$rows['user_id'];
						$myqry=mysqli_query($conn,$sql_stat) or die (mysqli_error($conn));
						$count=mysqli_num_rows($myqry);
						if($count==1)
						{	
							$row=mysqli_fetch_array($myqry);

							echo "<td>".$row['username']."</td>
								  <td>".$row['email']."</td>
								  <td>".$row['phone']."</td>";
						}
						echo "<td>".$rows['loads']."</td>
						<td>";
							if($row['status']==1){
								echo "Active";
							}
							else{
								echo "Inactive";
							}
							echo "</td>
						</tr>";
				}
				echo "</tbody>";
				echo "</table>";
			}
			else
			{
				echo "Record Not Found";
			}
			?>
	    	</div>
	    </div>
    </div>

    <script
	  src="https://code.jquery.com/jquery-3.6.0.min.js"
	  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
	  crossorigin="anonymous">
	</script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript">
		$(document).ready( function () {
	    $('#myTable').DataTable();
	} );
	</script>

</body>
</html>