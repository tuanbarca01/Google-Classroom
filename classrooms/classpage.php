<?php
    include ('auth.php');
    include ('database.php');
    if(isset($_GET['del'])){
      mysqli_query($conn,"delete from posts where id = '".$_GET['id']."'");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class</title>
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
    <ul class="list-inline">
        <li class="list-inline-item">
          <button class="add btn btn-primary" data-toggle="modal" data-target="#addCourseModal">
            <i class="fa fa-plus-circle" aria-hidden="true"> New Post</i>
          </button>
        </li>
    </ul>
</div>

<div class="modal" tabindex="-1" id="addCourseModal" role="dialog">
      <form class="modal-dialog" role="document" action="classpage.php" method="post" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">New Post</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <table>
              <tr>
                <td colspan="2"><h3>Th??m b??i vi???t m???i</h3></td>
              </tr>	
              <tr>
                <td nowrap="nowrap">Ti??u ????? b??i vi???t :</td>
                <td><input type="text" id="title" name="title"></td>
              </tr>
              <tr>
                <td nowrap="nowrap">N???i dung :</td>
                <td><textarea name="content" id="content" rows="10" cols="150"></textarea></td>
              </tr>
            </table>		
          </div>
          <div class="modal-footer">
            <button name="btn_submit" type="submit" class="btn btn-primary">Upload</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </form>
</div>
<?php
	if (isset($_POST["btn_submit"])) {
    //l???y th??ng tin t??? c??c form b???ng ph????ng th???c POST
    // $id = $_POST["id"];
		$title = $_POST["title"];
		$content = $_POST["content"];
		$user_id = $_SESSION["username"];

		$sql = "INSERT INTO posts(title, content, username, createdate, updatedate) VALUES ('$title', '$content', '$user_id',now(), now())";
		// th???c thi c??u $sql v???i bi???n conn l???y t??? file connection.php
		mysqli_query($conn,$sql);
		echo "B??i vi???t ???? th??m th??nh c??ng";
	}
?>

        
  <div class="container">
        <?php
          $sql = "select * from posts where id order by createdate desc limit 16";
          $query = mysqli_query($conn,$sql);
        ?>
        <?php
          // Kh???i t???o bi???n ?????m $i = 0
          $i = 0;
          // L???p d??? li???u l???y data t??? c?? s??? d??? li???u
          while ( $data = mysqli_fetch_array($query) ) {
            // N???u bi???n ?????m $i = 4, t???c l?? v??ng l???p ch???y t???i b??i vi???t th??? t?? th?? ta th???c hi???n xu???ng h??ng cho b??i vi???t k??? ti???p
            // V?? m???i d??ng hi???n th???, ta ch??? hi???n th??? 4 b??i vi???t
            if ($i == 4) {
              echo "</tr>";
              $i = 0;
            }
        ?>
        <div class="row">
          <div class="col-md-8">

            <h1 class="my-4">List Post
            </h1>
          <!-- Blog Post -->
            <div class="card mb-4">
              <!-- <img class="card-img-top" src="http://placehold.it/750x300" alt="Card image cap"> -->
              <div class="card-body">
                <h2 class="card-title"><?php echo $data["title"];?></h2>
                <p class="card-text"><?php echo substr($data["content"], 0, 100)." ...";?></p>
                <a href="display.php?id=<?php echo $data["id"];?>" class="btn btn-primary">Read More &rarr;</a>
                <a href="editpost.php?id=<?php echo $data["id"];?>" class="btn btn-primary">Edit</a>
                <a href="classpage.php?id=<?php echo $data['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')">
                    <button class="btn btn-danger">Delete</button>
                </a>
              </div>
            </div>
          </div>	
        </div>
        <?php
            $i++;
          }
        ?>
    
  </div>
<script type="text/javascript" src="main.js"></script>
</body>
</html>