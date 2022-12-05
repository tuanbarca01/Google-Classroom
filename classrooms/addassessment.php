<?php
include('auth.php')

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Add assignment</title>
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
            <a class="nav-link" href="logout.php">Log out</a>
          </li>
        </ul>
      </div>
    </div>
</nav>
<div class="container container--margin">
	<div class="row">
		<div class="col-md-8">

			<h3> Welcome Teacher </h3>
			<?PHP
		include( "database.php" );
		if ( isset( $_POST[ 'submit' ] ) ) {
			$Aname = $_POST[ 'AssessmentName' ];
			$q1 = $_POST[ 'Q1' ];
			$q2 = $_POST[ 'Q2' ];
			$q3 = $_POST[ 'Q3' ];
			$q4 = $_POST[ 'Q4' ];
			$q5 = $_POST[ 'Q5' ];

			$done = "
					<center>
					<div class='alert alert-success fade in __web-inspector-hide-shortcut__'' style='margin-top:10px;'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close' title='close'>&times;</a>
					<strong><h3 style='margin-top: 10px;
					margin-bottom: 10px;'> Assessment added Sucessfully.</h3>
					</strong>
					</div>
					</center>
					";

			$sql = "INSERT INTO `ExamDetails` (`ExamName`, `Q1`, `Q2`, `Q3`, `Q4`, `Q5`) VALUES ('$Aname','$q1','$q2','$q3','$q4','$q5')";
			//close the connection
			mysqli_query( $conn, $sql );

			echo $done;
		}

		?>
		
			<fieldset>
				<legend><a href="addassessment.php">Add Assignment</a></legend>
				<form action="" method="POST" name="AddAssessment">
					<table class="table">

						<tr>
							<td><strong>Assignment Name  </strong>
							</td>
							<td>
								<input type="text" name="AssessmentName">
							</td>

						</tr>
						<tr>
							<td><strong>Question 1</strong> </td>
							<td>
								<textarea name="Q1" rows="5" cols="150"></textarea>
							</td>
						</tr>
						<tr>
							<td><strong>Question 2</strong> </td>
							<td>
								<textarea name="Q2" rows="5" cols="150"></textarea>
							</td>
						</tr>
						<tr>
							<td><strong>Question 3</strong> </td>
							<td>
								<textarea name="Q3" rows="5" cols="150"></textarea>
							</td>
						</tr>
						<tr>
							<td><strong>Question 4</strong> </td>
							<td>
								<textarea name="Q4" rows="5" cols="150"></textarea>
							</td>
						</tr>
						<tr>
							<td><strong>Question 5</strong> </td>
							<td>
								<textarea name="Q5" rows="5" cols="150"></textarea>
							</td>
						</tr>
						
						<td><button type="submit" name="submit" class="btn btn-primary">Add Assignment</button>
						</td>
						
					</table>
				</form>
			</fieldset>
		</div>
	</div>
</body>
</html>
