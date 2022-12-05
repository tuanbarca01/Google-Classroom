<?php
	include("database.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
    <link rel="stylesheet" href="style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<?php
    session_start();
	if (isset($_POST["btn_submit"])) {
		$username = stripslashes($_REQUEST['username']); // removes backslashes
        $username = mysqli_real_escape_string($conn,$username); //escapes special characters in a string
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($conn,$password);
        $userType = $_POST['user_type'];
		
        $query = "SELECT * FROM `users` WHERE username = ? and password = ? and user_type=? ";
        $stmt = $conn->prepare($query);
        // echo $conn -> error;die;
        $stmt->bind_param("sss", $username, $password, $userType);
        $stmt->execute();
        $result = $stmt->get_Result();
        $row = $result->fetch_assoc();

        session_regenerate_id();
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['user_type'];
        session_write_close();
        if($result->num_rows == 1 && $_SESSION['role'] == "student"){
            header("Location: index.php");
        }
        else if($result->num_rows == 1 && $_SESSION['role'] == "teacher"){
            header("Location: teacher.php");
        }
        else if($result->num_rows == 1 && $_SESSION['role'] == "admin"){
            header("Location: ./admin/admin.php");
        }else{
            $message = "Username or Password is Incorrect!";
            echo "<script type='text/javascript'>alert('$message'); window.location = 'index.php';</script>";
            
        }
	}else{
?>
<div class="container px-4 py-5 mx-auto">
    <div class="card card0">
        <div class="d-flex flex-lg-row flex-column-reverse">
            <div class="card card1">
                <div class="row justify-content-center my-auto">
                    <div class="col-md-8 col-10 my-5">
                        <form action="<?= $_SERVER['PHP_SELF']?>" method="post">
                            <div class="row justify-content-center px-3 mb-3"> <img id="logo" src="https://i.imgur.com/PSXxjNY.png"> </div>
                            <h3 class="mb-5 text-center heading">Classroom</h3>
                            <h6 class="msg-info">Please login to your account</h6>
                            <div class="form-group"> <label class="form-control-label text-muted">Username</label> 
                            <input type="text" id="email" name="username" placeholder="Phone no or email id" class="form-control"> </div>
                            <div class="form-group"> <label class="form-control-label text-muted">Password</label> 
                            <input type="password" id="psw" name="password" placeholder="Password" class="form-control"> </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="user_type" id="exampleRadios1" value="student" checked>
                                <label class="form-check-label" for="exampleRadios1">
                                    Student
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="user_type" id="exampleRadios2" value="teacher">
                                <label class="form-check-label" for="exampleRadios2">
                                    Teacher
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="user_type" id="exampleRadios2" value="admin">
                                <label class="form-check-label" for="exampleRadios2">
                                    Admin
                                </label>
                            </div>
                            <input class="btn-block btn-color id="login" class="btn btn-block login-btn mb-4" type="submit" value="Login" name="btn_submit">
                            <div class="row justify-content-center my-2"> <a href="enteremail.php"><small class="text-muted">Forgot Password?</small></a> </div>
                            
                        </form>
                        
                    </div>
                </div>
                <div class="bottom text-center mb-5">
                    <p href="#" class="sm-text mx-auto mb-3">Don't have an account?<button class="btn btn-white ml-2"><a href="register.php">Create new</a></button></p>
                </div>
            </div>
            <div class="card card2">
                <div class="my-auto mx-md-5 px-md-5 right">
                    <h2 class="text-white">Classroom</h2> <small class="text-white">TDTU</small>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>
</body>
</html>