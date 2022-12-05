<?php
include('auth.php');
include('database.php')
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit Assignment</title>
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

			<h3> Welcome Teacher : <a href="welcomefaculty.php" ><span style="color:#FF0004"> <?php echo $_SESSION['username'];  ?></span></a> </h3>

			<?php
			include( 'database.php' );
			$make = $_GET[ 'editassid' ];
			//selecting data form assessment details table form database
			$sql = "SELECT * FROM examdetails WHERE ExamID=$make";
			$rs = mysqli_query( $conn, $sql );
			while ( $row = mysqli_fetch_array( $rs ) ) {
				?>
			<fieldset>
				<legend><a href="manageassessment.php" >Edit Assessment</a></legend>
				<form action="" method="POST" name="UpdateAssessment">
					<table class="table">

						<tr>
							<td><strong>Exam ID</strong>
							</td>
							<td>
								<?php $ExamID=$row['ExamID']; echo $ExamID; ?>
							</td>

						</tr>
						<tr>
						<td><strong>Exam Name</strong>
							</td>
							<td>
							<textarea name="ExamName" rows="1" cols="50"><?php $ExamName=$row['ExamName']; echo $ExamName; ?></textarea>
							</td>
							
						</tr>	
						<tr>
							<td><strong>Q1</strong>
							</td>
							<td>
							<textarea name="Q1" rows="5" cols="150"><?php $Q1=$row['Q1']; echo $Q1; ?></textarea>
							</td>
						</tr>	
							<tr>
							<td><strong>Q2</strong>
							</td>
							<td>
							<textarea name="Q2" rows="5" cols="150"><?php $Q2=$row['Q2']; echo $Q2; ?></textarea>
							</td>
						</tr>	
							<tr>
							<td><strong>Q3</strong>
							</td>
							<td>
							<textarea name="Q3" rows="5" cols="150"><?php $Q3=$row['Q3']; echo $Q3; ?></textarea>
							</td>
						</tr>	
							<tr>
							<td><strong>Q4</strong>
							</td>
							<td>
							<textarea name="Q4" rows="5" cols="150"><?php $Q4=$row['Q4']; echo $Q4; ?></textarea>
							</td>
						</tr>	
							<tr>
							<td><strong>Q5</strong>
							</td>
							<td>
							<textarea name="Q5" rows="5" cols="150"><?php $Q5=$row['Q5']; echo $Q5; ?></textarea>
							</td>
						</tr>	
							
						<td><button type="submit" name="update" class="btn btn-primary">Update</button>
						</td>
						<?php
						}
						?>
						<?php 

							if(isset($_POST['update']))
							{
							
							$E_name= $_POST['ExamName'];
							$Q_1= $_POST['Q1'];
							$Q_2= $_POST['Q2'];
							$Q_3= $_POST['Q3'];
							$Q_4= $_POST['Q4'];
							$Q_5= $_POST['Q5'];

							$sql = "UPDATE `examdetails` SET ExamName='$E_name' , Q1='$Q_1' , Q2='$Q_2' , Q3='$Q_3', Q4='$Q_4', Q5='$Q_5' WHERE ExamID=$make";

							if (mysqli_query($conn, $sql)) {
								echo "
								<br><br>
								<div class='alert alert-success fade in'>
								<a href='manageassessment.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
								<strong>Success!</strong> Assessment Updated.
								</div>
								";
								} else {
								//error message if SQL query fails
								echo "<br><Strong>Assessment Updation Faliure. Try Again</strong><br> Error Details: " . $sql . "<br>" . mysqli_error($conn);

								//close the connion
								mysqli_close($conn);
								}
							}
							?> 
					</table>
				</form>
			</fieldset>
		</div>
	</div>
</body>
</html>
