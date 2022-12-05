<?php
    include ('../database.php');
    $id = $_GET['id'];
    $qry = mysqli_query($conn,"SELECT * from users where id='$id'");
    $data = mysqli_fetch_array($qry);
    if(isset($_POST['upgrade'])){
        $roles = $_POST['usertype'];
        $edit = mysqli_query($conn," UPDATE users SET user_type = '$roles' where id = '$id'");
        if($edit)
        {
            mysqli_close($conn); // Close connection
            header("location:viewuserdetails.php"); // redirects to all records page
            exit;
        }
        else
        {
            echo mysqli_error();
        }    	
    }
?>
<h3>Update Data</h3>
<form method="POST">
  <input type="text" name="usertype" value="<?php echo $data['user_type'] ?>" placeholder="Enter Roles" Required>
  <input type="submit" name="upgrade" value="Update">
</form>