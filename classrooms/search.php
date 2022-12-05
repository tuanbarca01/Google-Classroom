<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Class</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
    <link rel="stylesheet" href="style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top ">
    <div class="container">
      <a class="navbar-brand" href="index.php">Classroom</a>
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
            <a class="nav-link" href="#">Join Class</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Account</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Log out</a>
          </li>
          <form class="form-inline" action="search.php" method="get">
            <input class="form-control mr-sm-2" type="search" placeholder="Search class" aria-label="Search" name="search">
            <button class="btn btn-outline-danger my-2 my-sm-0" type="submit" name="ok">Search</button>
          </form>
        </ul>
      </div>
    </div>
  </nav>
</body>
</html>
<?php
if (isset($_REQUEST['ok'])) 
{
    // Gán hàm addslashes để chống sql injection
    $search = addslashes($_GET['search']);

    // Nếu $search rỗng thì báo lỗi, tức là người dùng chưa nhập liệu mà đã nhấn submit.
    if (empty($search)) {
        echo "Yeu cau nhap du lieu vao o trong";
    } 
    else
    {
        // Kết nối sql
        include("database.php");
        // Dùng câu lênh like trong sql và sứ dụng toán tử % của php để tìm kiếm dữ liệu chính xác hơn.
        $query = "select * from course where courseCode like '%$search%'";

        // Thực thi câu truy vấn
        $sql = mysqli_query($conn,$query);

        // Đếm số đong trả về trong sql.
        $num = mysqli_num_rows($sql);

        // Nếu có kết quả thì hiển thị, ngược lại thì thông báo không tìm thấy kết quả
        if ($num > 0 && $search != "") 
        {
            // Dùng $num để đếm số dòng trả về.
            echo "<div class='container container--margin'><p>$num Result with: <b>$search</b></p></div>";

            // Vòng lặp while & mysql_fetch_assoc dùng để lấy toàn bộ dữ liệu có trong table và trả về dữ liệu ở dạng array.
            echo '<div class="container">
                    <table border="1" cellspacing="0" cellpadding="10">';
            while ($row = mysqli_fetch_assoc($sql)) {
                echo '<tr>';
                  echo'<th>ID</th>';
                  echo'<th>Class Name</th>';
                  echo'<th>Course Name</th>';
                  echo'<th>Course Unit</th>';
                  echo'<th>Seats</th>';
                  echo'<th>Creation Date</th>';
                echo'</tr>';
                echo '<tr>';  
                    echo "<td>{$row['id']}</td>";
                    echo "<td>{$row['className']}</td>";
                    echo "<td>{$row['courseName']}</td>";
                    echo "<td>{$row['courseUnit']}</td>";
                    echo "<td>{$row['noofSeats']}</td>";
                    echo "<td>{$row['creationDate']}</td>";
                echo '</tr>';
            }
            echo '</table></div>';
        } 
        else {
            echo "<div class='container container--margin'><p>Không tìm thấy kết quả</p></div>";
        }
    }
}
?>   