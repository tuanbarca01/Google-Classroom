<?php
include ('../auth.php');
include ('../database.php');
include ('../functions.php')
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
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
            <li class="list-inline-item">
            <button class="add btn btn-primary" data-toggle="modal" data-target="#addCourseModal">
                <i class="fa fa-plus-circle" aria-hidden="true"></i>
            </button>
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
<div class="container">
    <header class="jumbotron my-4">
      <h1 class="display-3">Welcome <?php echo $_SESSION['username'];  ?></h1>
      <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, ipsam, eligendi, in quo sunt possimus non incidunt odit vero aliquid similique quaerat nam nobis illo aspernatur vitae fugiat numquam repellat.</p>
      <a href="course.php" class="btn btn-primary btn-lg">Manage Class</a>
    </header>
    <?php
  $course = $conn->query('select * from course');
?>
<?php
  foreach ($course as $item) {
    
    // echo "<pre>";
    // print_r ($item);
    // echo "</pre>";?>
    
    <div class="row text-center">
      <div class="col-lg-3 col-md-6 mb-4">
          <div class="card h-100">
            <!-- <img class="card-img-top" src="http://placehold.it/500x325" alt=""> -->
            <div class="card-body">
                <a href="#"><h4 class="card-title"><?php echo $item['className'];  ?></h4></a>
                <p class="card-text"><?php echo $item['courseName']; ?></p>
                <p class="card-text"><?php echo $item['courseCode']; ?></p>
            </div>
            <div class="card-footer">
              <a href="classpage.php" class="btn btn-primary">Manage</a>
            </div>
          </div>
      </div>
    </div>


<?php  }?>
<div class="modal" tabindex="-1" id="addCourseModal" role="dialog">
      <form class="modal-dialog" role="document" action="teacher.php" method="post">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Create course</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <div class="form-group">
                <input type="text" class="form-control" name="id" placeholder="ID"/>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="class_name" placeholder="Class Name"/>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="course_name" placeholder="Course Name"/>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="course_code" value="<?php echo generateRandomString();?>" readonly/>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button name="create" type="submit" class="btn btn-primary">Create</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </form>
    </div>
    <?php	
      if (isset($_POST["create"])) 
      {
        //get form information
        $id = $_POST["id"];
  			$course_code = $_POST["course_code"];
  			$class_name = $_POST["class_name"];
 			  $course_name = $_POST["course_name"];
			

  			//test
			  if ($id == "" || $course_code == "" || $class_name == "" || $course_name == "") {
          echo "please, enter your information";
       }else{
           // test account exist
         $sql1="SELECT * FROM course WHERE id='$id'";
         $kt=mysqli_query($conn, $sql1);

         if(mysqli_num_rows($kt)  > 0){
           echo "subjects exist";
         }else{
               $sql = "INSERT INTO course(
               id,
               courseCode,
               className,
               courseName
               ) VALUES (
               '$id',
               '$course_code',
               '$class_name',
               '$course_name'
               )";
              mysqli_query($conn,$sql);
             
             header("Location: admin.php");
             }
					
        }
      }
?>
</div>
</body>
</html>