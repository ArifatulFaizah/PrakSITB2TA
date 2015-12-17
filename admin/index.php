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

if (isset($_POST['hapus_id_buku'])) {

    $id_book = $_POST['hapus_id_buku'];

    require_once('../lib/nusoap.php');
    $client = new nusoap_client('http://localhost/prak_sit_travel/service/service_paket.php');
    // proses call method 'search' dengan parameter key di script server.php yang ada di server A
    $result = $client->call('hapus_buku', array('id_book' => $id_book));

    if ($result == true)
    {

        echo '<script> alert("Record has been successfully deleted"); window.location.replace("");</script>';

    } else {
        mysql_error($result);
        echo '<script> alert("Failed, record has not been deleted"); window.location.replace("");</script>';

    }

/*header("Location: {$_SERVER['HTTP_REFERER']}");*/

}

?>

<!DOCTYPE html>
<!-- saved from url=(0044)http://themes.gie-art.com/dlapak/signup.html -->
<html><head>
<!-- Bootstrap -->
		<link href="bootstrap/css/bootstrap.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="asset/css/style.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
		<title>Book Catalogue</title>
    </head>
    <body>





        <div class="wrapper">
            <header class="navbar navbar-default navbar-fixed-top navbar-top">
                <div class="container">
                    <div class="navbar navbar-inner">
					<center>
                        <h3>
                        <a href="index.php"><span>BOOK CATALOGUE</span></a>
						</h3>
						</center>
                    </div>
                </div>
            </header>
            <section class="main">
                <div class="container">
            
                    <div class="row">
                        <div class="col-sm-12 login-form">
                            <div class="panel panel-default">
                                <div class="panel-intro text-center">
                                    <!--<h1 class="logo">Info Jadwal Kereta Api Travel</h1>-->
                                    <h3>Dashboard Buku</h3>
                                </div>
                            

                                <div class="widget-header">
                                </div>
  
                                <div class="span11">

                                    <form>
                                        
                                     
                                        <div class="span11">
                                         <div class="before-table">
                                                <div class="row">
                                                    <div class="span11">
													<br />
                                                        <a href="tambah_buku.php" class="btn btn-success">Tambah Buku</a>
														<a href="kursbca.php" class="btn btn-success">Kurs BCA</a>
														<form action="">                       
															<button type="submit" name="logout" class="btn btn-danger">LOG OUT</button>
														</form>
                                                    </div>
                                                   
                                                </div>
                                         </div>
										 <br />
                                        <table class="table table-hover">
                                        <thead>
                                            <tr class="success">
											
												<th><center>ID Buku</center></th>
                                                <th><center>Penulis</center></th>
                                                <th><center>Judul Buku</center></th>
												<th><center>Gambar</center></th>
                                                <th><center>Action</center></th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            <?php
                                                    require_once('../lib/nusoap.php');
                                                    $client = new nusoap_client('http://localhost/prak_sit_travel/service/service_paket.php');
                                                 

                                                        $result = $client->call('buku', array());

                                                    {
                                                        
                                                        foreach($result as $data)
                                                        {

                                                            //echo "".$data['nama_stasiun'];
                                                            $id_book = $data['id_book'];
                                                            $author = $data['author'];
                                                            $title = $data['title'];
                                                            $genre = $data['genre'];
                                                            $price = $data['price'];
                                                            $disi = $data['description'];
                                                            $description = substr($disi, 0, 50);
															$publish_date=$data['publish_date'];
                                                            $picture =$data['picture'];
        

                                                ?>

                                            <tr class="success">
                                                
												<td><center><?php echo $id_book; ?></center></td>
												<td><center><?php echo $author; ?></center></td>
                                                <td><center><?php echo $title; ?></center></td>
                                                <td><center><img src="images/<?php echo $picture; ?>" width="100px" height="100px"></center></td>
                                                <td>
                                                   
                                                    <div class="row">
                                                    <center>
                                                        <div class="col-xs-12">
                                                            <form action="edit.php" method="post">
                                                                <button id='submit' type='submit' name="id_book" value="<?php echo $id_book; ?>" class="btn btn-warning"><font color="white">edit</font></button>
                                                            </form>
                                                              <form action='' method='post'>
                                                                <button id='submit' type='submit' name="hapus_id_buku" value="<?php echo $id_book; ?>" class="btn btn-danger" onclick="return confirm('Hapus Data Buku <?php echo $id_book; ?> ?')"><font color="white">delete</font></button>
                                                            </form>
                                                        </div>
                                                       
                                                    </center>
                                                    </div>
                                                      
                                                  
                                                   
                                                </td>
                                            </tr>

                                            <?php

                                                        }
                                                        
                                                       
                                                    }
                                                    
                
                                            
            ?>       



                                        </tbody>
                                    </table>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
			
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
