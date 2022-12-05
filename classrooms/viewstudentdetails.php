<?php
session_start();
if ( $_SESSION[ "username" ] == "" || $_SESSION[ "username" ] == NULL ) {
	header( 'Location:login.php' );
}
$username = $_SESSION[ "username" ];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
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
          <li class="nav-item active">
            <a class="nav-link" href="#">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Create Class</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="viewstudentdetails.php">Manage Student</a>
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
		<div class="col-md-5">

			<h3> Welcome Teachers : <a href="teacher.php"><span style="color:#FF0004"> <?php echo $username; ?></span></a></h3>
			<?php
			include( "database.php" );
			$sql = "SELECT * from  `users` WHERE user_type ='student' ";
			$result = mysqli_query( $conn, $sql );
			echo "<h2 class='page-header'>Student Details</h2>";
			//below will print all student details to admin
			echo "<table class='table table-striped' style='width:100%'>
<tr>
<th>ID</th>
<th>User Name</th>
<th>Password</th>
<th>Name</th>
<th>Email</th>
</tr>";
			while ( $row = mysqli_fetch_array( $result ) ) {
				?>

			<tr>
				<td>
					<?PHP echo $row['id'];?>
				</td>
				<td>
					<?PHP echo $row['username'];?>
				</td>
				<td>
					<?PHP echo $row['password'];?>
				</td>
				<td>
					<?PHP echo $row['name'];?>
				</td>
				<td>
					<?PHP echo $row['email'];?>
				</td>
			</tr>
			<?php } ?>
			</table>
		</div>
	</div>
</body>
</html>