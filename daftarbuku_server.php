<?php
    require_once( "nusoap-0.9.5/lib/nusoap.php");
    $server = new soap_server();
    $server->configureWSDL('cek', 'urn:cek');

    $server->register('cari',
        array('judul_buku' => 'xsd:string', 'kategori' => 'xsd:string'),
        array('judul_buku'=>'xsd:Array'),
        'urn:cek','urn:cekAction');

    $server->register('cekPer',
        array('id_buku' => 'xsd:string'),
        array('id_buku'=>'xsd:Array'),
        'urn:cek','urn:cekAction');

    $server->register('cek',
        array('id_kategori' => 'xsd:string'),
        array('id_kategori'=>'xsd:Array'),
        'urn:cek','urn:cekAction');
		
    function dbConnect($query){
        try{
            $connect = mysql_connect("localhost","root","");
            $db = mysql_select_db("perpus");
            return mysql_query($query);
        } catch(Exception $e){
            echo $e->getMessage();
        }
    }

    function cari($judul_buku,$kategori){

        if(empty($judul_buku) or empty($kategori)  )
            return 'Please fill all the required fields';

        $judul_buku = strip_tags(mysql_real_escape_string($judul_buku));
        $kategori = strip_tags(mysql_real_escape_string($kategori));
        

        $res = dbConnect("SELECT id_buku,judul_buku,pengarang,penerbit,kategori,lokasi FROM buku 
                            LEFT JOIN kategori ON buku.id_kategori=kategori.id_kategori 
                            WHERE judul_buku like '%$judul_buku%' AND kategori like '%$kategori%'
                            ORDER BY buku.id_buku ASC");
   
        while ($data = mysql_fetch_array($res))
        {
            $result[] = array('id_buku' => $data['id_buku'], 'judul_buku' => $data['judul_buku'], 'pengarang' => $data['pengarang'], 'penerbit' => $data['penerbit'], 'lokasi' => $data['lokasi'], 'kategori' => $data['kategori']);
        }
        return $result;
    }  

    function cekPer(){

        $res = dbConnect("SELECT * FROM buku");
   
		while ($data = mysql_fetch_array($res))
		{
			$result[] = array('id_buku' => $data['id_buku'], 'judul_buku' => $data['judul_buku'], 'pengarang' => $data['pengarang'], 'penerbit' => $data['penerbit'], 'lokasi' => $data['lokasi'], 'id_kategori' => $data['id_kategori']);
		}
		return $result;
    }    

    function cek(){

        $res = dbConnect("SELECT * FROM kategori");
   
        while ($data = mysql_fetch_array($res))
        {
            $result[] = array('id_kategori' => $data['id_kategori'], 'kategori' => $data['kategori']);
        }
        return $result;
    }  

  //create function
function login_ws($username, $password) {
    //enkripsi password dengan md5
    $password = md5($password);
    //buat koneksi
    $db = NewADOConnection('mysql');
    $db -> Connect('localhost','root','','akhir');
    //cek username dan password dari database
    $sql = $db -> Execute("SELECT * FROM user where
    username='$username' AND
    password='$password'");
    //Cek adanya username dan password di database
    if ($sql->RecordCount() >= 1) //sama dengan mysql_num_rows pada php biasa
    {
    return "Login Berhasil";
    } else {
    return "Login gagal";
    }
    }

    $HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA)
        ? $HTTP_RAW_POST_DATA : '';
    $server->service($HTTP_RAW_POST_DATA);
