<?php
session_start();
include 'config.php';

$error='';
if (isset($_POST['login'])){
    if	(empty($_POST['username']) || empty($_POST['password'])) {
        $error = "Username or Password Tidak Valid!";
    }else{
        $user = mysqli_real_escape_string($connect,$_POST['username']);
        $pass = mysqli_real_escape_string($connect,$_POST['password']);

        $query = "SELECT username,password,status FROM users WHERE username='$user' AND password=md5('$pass') AND status=1";
        $sql = mysqli_query($connect,$query);
        $rows = mysqli_fetch_array($sql);

        $query1 = "SELECT username,password,status FROM users WHERE username='$user' AND password=md5('$pass') AND status=2";
        $sql1 = mysqli_query($connect,$query1);
        $rows1 = mysqli_fetch_array($sql1);
        if ($rows) {
            $_SESSION['username']=$user;
            header("location: dashboard/dashadmin.php");
        } else if ($rows1) {
            $_SESSION['username']=$user;
            header("location: dashboard/dashboard.php");
        } else { 
            echo "<script language=\"JavaScript\">\n";
            echo "alert('Username atau Password Salah!');\n";
            echo "window.location='index.php'";
            echo "</script>";
        }
    }
}
?>