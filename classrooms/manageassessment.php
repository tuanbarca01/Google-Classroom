<?php
include('auth.php');
include('database.php')
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Manage Assignment</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
    <link rel="stylesheet" href="style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="teacher.php">Classroom</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="course.php">Manage Class</a>
          </li>
		  <li class="nav-item">
            <a class="nav-link" href="manageassessment.php">Manage Assignment</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Log out</a>
          </li>
        </ul>
      </div>
    </div>
</nav>
<div class="container container--margin">
	<div class="row">
		<div class="col-md-8">
			<h3> Welcome Teacher : <a href="teacher.php" ><span style="color:#FF0004"> <?php echo $_SESSION['username'];  ?></span></a> </h3>
			
			<?php
		include( "database.php" );
		if ( isset( $_REQUEST[ 'deleteid' ] ) ) {

			//getting data from another page
			$deleteid = $_GET[ 'deleteid' ];
			$sql = "DELETE FROM `examdetails` WHERE ExamID = $deleteid";
			if ( mysqli_query( $conn, $sql ) ) {
				echo "
						<br><br>
						<div class='alert alert-success fade in'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<strong>Success!</strong> Assessment details deleted.
						</div>
						";
			} else {
				//error message if SQL query fails
				echo "<br><Strong>Assessment Details Updation Faliure. Try Again</strong><br> Error Details: " . $sql . "<br>" . mysqli_error( $conn );
			}
		}
		//close the connion
		mysqli_close( $conn );
		?>
			
			<?php 
				
				include('database.php');
				$sql="SELECT * FROM examdetails";
				$rs=mysqli_query($conn,$sql);
				echo "<h2 class='page-header'>Assessment Details</h2>";
				echo "<table class='table table-striped' style='width:100%'>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Q1</th>
					<th>Q2</th>
					<th>Q3</th>
					<th>Q4</th>
					<th>Q5</th>
					<th>Delete</th>		
					<th>Edit</th>		
				</tr>";
				while($row=mysqli_fetch_array($rs))
				{
				?>
			<tr>
				<td>
					<?PHP echo $row['ExamID'];?>
				</td>
				<td>
					<?PHP echo $row['ExamName'];?>
				</td>
				<td>
					<?PHP echo $row['Q1'];?>
				</td>
				<td>
					<?PHP echo $row['Q2'];?>
				</td>
				<td>
					<?PHP echo $row['Q3'];?>
				</td>
				<td>
					<?PHP echo $row['Q4'];?>
				</td>
				<td>
					<?PHP echo $row['Q5'];?>
				</td>
				
				<td><a href="manageassessment.php?deleteid=<?php echo $row['ExamID']; ?>"> <input type="button" Value="Delete"  class="btn btn-info btn-sm"  data-toggle="modal" data-target="#myModal"></a>
				<td><a href="manageassessment2.php?editassid=<?php echo $row['ExamID']; ?>"> <input type="button" Value="Edit"  class="btn btn-info btn-sm"  data-toggle="modal" data-target="#myModal"></a>
				</td>
				</td>
			</tr>
			<?php
			}
			?>	
			</table>
			
		</div>
	</div>
</body>
</html>
