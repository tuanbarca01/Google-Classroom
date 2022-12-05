<?php
session_start();
error_reporting(0);
include('database.php');
include('auth.php');
include('functions.php');
        // if(isset($_POST['submit'])){
        //     $classname=$_POST['classname'];
        //     $coursecode=$_POST['coursecode'];
        //     $coursename=$_POST['coursename'];
        //     $courseunit=$_POST['courseunit'];
        //     $seatlimit=$_POST['seatlimit'];
        //     $ret=mysqli_query($conn,"insert into course(className,courseCode,courseName,courseUnit,noofSeats) values('$classname','$coursecode','$coursename','$courseunit','$seatlimit')");
        //     if($ret){
        //         $_SESSION['msg']="Course Created Successfully !!";
        //     }else{
        //         $_SESSION['msg']="Error : Course not created";
        //     }
        if(isset($_GET['del'])){
            mysqli_query($conn,"delete from course where id = '".$_GET['id']."'");
            $_SESSION['delmsg']="Course deleted !!";
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Course</title>
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
            <a class="nav-link" href="teacher.php">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="viewstudentdetails.php">Account</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Log out</a>
          </li>
        </ul>
      </div>
    </div>
</nav>
    <div class="content-wrapper">
        <div class="container container--margin">
            <!-- <div class="row">
                <div class="col-md-12">
                    <h1 class="page-head-line">Course</h1>
                </div>
            </div>
            <div class="row" >
                <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            
                            <font color="green" align="center">
                                <?php echo htmlentities($_SESSION['msg']);?>
                                <?php echo htmlentities($_SESSION['msg']="");?>
                            </font>

                            <div class="panel-body">
                                <form name="dept" method="post">
                                    <div class="form-group">
                                        <label for="classname">Class Name </label>
                                        <input type="text" class="form-control" id="classname" name="classname" placeholder="Class Name" required />
                                    </div> 
                                    <div class="form-group">
                                        <label for="coursecode">Course Code  </label>
                                        <input type="text" class="form-control" id="coursecode" name="coursecode" placeholder="Course Code" value="<?php echo generateRandomString();?>" readonly/>
                                    </div>

                                    <div class="form-group">
                                        <label for="coursename">Course Name  </label>
                                        <input type="text" class="form-control" id="coursename" name="coursename" placeholder="Course Name" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="courseunit">Course unit  </label>
                                        <input type="text" class="form-control" id="courseunit" name="courseunit" placeholder="Course Unit" required />
                                    </div> 

                                    <div class="form-group">
                                        <label for="seatlimit">Seat limit  </label>
                                        <input type="text" class="form-control" id="seatlimit" name="seatlimit" placeholder="Seat limit" required />
                                    </div>   
                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                </div> -->
                    <font color="red" align="center">
                        <?php echo htmlentities($_SESSION['delmsg']);?>
                        <?php echo htmlentities($_SESSION['delmsg']="");?>
                    </font>
                    <div class="col-md-12">
                        <!--    Bordered Table  -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Manage Course
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive table-bordered">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Class Name</th>
                                                <th>Course Code</th>
                                                <th>Course Name </th>
                                                <th>Course Unit</th>
                                                <th>Seat limit</th>
                                                <th>Creation Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php
$sql=mysqli_query($conn,"select * from course");

while($row=mysqli_fetch_array($sql))
{
?>
    <tr>
        <td><?php echo htmlentities($row['id']);?></td>
        <td><?php echo htmlentities($row['className']);?></td>
        <td><?php echo htmlentities($row['courseCode']);?></td>
        <td><?php echo htmlentities($row['courseName']);?></td>
        <td><?php echo htmlentities($row['courseUnit']);?></td>
        <td><?php echo htmlentities($row['noofSeats']);?></td>
        <td><?php echo htmlentities($row['creationDate']);?></td>
        <td>
        <a href="editcourse.php?id=<?php echo $row['id']?>">
            <button class="btn btn-primary"><i class="fa fa-edit "></i> Edit</button> 
        </a>                                        
        <a href="course.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')">
            <button class="btn btn-danger">Delete</button>
        </a>
        </td>
    </tr>
<?php 

} ?>

                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!--  End  Bordered Table  -->
                    </div>
                </div>
            </div>
        </div>
</body>
</html>

