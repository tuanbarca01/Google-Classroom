<?php
    error_reporting(0);
    include ('auth.php');
    include ('database.php');
    $id=intval($_GET['id']);
    $currentTime = date( 'd-m-Y h:i:s A', time () );
    if(isset($_POST['submit']))
    {
        $title=$_POST['title'];
        $content=$_POST['content'];
        $ret=mysqli_query($conn,"update posts set title='$title',content='$content',updatedate='$currentTime' where id='$id'");
        if($ret){
            $_SESSION['msg']="Course Updated Successfully !!";
        }else{
            $_SESSION['msg']="Error : Course not Updated";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
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
            <a class="nav-link" href="classpage.php">Manage Post</a>
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
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-head-line">Post <?php echo $id; ?>  </h1>
            </div>
        </div>
        <div class="row" >
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Post 
                    </div>
                    <font color="green" align="center">
                        <?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
                    </font>
                    <div class="panel-body">
                        <form name="dept" method="post" id="form1">
                            <?php
                            $sql=mysqli_query($conn,"select * from posts where id='$id'");
                            $cnt=1;
                            while($row=mysqli_fetch_array($sql))
                            {
                            ?>
                            <p><b>Last Updated at</b> :<?php echo htmlentities($row['updatedate']);?></p>
                            <div class="form-group">
                                <label for="classname">Title  </label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="New Title" value="<?php echo htmlentities($row['title']);?>" required />
                            </div>
                            <div class="form-group">
                                <label for="coursecode">Content  </label>
                                <textarea class="form-control" rows="10" cols="150" id="content" name="content" required><?php echo htmlentities($row['content']);?></textarea>
                            </div>
                                <button type="submit" name="submit" class="btn btn-primary">Update</button>
                            
                            <?php } ?>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="main.js"></script>
</body>
</html>