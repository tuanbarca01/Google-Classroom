<?php
session_start();
include('database.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
{   
    header('location:index.php');
}
else{
    if(isset($_POST['btn_submit']))
{
    $studentname=$_POST['username'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $ret=mysqli_query($conn,"update users set username='$studentname',email='$email', name='$name' where StudentRegno='".$_SESSION['login']."'");
    if($ret)
    {
        $_SESSION['msg']="Student Record updated Successfully !!";
    }
    else
    {
        $_SESSION['msg']="Error : Student Record not update";
    }   
}
?>