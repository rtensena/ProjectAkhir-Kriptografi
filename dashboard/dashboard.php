<?php
include('../config.php');

error_reporting(0);
session_start();

if(empty($_SESSION['username'])){
    header("location:../index.php");
}

$last = $_SESSION['username'];
$sqlupdate = "UPDATE users SET last_activity=now() WHERE username='$last'";
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
    <title>Keamanan File</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="shortcut icon" type="image/x-icon" href="locked.png">
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
                <li><a href="#encrypt">ENKRIPSI FILE</a></li>
                <li><a href="#super">PESAN</a></li>
                <li><a href="logout.php">LOGOUT</a></li>
            </ul>
        </div>
    </div>
    </nav>

    <div class="jumbotron text-center">
    <h1>Keamanan File</h1>
    </div>

    <div id="encrypt" class="container-fluid">
        <div class="row">
            <div class="col-sm-4 text-center" style="padding-top:75px;">
                <img src="lock.png" alt="Lock Icon" class="slideanim" width="200" height="200">
            </div>
            <div class="col-sm-8">
                <h2 class="text-center">Halaman Enkripsi</h2><br>
                <form class="form-horizontal" method="post" action="encrypt-process.php" enctype="multipart/form-data">
                <fieldset>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" style="color:#000000;" for="inputFile">File</label>
                        <div class="col-lg-8">
                            <input class="form-control" id="inputFile" placeholder="Input File" type="file" name="file" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" style="color:#000000;" for="inputPassword">Key</label>
                        <div class="col-lg-8">
                            <input class="form-control" id="inputPassword" type="password" placeholder="Password" name="pwdfile" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" style="color:#000000;" for="textArea">Deskripsi</label>
                        <div class="col-lg-8">
                            <textarea class="form-control" id="textArea" rows="10" name="desc" placeholder="Deskripsi"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="textArea"></label>
                        <div class="col-lg-8">
                            <input type="submit" name="encrypt_now" value="Enkripsi File" class="form-control btn btn-default" style="background-color:#1877f2; color:#fff">
                        </div>
                    </div>
                </fieldset>
                </form>
            </div>
        </div>
    </div>

    <!-- Container (Super Enkrip Section) -->
    <div id="super" class="container-fluid text-center bg-grey">
    <h2>Kritik Dan Saran</h2><br>
    <form class="form-horizontal" method="post" action="super.php" enctype="multipart/form-data">
        <fieldset>
            <div class="form-group">
                <label class="col-lg-2 control-label" style="color:#000000;" for="textArea"></label>
                <div class="col-lg-8">
                    <textarea class="form-control" id="textArea" rows="9" name="comment" placeholder="Silahkan tulis kritik dan saran"></textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-2 control-label" for="textArea"></label>
                <div class="col-lg-8">
                    <input type="submit" name="encrypt_now" value="Kirim" class="form-control btn btn-default" style="background-color:#1877f2; color:#fff">
                </div>
            </div>
        </fieldset>
    </form>

    <footer class="container-fluid text-center">
    <a href="#myPage" title="To Top">
        <span class="glyphicon glyphicon-chevron-up"></span>
    </a>
    <p></p>
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