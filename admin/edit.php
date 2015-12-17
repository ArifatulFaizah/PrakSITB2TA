<?php
    // proses pencarian data
    if (isset($_POST['id_book']) )
    {
        //if ($_GET['op'] == 'search')
        //{
            $id_book = $_POST['id_book'];
            require_once('../lib/nusoap.php');
            $client = new nusoap_client('http://localhost/prak_sit_travel/service/service_paket.php');
            // proses call method 'search' dengan parameter key di script server.php yang ada di server A
            $result = $client->call('detail_buku', array('id_book' => $id_book));
            // jika data hasil pencarian ($result) ada, maka tampilkan
            if (is_array($result))
            {

                foreach($result as $data)
                {
                    $id_book = $data['id_book'];
                                                            $author = $data['author'];
                                                            $title = $data['title'];
                                                            $genre = $data['genre'];
                                                            $price = $data['price'];
                                                            $disi = $data['description'];
                                                            $description = substr($disi, 0, 50);
															$publish_date=$data['publish_date'];
                                                            $picture =$data['picture'];
                }
              

            } 
            else {

                    $id_book = "";
                    $author = "";
                    $title = "";
                    $genre = "";
                    $price = "";
                    $description = "";
					$publish_date="";
                    $picture = "";
        
                echo "<p>Data tidak ditemukan</p>";
            }

            //}
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

        $result = $client->call('edit_buku', array('id_book' => $id_book, 'author' => $author, 'title' => $title, 'genre' => $genre, 'price' => $price, 'description' => $description, 'publish_date' => $publish_date, 'picture' => $file));

        if ($result == true){

            move_uploaded_file($file_loc,$folder.$file);
            echo '<script> alert("Data telah disimpan."); window.location.replace("index.php");</script>';

        } else {

            echo '<script> alert("Data gagal tersimpan."); window.location.replace("data-kereta.php");</script>';

        }

    } 
	?>
	<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
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
	<div class="col-md-12 col-sm-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"> <a href="#collapseB1" data-toggle="collapse"> Edit Katalog Buku </a> </h4>
                                </div>

                                <form action="" accept-charset="utf-8" method="post" enctype="multipart/form-data" id="UserProfileForm" class="form-horizontal">
                                     <div class="form-group" style="display: none;">
                                            <label class="col-sm-3 control-label">ID Buku</label>
                                            <div class="col-sm-9">
                                                <input type="text" required="required" name="id_book" value="<?php echo $id_book; ?>" class="form-control"> </div>           
                                        </div>
                                    <div class="panel-body" > 
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Penulis</label>
                                            <div class="col-sm-9">
                                                <input name="author" type="text" required="required" value="<?php echo $author; ?>" class="form-control">                                
                                            </div>
                                        </div>   
                                         <div class="form-group">
                                            <label class="col-sm-3 control-label">Judul Buku</label>
                                            <div class="col-sm-9">
                                                <input name="title" type="text" required="required" value="<?php echo $title; ?>" class="form-control">                                
                                            </div>
                                        </div>  
                                         <div class="form-group">
                                            <label class="col-sm-3 control-label">Jenis Buku</label>
                                            <div class="col-sm-9">
                                                <input name="genre" type="text" required="required" value="<?php echo $genre; ?>" class="form-control">                                
                                            </div>
                                        </div> 
                                          <div class="form-group">
                                            <label class="col-sm-3 control-label">Harga</label>
                                            <div class="col-sm-9">
                                                <input name="price" type="text" required="required" value="<?php echo $price; ?>" class="form-control">                                
                                            </div>
                                        </div>   
                                         <div class="form-group">
                                            <label class="col-sm-3 control-label">Deskripsi Buku</label>
                                            <div class="col-sm-9">
                                                <textarea id="editor1" name="description">
                                                    <?php echo $description; ?>
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
                                                <input name="publish_date" type="date" required="required" value="<?php echo $publish_date; ?>" class="form-control">                                
                                            </div>
                                        </div>   										
                                         <div class="form-group">
                                            <label class="col-sm-3 control-label">Gambar</label>
                                            <div class="col-sm-9">
                                               <img src="images/<?php echo $picture; ?>" width="100px" height="100px">                               
                                            </div>
                                        </div>    
                                         <div class="form-group">
                                            <label class="col-sm-3 control-label">Upload Gambar</label>
                                            <div class="col-sm-9">
                                              <input type="file" name="picture" class="form-group" />                             
                                            </div>
                                        </div>          
                                       
                                       
                                            
                                    </div>
                                    <div class="panel-footer">
                                        <div class="row">
                                            <div class="col-sm-offset-3 col-sm-9">
                                                <button type="submit" name="submit" class="btn btn-success">Save</button>
                                                <button name="cancel" class="btn btn-default">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </form> 
                            </div>
                        </div>
				<div class="footer">
                <div class="container">
                <ul class="footer-menu">
                    <center><p>Book Catalogue by Arifatul Faizah</p></center>
                </ul>
                </div>
            </div>						
                   </body>
				   </html>