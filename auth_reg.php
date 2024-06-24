<?php
	session_start();
	include 'config.php';

	if (isset($_POST['regist'])) {
		$name = mysqli_real_escape_string($connect,$_POST['fullname']);
	    $user = mysqli_real_escape_string($connect,$_POST['username']);
        $pass = mysqli_real_escape_string($connect,$_POST['password']);
	    $confirm = mysqli_real_escape_string ($connect,$_POST['confirm']);
	 
	    if ($pass == $confirm) {
	        $sql = "SELECT * FROM users WHERE username='$user'";
	        $result = mysqli_query($connect, $sql);
	        if (!$result->num_rows > 0) {
	            $sql = "INSERT INTO users (username, password, fullname, status)
	                    VALUES ('$user', MD5('$pass'), '$name', '2')";
	            $result = mysqli_query($connect, $sql);
                if ($result) {
					echo "<script language=\"JavaScript\">\n";
					echo "alert('Selamat, registrasi berhasil!');\n";
					echo "window.location='index.php'";
					echo "</script>";
                } else {
                    echo "<script language=\"JavaScript\">\n";
                    echo "alert('Woops! Terjadi kesalahan.');\n";
                    echo "window.location='regist.php'";
                    echo "</script>";
                }
	        } else {
	            echo "<script>alert('Woops! Username Sudah Terdaftar.')</script>";
	        }
	         
	    } else {
	        echo "<script>alert('Password Tidak Sesuai')</script>";
	    }
	}
?>