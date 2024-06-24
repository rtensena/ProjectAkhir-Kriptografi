<?php
include('../config.php');

error_reporting(0);
session_start();

if(empty($_SESSION['username'])){
    header("location:../admin.php");
}

$last = $_SESSION['username'];
$sqlupdate = "UPDATE admin SET last_activity=now() WHERE username='$last'";
$queryupdate = mysqli_query($connect,$sqlupdate);
?>

<!DOCTYPE html>
<html>
    <?php
    $user = $_SESSION['username'];
    $query = mysqli_query($connect,"SELECT fullname,last_activity FROM admin WHERE username='$user'");
    $data = mysqli_fetch_array($query);
    ?>
    <head>
    <!-- Theme Made By www.w3schools.com -->
    <title>Dashboard || Kriptografi</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    
    </head>
    <body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

    <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>                        
            </button>
            <a class="navbar-brand" href="#myPage"><?php echo $data['fullname']; ?></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="dashadmin.php">DASHBOARD</a></li>
                <li><a href="#decrypt">DECRYPT FILE</a></li>
                <li><a href="logout.php">LOGOUT</a></li>
            </ul>
        </div>
    </div>
    </nav>

    <div id="decrypt" class="container-fluid">
        <h2 class="text-center">Decrypt Page</h2>
        <div class="table-responsive">
        <?php
        $id_file = $_GET['id_file'];
        $query = mysqli_query($connect,"SELECT * FROM file WHERE id_file='$id_file'");
        $data2 = mysqli_fetch_array($query);
        ?>
        <h3 class="text-center" style="color:#000000;">Dekripsi File <i style="color:red"><?php echo $data2['file_name_finish'] ?></i></h3><br>
        <form class="form-horizontal" method="post" action="decrypt-process.php">
            <div class="table-responsive">
                <table class="table table-striped" style="color:#000000;">
                    <tr>
                        <td>Nama File Sumber</td>
                        <td>:</td>
                        <td><?php echo $data2['file_name_source']; ?></td>
                    </tr>
                    <tr>
                        <td>Nama File Enkripsi</td>
                        <td>:</td>
                        <td><?php echo $data2['file_name_finish']; ?></td>
                    </tr>
                    <tr>
                        <td>Ukuran File</td>
                        <td>:</td>
                        <td><?php echo $data2['file_size']; ?> KB</td>
                    </tr>
                    <tr>
                        <td>Tanggal Enkripsi</td>
                        <td>:</td>
                        <td><?php echo $data2['tgl_upload']; ?></td>
                    </tr>
                    <tr>
                        <td>Keterangan</td>
                        <td>:</td>
                        <td><?php echo $data2['keterangan']; ?></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td>:</td>
                        <td style="color:red"><?php echo $data2['key']; ?></td>
                    </tr>
                    <tr>
                        <td>Masukkan Password Untuk Mendekrip</td>
                        <td></td>
                        <td>
                            <div class="col-md-6">
                                <input type="hidden" name="fileid" value="<?php echo $data2['id_file'];?>">
                                <input class="form-control" id="inputPassword" type="password" placeholder="Password" name="pwdfile" required><br>
                                <input type="submit" name="decrypt_now" value="Dekripsi File" class="form-control btn btn-primary">
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </form>
    </div>
    <script>
    $(document).ready(function(){
    // Add smooth scrolling to all links in navbar + footer link
    $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
        // Make sure this.hash has a value before overriding default behavior
        if (this.hash !== "") {
        // Prevent default anchor click behavior
        event.preventDefault();

        // Store hash
        var hash = this.hash;

        // Using jQuery's animate() method to add smooth page scroll
        // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
        $('html, body').animate({
            scrollTop: $(hash).offset().top
        }, 900, function(){
    
            // Add hash (#) to URL when done scrolling (default click behavior)
            window.location.hash = hash;
        });
        } // End if
    });
    
    $(window).scroll(function() {
        $(".slideanim").each(function(){
        var pos = $(this).offset().top;

        var winTop = $(window).scrollTop();
            if (pos < winTop + 600) {
            $(this).addClass("slide");
            }
        });
    });
    })
    </script>
    </body>
</html>