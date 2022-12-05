<?php
require_once("database.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
    <link rel="stylesheet" href="style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<?php
    if(isset($_POST["btn_submit"])) {
        $username = $_POST["username"];
        $password = $_POST["pass"];
        $name = $_POST["name"];
        $email = $_POST["email"];
        if ($username == "" || $password == "" || $name == "" || $email == "") {
            echo "bạn vui lòng nhập đầy đủ thông tin";
        }else{
            $sql="select * from users where username='$username'";
            $kt=mysqli_query($conn, $sql);
            if(mysqli_num_rows($kt)  > 0){
                echo "<div class='alert alert-primary' role='alert'>
                Tài khoản đã tồn tại <a href='#' class='alert-link'></a>
              </div>";
            }else{
                $sql = "INSERT INTO users(
                    username,
                    password,
                    name,
                    email,
                    user_type
                    ) VALUES (
                    '$username',
                    '$password',
                    '$name',
                    '$email',
                    'student'
                    )";
                mysqli_query($conn,$sql);
                echo "<div class='alert alert-primary' role='alert'>
                Bạn đã đăng ký thành công<a href='login.php' class='alert-link'>Login here</a>
              </div>";
            }
        }
	}
?>
<div class="container">
    <div class="row">
      <div class="col-lg-10 col-xl-9 mx-auto">
        <div class="card card-signin flex-row my-5">
          <div class="card-img-left d-none d-md-flex">
             <!-- Background image for card set in CSS! -->
          </div>
          <div class="card-body">
            <h5 class="card-title text-center">Register</h5>
            <form class="form-signin" action="register.php" method="post">
              <div class="form-label-group">
                <input type="text" id="inputUserame" class="form-control" name="username" placeholder="Username" required autofocus>
                <label for="inputUserame"></label>
              </div>

              <div class="form-label-group">
                <input type="password" id="inputPassword" class="form-control" name="pass" placeholder="Your Password" required>
                <label for="inputPassword"></label>
              </div>
              
              <hr>

              <div class="form-label-group">
                <input type="text" id="inputName" name="name" class="form-control" placeholder="Your Name" required>
                <label for="inputName"></label>
              </div>
              
              <div class="form-label-group">
                <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email" required>
                <label for="inputEmail"></label>
              </div>

              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name="btn_submit">Register</button>
              <a class="d-block text-center mt-2 small" href="login.php">Sign In</a>
              <hr class="my-4">
              <button class="btn btn-lg btn-google btn-block text-uppercase" type="submit"><i class="fab fa-google mr-2"></i> Sign up with Google</button>
              <button class="btn btn-lg btn-facebook btn-block text-uppercase" type="submit"><i class="fab fa-facebook-f mr-2"></i> Sign up with Facebook</button>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>
</body>
</html>