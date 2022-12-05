<?php
session_start();
include('../functions.php');
if ( $_SESSION[ "username" ] == "" || $_SESSION[ "username" ] == NULL ) {
	header( 'Location:../login.php' );
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
    <link rel="stylesheet" href="../style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-xl navbar-dark bg-danger">
    <a class="navbar-brand" href="admin.php">Classroom</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContentXL" aria-controls="navbarSupportedContentXL" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContentXL">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="admin.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="course.php">Create Class</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="viewuserdetails.php">Manage Users</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="logout.php">Log out</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>
<div class="content-wrapper">
<div class="container">
	<div class="row">
		<div class="col-md-12">

			<h3> Welcome Admin : <a href="admin.php"><span style="color:#FF0004"> <?php echo $username; ?></span></a></h3>
			<?php
			include( "../database.php" );
			$sql = "SELECT * from  `users`";
            $result = mysqli_query( $conn, $sql );
			echo "<h2 class='page-header'>User Details</h2>";
			//below will print all student details to admin
			echo "<table class='table table-striped table-sm' style='width:100%'>
                    <tr>
                    <th>ID</th>
                    <th>User Name</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>User type</th>
                    <th>Make Admin</th>
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
                        <?PHP echo $row['name'];?>
                    </td>
                    <td>
                        <?PHP echo $row['email'];?>
                    </td>
                    <td>
                        <?PHP echo $row['user_type'];?>
                    </td>
                    <td>
                        <a href="update.php?id=<?php echo $row['id']?>">
                            <button type="submit" name="upgrade" id="upgrade" class="btn btn-primary">Upgrade</button>
                        </a>
                    </td>
                </tr>
			    <?php } ?>
			</table>
		</div>
	</div>
</div>

</body>
</html>