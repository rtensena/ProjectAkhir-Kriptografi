<?php
include('../config.php');

error_reporting(0);
session_start();

if(!isset($_SESSION['username'])){
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
    $query = mysqli_query($connect,"SELECT fullname,last_activity FROM users WHERE username='$user'");
    $data = mysqli_fetch_array($query);
    ?>
    <head>
    <!-- Theme Made By www.w3schools.com -->
    <title>Dashboard Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="shortcut icon" type="image/x-icon" href="logo.png">
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
                <li><a href="#dashboard">DASHBOARD</a></li>
                <li><a href="#decrypt">DECRYPT FILE</a></li>
                <li><a href="#message">MESSAGE</a></li>
                <li><a href="logout.php">LOGOUT</a></li>
            </ul>
        </div>
    </div>
    </nav>

    <div class="jumbotron text-center">
    <h1>Employee Data Security</h1>
    </div>

    <!-- Container (Dashboard Section) -->
    <div id="dashboard" class="container-fluid">
        <div class="row">
            <div>
                <h2>Dashboard Page</h2><br>
                <div class="row slideanim">
                    <div class="col-sm-4 text-center">
                        <h4>USER</h4>
                        <?php
                            $query = mysqli_query($connect,"SELECT count(*) totaluser FROM users WHERE kode='2'");
                            $datauser = mysqli_fetch_array($query);
                        ?>
                        <h2 class="text-center no-margin"><?php echo $datauser['totaluser']; ?></h2>
                    </div>
                    <div class="col-sm-4 text-center">
                        <h4>ENCRYPT</h4>
                        <?php
                            $query = mysqli_query($connect,"SELECT count(*) totalencrypt FROM file WHERE status='1'");
                            $dataencrypt = mysqli_fetch_array($query);
                        ?>
                        <h2 class="text-center no-margin"><?php echo $dataencrypt['totalencrypt']; ?></h2>
                    </div>
                    <div class="col-sm-4 text-center">
                        <h4>DECRYPT</h4>
                        <?php
                            $query = mysqli_query($connect,"SELECT count(*) totaldecrypt FROM file WHERE status='2'");
                            $datadecrypt = mysqli_fetch_array($query);
                            ?>
                        <h2 class="text-center no-margin"><?php echo $datadecrypt['totaldecrypt']; ?></h2>
                    </div>
                </div>
                <br><br>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th class="text-center">Username</th>
                            <th class="text-center">Nama File</th>
                            <th class="text-center">Nama File Enkripsi</th>
                            <th class="text-center">Ukuran File</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $query = mysqli_query($connect,"SELECT * FROM file");
                            while ($data = mysqli_fetch_array($query)) { ?>
                            <tr>
                                <td class="text-center"><?php echo $data['username']; ?></td>
                                <td class="text-center"><?php echo $data['file_name_source']; ?></td>
                                <td class="text-center"><?php echo $data['file_name_finish']; ?></td>
                                <td class="text-center"><?php echo $data['file_size']; ?> KB</td>
                                <td class="text-center"><?php echo $data['tgl_upload']; ?></td>
                                <td class="text-center"><?php if ($data['status'] == 1) {
                                    echo "<span>Terenkripsi</span>";
                                    }elseif ($data['status'] == 2) {
                                        echo "<span>Sudah Didekripsi</span>";
                                    }else {
                                        echo "<span>Status Tidak Diketahui</span>";
                                    }
                                ?></td>
                            </tr>
                            <?php
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Container (Decrypt Section) -->
    <div id="decrypt" class="container-fluid text-center bg-grey">
        <h2>Decrypt Page</h2>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="text-center">ID File</th>
                        <th class="text-center">Nama File Sumber</th>
                        <th class="text-center">Nama File Enkripsi</th>
                        <th class="text-center">Path File</th>
                        <th class="text-center">Status File</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = mysqli_query($connect,"SELECT * FROM file");
                    while ($data = mysqli_fetch_array($query)) { ?>
                    <tr>
                        <td class="text-center"><?php echo $data['id_file']; ?></td>
                        <td class="text-center"><?php echo $data['file_name_source']; ?></td>
                        <td class="text-center"><?php echo $data['file_name_finish']; ?></td>
                        <td class="text-center"><?php echo $data['file_url']; ?> KB</td>
                        <td class="text-center"><?php if ($data['status'] == 1) {
                            echo "Enkripsi";
                        }elseif ($data['status'] == 2) {
                            echo "Dekripsi";
                        }else {
                            echo "Status Tidak Diketahui";
                        }
                        ?></td>
                        <td class="text-center"><?php 
                        $a = $data['id_file'];
                        if ($data['status'] == 1) {
                            echo '<a href="decrypt-file.php?id_file='.$a.'" class="btn btn-primary">Dekripsi File</a>';
                        }elseif ($data['status'] == 2) {
                            echo "-";
                        }else {
                            echo '<a href="#decrypt" class="btn btn-danger">Data Tidak Diketahui</a>';
                        } 
                        ?></td>
                    </tr>
                    <?php
                    } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Container (Super Enkrip Section) -->
    <div id="message" class="container-fluid text-center">
    <h2>Message</h2><br>
    <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Kritik dan Saran Terenkripsi</th>
                        <th class="text-center">Pesan Kritik dan Saran</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = mysqli_query($connect,"SELECT * FROM kritik");
                    while ($data = mysqli_fetch_array($query)) { ?>
                    <tr>
                        <td class="text-center"><?php echo $data['id']; ?></td>
                        <td class="text-justify"><?php echo $data['kritik']; ?></td>
                        <td class="text-center"><?php echo $data['pesan'];?></td>
                    </tr>
                    <?php
                    } ?>
                </tbody>
            </table>
        </div>

    <footer class="container-fluid text-center bg-grey">
    <a href="#myPage" title="To Top">
        <span class="glyphicon glyphicon-chevron-up"></span>
    </a>
    <p>Ernisa Rahma Wahyuni - 123200003</p>
    </footer>

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