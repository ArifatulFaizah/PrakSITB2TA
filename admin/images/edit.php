<?php
    // proses pencarian data
    if (isset($_POST['id_pw']) )
    {
        //if ($_GET['op'] == 'search')
        //{
            $id_pw = $_POST['id_pw'];
            require_once('../lib/nusoap.php');
            $client = new nusoap_client('http://localhost/prak_sit_travel/service/service_paket.php');
            // proses call method 'search' dengan parameter key di script server.php yang ada di server A
            $result = $client->call('detail_paket', array('id_pw' => $id_pw));
            // jika data hasil pencarian ($result) ada, maka tampilkan
            if (is_array($result))
            {

                foreach($result as $data)
                {
                    $id_pw = $data['id_pw'];
                    $nama = $data['nama'];
                    $tujuan = $data['tujuan'];
                    $durasi = $data['durasi'];
                    $harga = $data['harga'];
                    $isi = $data['isi'];
                    $gambar = $data['gambar'];
                }
              

            } 
            else {

                    $id_pw = "";
                    $nama = "";
                    $tujuan = "";
                    $durasi = "";
                    $harga = "";
                    $isi = "";
                    $gambar = "";
        
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
        $id_pw = $_POST['id_pw'];
        $nama = $_POST['nama'];
        $tujuan = $_POST['tujuan'];
        $durasi = $_POST['durasi'];
        $harga = $_POST['harga'];
        $isi = $_POST['isi'];
    
          $file = $_FILES['gambar']['name'];
            $file_loc = $_FILES['gambar']['tmp_name']; //nama temporrary
            $file_size = $_FILES['gambar']['size'];
            $file_type = $_FILES['gambar']['type'];
            $folder="images/";

        $result = $client->call('edit_paket', array('id_pw' => $id_pw, 'nama' => $nama, 'tujuan' => $tujuan, 'durasi' => $durasi, 'harga' => $harga, 'isi' => $isi, 'gambar' => $file));

        if ($result == true){

            move_uploaded_file($file_loc,$folder.$file);
            echo '<script> alert("Data telah disimpan."); window.location.replace("index.php");</script>';

        } else {

            echo '<script> alert("Data gagal tersimpan."); window.location.replace("data-kereta.php");</script>';

        }

    } 
	?>
	<div class="col-md-9 col-sm-9">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"> <a href="#collapseB1" data-toggle="collapse"> Edit Paket Wisata </a> </h4>
                                </div>

                                <form action="" accept-charset="utf-8" method="post" enctype="multipart/form-data" id="UserProfileForm" class="form-horizontal">
                                     <div class="form-group" style="display: none;">
                                            <label class="col-sm-3 control-label">ID Paket</label>
                                            <div class="col-sm-9">
                                                <input type="text" required="required" name="id_pw" value="<?php echo $id_pw; ?>" class="form-control"> </div>           
                                        </div>
                                    <div class="panel-body" > 
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Nama Paket</label>
                                            <div class="col-sm-9">
                                                <input name="nama" type="text" required="required" value="<?php echo $nama; ?>" class="form-control">                                
                                            </div>
                                        </div>   
                                         <div class="form-group">
                                            <label class="col-sm-3 control-label">Tujuan</label>
                                            <div class="col-sm-9">
                                                <input name="tujuan" type="text" required="required" value="<?php echo $tujuan; ?>" class="form-control">                                
                                            </div>
                                        </div>  
                                         <div class="form-group">
                                            <label class="col-sm-3 control-label">Durasi</label>
                                            <div class="col-sm-9">
                                                <input name="durasi" type="number" required="required" value="<?php echo $durasi; ?>" class="form-control">                                
                                            </div>
                                        </div> 
                                          <div class="form-group">
                                            <label class="col-sm-3 control-label">Harga</label>
                                            <div class="col-sm-9">
                                                <input name="harga" type="number" required="required" value="<?php echo $harga; ?>" class="form-control">                                
                                            </div>
                                        </div>   
                                         <div class="form-group">
                                            <label class="col-sm-3 control-label">Isi Paket </label>
                                            <div class="col-sm-9">
                                                <textarea id="editor1" name="isi">
                                                    <?php echo $isi; ?>
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
                                            <label class="col-sm-3 control-label">Gambar</label>
                                            <div class="col-sm-9">
                                               <img src="images/<?php echo $gambar; ?>" width="100px" height="100px">                               
                                            </div>
                                        </div>    
                                         <div class="form-group">
                                            <label class="col-sm-3 control-label">Upload Gambar Baru</label>
                                            <div class="col-sm-9">
                                              <input type="file" name="gambar" class="form-group" />                             
                                            </div>
                                        </div>          
                                       
                                       
                                            
                                    </div>
                                    <div class="panel-footer">
                                        <div class="row">
                                            <div class="col-sm-offset-3 col-sm-9">
                                                <button type="submit" name="submit" class="btn btn-custom"><i class="fa fa-save"></i> Save</button>
                                                <button name="cancel" class="btn btn-default"><i class="fa fa-close"></i> Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </form> 
                            </div>
                        </div>  
                    </div>
                </div>


?>