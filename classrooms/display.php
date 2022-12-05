<?php
include('database.php');
$sql = "select filename from tbl_files";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post</title>
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
        <?php
        $id = -1;
        if (isset($_GET["id"])) {
            $id = intval($_GET['id']);
        }
        // Lấy ra nội dung bài viết theo điều kiện id
        $sql = "select * from posts where id = $id";
        // Thực hiện truy vấn data thông qua hàm mysqli_query
        $query = mysqli_query($conn,$sql);
        ?>
		<div class="innertube">
            <?php 
                
				while ( $data = mysqli_fetch_array($query) ) {
			?>
				<h3>Title: <?php echo $data['title']; ?></h3>
                <button class="add btn btn-primary" data-toggle="modal" data-target="#addCourseModal">
                    <i class="fa fa-plus-circle" aria-hidden="true"> Add File</i>
                </button>
                <button class="add btn btn-primary">
                    <a href="addassessment.php"><i class="fa fa-plus-circle"> Add Assignment</i></a>
                </button>
                </div>
                <hr>
				<i> Ngày tạo : <?php echo $data['createdate']; ?></i>
				<p><h4>Content</h4> <br><?php echo $data['content']; ?></p>
                <div class="row">
                    <div class="col-xs-8 col-xs-offset-2">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>File Name</th>
                                    <th>View</th>
                                    <th>Download</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                while($row = mysqli_fetch_array($result)) { ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $row['filename']; ?></td>
                                    <td><a href="uploads/<?php echo $row['filename']; ?>" target="_blank">View</a></td>
                                    <td><a href="uploads/<?php echo $row['filename']; ?>" download>Download</td>
                                    <th><p><a href="remove.php?name='.$result.'" class="btn btn-danger btn-xs" role="button">Remove</a></p></th>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
			<?php } ?>
			</div>
        </div>
        <div class="modal" tabindex="-1" id="addCourseModal" role="dialog">
            <div class="container">
                <div class="row">
                    <div class="col-xs-8 col-xs-offset-2 well">
                        <form action="uploads.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="file" name="file1" />
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" value="Upload" class="btn btn-info"/>
                            </div>
                            <?php if(isset($_GET['st'])) { ?>
                                <div class="alert alert-danger text-center">
                                <?php if ($_GET['st'] == 'success') {
                                        echo "File Uploaded Successfully!";
                                    }
                                    else
                                    {
                                        echo 'Invalid File Extension!';
                                    } ?>
                                </div>
                            <?php } ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
</body>
</html>
