<?php
require_once( "nusoap-0.9.5/lib/nusoap.php");

$ws_srv = new soap_server();
$ws_srv->register('inserBuku');
$ws_srv->register('ambilData_Barang');
$ws_srv->register('editData1');
$ws_srv->register('hapusDataBarang');
$ws_srv->register('insertData');


function insertBuku($id_buku,$judul_buku,$pengarang,$penerbit,$lokasi,$id_kategori){
mysql_connect('localhost','root','');
mysql_select_db('perpus');
$query="INSERT INTO buku VALUES('$id_buku','$judul_buku','$pengarang','$penerbit','$lokasi','$id_kategori')";
if(mysql_query($query)){ return true; }
else { return false; }
}


function insertData($nim,$nm,$alamat){
mysql_connect('localhost','admin','admin');
mysql_select_db('web_service_sl3');
$query="INSERT INTO mhs VALUES('$nim','$nm','$alamat')";
if(mysql_query($query)){ return true; }
else { return false; }
}



function ambilData_Barang(){
mysql_connect('localhost','admin','admin');
mysql_select_db('web_service_sl3');
$sql = mysql_query('SELECT * FROM barang,suplier  where suplier.kode_suplier=barang.kode_suplier order by kode_barang');
while ($row=mysql_fetch_array($sql)){
$return_data[]=$row;}
return $return_data;}


function editData1($kode_barang,$nama_barang,$jumlah,$kode_suplier){
mysql_connect('localhost','admin','admin');
mysql_select_db('web_service_sl3');
$query="UPDATE barang SET kode_barang='$kode_barang', nama_barang='$nama_barang', 
jumlah='$jumlah', kode_suplier='$kode_suplier'
WHERE kode_barang='$kode_barang'";
if(mysql_query($query)){ return "data sudah diedit";}
else { return "data gagal diedit";} }

function ambilDataSatu($kode){
mysql_connect('localhost','admin','admin');
mysql_select_db('web_service_sl3');
$sql = mysql_query("SELECT * FROM barang WHERE kode_barang='$kode'");
while ($row=mysql_fetch_array($sql)){
$return_data[]=$row;}
return $return_data;}

function hapusDataBarang($kode_brg){
mysql_connect('localhost','admin','admin');
mysql_select_db('web_service_sl3');
$query="DELETE FROM barang where kode_barang='$kode_brg'";
if(mysql_query($query)){ return true;}
else { return false;} }



$HTTP_RAW_POST_DATA = isset ($HTTP_RAW_POST_DATA) ?
$HTTP_RAW_POST_DATA:"";
$ws_srv->service($HTTP_RAW_POST_DATA);
?>



