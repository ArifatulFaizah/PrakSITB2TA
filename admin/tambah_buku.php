<?php
session_start();
if (empty($_SESSION['username'])) {
header("location:../login.php"); // jika belum login, maka dikembalikan ke file form_login.php
}
?>

<?php

if (isset($_GET['logout'])) {

    session_start(); // memulai session
    session_destroy(); // menghapus session
    header("location:../login.php"); // mengambalikan ke form_login.php
}



?>

<?php

    require_once('../lib/nusoap.php');
    $client = new nusoap_client('http://localhost/prak_sit_travel/service/service_paket.php');
    // proses call method 'search' dengan parameter key di script server.php yang ada di server A
    if (isset($_POST['submit']))
    {
       
        $id_book = $_POST['id_book'];
        $author = $_POST['author'];
        $title = $_POST['title'];
        $genre = $_POST['genre'];
        $price = $_POST['price'];
        $description = $_POST['description'];
		$publish_date = $_POST['publish_date'];
        $file = $_FILES['picture']['name'];
        $file_loc = $_FILES['picture']['tmp_name']; //author temporrary
        $file_size = $_FILES['picture']['size'];
        $file_type = $_FILES['picture']['type'];
        $folder="images/";

        //$fotokereta = $_POST['fotokereta'];

        $result = $client->call('tambah_buku', array('id_book' => $id_book, 'author' => $author, 'title' => $title, 'genre' => $genre, 'price' => $price, 'description' => $description, 'publish_date' => $publish_date, 'picture' => $file));

        if ($result == true){
        	move_uploaded_file($file_loc,$folder.$file);
            echo '<script> alert("Data telah disimpan."); window.location.replace("index.php");</script>';
     

        } else {

            mysql_error($result);
            echo $author.$price.$title.$description.$file.$genre;

        }

    } 

?>



<!DOCTYPE html>
<!-- saved from url=(0044)http://themes.gie-art.com/dlapak/signup.html -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="robots" content="index, follow">
        <title>Tambah Buku</title>
        <link rel="stylesheet" href="css/css" type="text/css">
        <!-- Essential styles -->
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="css/font-awesome.css" type="text/css"> 

        <!-- Dlapak styles -->
        <link id="theme_style" type="text/css" href="css/style1.css" rel="stylesheet" media="screen">


        <!-- Favicon -->
        <link href="http://themes.gie-art.com/dlapak/assets/img/favicon.png" rel="icon" type="image/png">

        <!-- Assets -->
        <link rel="stylesheet" href="css/owl.carousel.css">
        <link rel="stylesheet" href="css/owl.theme.css">

        <!-- JS Library -->
        <script async="" src="js/analytics.js"></script><script src="js/jquery.js"></script>
        <script async="" src="ckeditor/ckeditor.js"></script><script src="js/jquery.js"></script>

    </head>
    <body>
        <div class="wrapper">
            <header class="navbar navbar-default navbar-fixed-top  navbar-top">
                <div class="container">
                    <div class="navbar navbar-inner">
					<center>
                        <h3>
                        <a href="index.php"><span>Tambah Buku</span></a>
						</h3>
						</center>
                    </div>
                </div>
            </header>
            <section class="main">
                <div class="container">
                    <div class="row">
                        



                        <section class="main no-padding">
                
                <div class="container">

                    <div class="row">
                      
                        <div class="col-md-12 col-sm-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"> <a href="#collapseB1" data-toggle="collapse"> Tambah Buku </a> </h4>
                                </div>

                                <form action="" accept-charset="utf-8" method="post" enctype="multipart/form-data" id="UserProfileForm" class="form-horizontal">
                                    <div class="panel-body">    
										<div class="form-group">
                                            <label class="col-sm-3 control-label">ID Buku</label>
                                            <div class="col-sm-9">
                                           		<input type="text" name="id_book" required class="form-control">
                                            </div>
                                            </label>
                                        </div>									
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Penulis</label>
                                            <div class="col-sm-9">
                                           		<input type="text" name="author" required class="form-control">
                                            </div>
                                            </label>
                                        </div>
                                         <div class="form-group">
                                            <label class="col-sm-3 control-label">Judul Buku</label>
                                            <div class="col-sm-9">
                                           		<input type="text" name="title" required class="form-control">
                                            </div>
                                            </label>
                                        </div>
                                         <div class="form-group">
                                            <label class="col-sm-3 control-label">Jenis Buku</label>
                                            <div class="col-sm-9">
                                           		<input type="text" name="genre" required class="form-control">
                                            </div>
                                            </label>
                                        </div>
                                         <div class="form-group">
                                            <label class="col-sm-3 control-label">price</label>
                                            <div class="col-sm-9">
                                           		<input type="text" name="price" required class="form-control">
                                            </div>
                                            </label>
                                        </div>
                                          <div class="form-group">
                                            <label class="col-sm-3 control-label">Deskripsi</label>
                                            <div class="col-sm-9">
                                           		<textarea id="editor1" name="description">
                                           			
                                           		</textarea>
                                           		 <script>
					                                // Replace the <textarea id="editor1"> with a CKEditor
					                                // instance, using default configuration.
					                                CKEDITOR.replace( 'editor1' );
					                            </script>
                                            </div>
                                            </label>
                                        </div>
										 <div class="form-group">
                                            <label class="col-sm-3 control-label">Tanggal Terbit</label>
                                            <div class="col-sm-9">
                                           		<input type="text" name="publish_date" required class="form-control" value=" <?php echo date("Y-m-d");?> ">
                                            </div>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">picture </label>
                                            <div class="col-sm-9">
                                           		<input type="file" name="picture" class="form-control">
                                            </div>
                                            </label>
                                        </div>          
                                    </div>
                                    <div class="panel-footer">
                                        <div class="row">
                                            <div class="col-sm-offset-3 col-sm-9">
                                                <button type="submit" name="submit" class="btn btn-success"> Save</button>
                                                <button name="cancel" class="btn btn-default"> Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </form> 
                            </div>
                        </div>  
                    </div>
                </div>
            </section>





                    </div>
                </div>
            </section>
            <br/>
            <div class="footer">
                <div class="container">
                <ul class="footer-menu">
                    <center><p>Book Catalogue by Arifatul Faizah</p></center>
                </ul>
                </div>
            </div>
        </div>
        <!-- Essentials -->
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/owl.carousel.js"></script>
        <script src="../js/jquery.countTo.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {

                // ===========Featured Owl Carousel============
                if ($(".owl-carousel-featured").length > 0) {
                    $(".owl-carousel-featured").owlCarousel({
                        items: 3,
                        lazyLoad: true,
                        pagination: true,
                        autoPlay: 5000,
                        stopOnHover: true
                    });
                }

                // ==================Counter====================
                $('.item-count').countTo({
                    formatter: function (value, options) {
                        return value.toFixed(options.decimals);
                    },
                    onUpdate: function (value) {
                        console.debug(this);
                    },
                    onComplete: function (value) {
                        console.debug(this);
                    }
                });
            });
        </script>
        <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-68907527-1', 'auto');
  ga('send', 'pageview');

</script>
    
 </body></html>