<?php
require_once('nusoap.php');
$URL       = "http://localhost/prak_sit_travel/service/service_paket.php";
$namespace = $URL . '?wsdl';
$server = new soap_server;
$server->configureWSDL('Service Buku', $namespace);



$server->register('buku', 
	array('input' => 'xsd:String'),
	array('output' => 'xsd:Array'),
	'urn:servicebuku',
	'urn:servicebuku#buku',
	'rpc',
	'encoded',
	'menampilkan data buku'
	);


$server->register('detailbuku', 
	array('input' => 'xsd:String'),
	array('output' => 'xsd:Array'),
	'urn:servicebuku',
	'urn:servicebuku#detailbuku',
	'rpc',
	'encoded',
	'menampilkan detail buku'
	);

$server->register('tambah_buku', 
	array('input' => 'xsd:String'),
	array('output' => 'xsd:Array'),
	'urn:servicebuku',
	'urn:servicebuku#tambah_buku',
	'rpc',
	'encoded',
	'Menambahkan buku wisata'
	);

$server->register('detail_buku', 
	array('input' => 'xsd:Array'),
	array('output' => 'xsd:Array'),
	'urn:servicebuku',
	'urn:servicebuku#detail_buku',
	'rpc',
	'encoded',
	'menampilkan detail buku'
	);

$server->register('edit_buku', 
	array('input' => 'xsd:Array'),
	array('output' => 'xsd:Array'),
	'urn:servicebuku',
	'urn:servicebuku#edit_buku',
	'rpc',
	'encoded',
	'menyimpan data buku setelah di edit'
	);

$server->register('hapus_buku', 
	array('input' => 'xsd:String'),
	array('output' => 'xsd:Array'),
	'urn:servicebuku',
	'urn:servicebuku#hapus_buku',
	'rpc',
	'encoded',
	'menghapus data buku'
	);


// koneksi ke database
include "koneksi.php";


function buku()
{

	$query = "SELECT * FROM books";
	$hasil = mysql_query($query);
	while ($data = mysql_fetch_array($hasil))
	{
		// menyimpan data hasil pencarian dalam array
		$result[] = array('id_book' => $data['id_book'], 'author' => $data['author'], 'title' => $data['title'], 'genre' => $data['genre'], 'price' => $data['price'], 'description' => $data['description'], 'publish_date' => $data['publish_date'], 'picture' => $data['picture'] );
	}
	// mereturn array hasil pencarian
	return $result;
}

function tambah_buku($id_book, $author, $title, $genre, $price, $description,$publish_date, $picture)
{
	$tambah = mysql_query("INSERT INTO books (id_book, author, title, genre, price, description, publish_date, picture) values ('$id_book','$author','$title','$genre','$price','$description', '$publish_date','$picture')");
	if ($tambah) 
	{
		return true;
	}
	else
	{
		return false;
	}

}

function detail_buku($id_book)
{

	$query = "SELECT * FROM books where id_book = '$id_book'";
	$hasil = mysql_query($query);
	while ($data = mysql_fetch_array($hasil))
	{
		// menyimpan data hasil pencarian dalam array
		$result[] = array('id_book' => $data['id_book'], 'author' => $data['author'], 'title' => $data['title'], 'genre' => $data['genre'], 'price' => $data['price'], 'description' => $data['description'], 'publish_date' => $data['publish_date'], 'picture' => $data['picture']);
	}
	// mereturn array hasil pencarian
	return $result;
}

function edit_buku($id_book, $author, $title, $genre, $price, $description, $publish_date, $picture)
{
	$query = "UPDATE books SET author='$author',  title = '$title', genre = '$genre', price = '$price', description = '$description', publish_date='$publish_date', picture = '$picture' WHERE id_book = '$id_book'";
	$hasil = mysql_query($query);
	if ($hasil ){

		return true;

	} else{

		return false;

	}
		
}

function hapus_buku($id_book)
{

	$query = "DELETE FROM books where id_book='$id_book'";
	$hasil = mysql_query($query);

	if ($hasil == true ){

		return true;

	} else {

		return false;

	}
}



$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);

?>
