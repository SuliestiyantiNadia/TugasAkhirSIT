<html>
    <head>
        <title>Perpustakaan</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">        
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-responsive.css" rel="stylesheet">
    </head>

<body style="background:#ecf0f1">			
  	<div class="navbar navbar-fixed-top" style="position: absolute;">
		<div class="navbar-inner">
			<div class="container" style="background:#white;width: auto; padding: 0 20px;">
				<a class="brand" href="index.php">PERPUS UGM</a>
					<ul class="nav">
						<li class="active"><a href="home.php">Perpustakaan</a></li>
						<li><a href="buku.php">Daftar Buku</a></li>
						<li><a href="kategori.php">Kategori Buku</a></li>
					
					</ul>
			</div>
		</div>
	</div>

<div class="container">
			<div class="row" style="margin-top:100px;">
				<div class="" style="background:white;border:1px solid #bbb;border-radius:10px;padding:10px 10px 10px 10px;">
					<form class="form-search" action="" method="post">
						<h4 class="text-left"><center>Sistem Pencarian Koleksi Buku Perpustakaan</center></h4> <br>
						<center><label>Judul Buku:&nbsp;</label><input name="judul_buku" type="text" placeholder="Masukkan judul buku"><br> <br>
						<center><label>Kategori :&nbsp;</label>
							<select name="kategori"/>
                        			<option>Biologi</option>
                        			<option>Ekonomika</option>
                        			<option>Farmasi</option>
                        			<option>Filsafat</option>
                        			<option>Geografi</option>
                        			<option>Hukum</option>
                        			<option>Ilmu Budaya</option>
                        			<option>Ilmu Sosial dan Ilmu Politik</option>
                        			<option>Kedokteran</option>
                        			<option>Kedokteran Gigi</option>
                        			<option>Kedokteran Hewan</option>
                        			<option>Kehutanan</option>
                        			<option>Teknik Elektro dan Informatika</option>
                        			<option>Sastra</option>
                        			<option>Psikologi</option>
                        			<option>Teknologi Pertanian</option>
                        	</select>  <br> 
						<br> <center><button name="submit" type="submit" class="btn">Search</button><br> <br>			
					</form>	
					</div>		
		
			</div>
    </div> 
				
   	  <script src="js/jquery.js"></script>
      <!-- Bootstrap javascript -->
      <script src="js/bootstrap.min.js"></script>
    </body>
</html>

<?php
    try{
        require_once("nusoap/lib/nusoap.php");	
        $client = new nusoap_client("http://localhost/yu/daftarbuku_server.php?wsdl");
        if (isset($_POST['submit'])) {
			$judul_buku = $_POST['judul_buku'];
			$kategori = $_POST['kategori'];
			$response = $client->call('cari', array('judul_buku'=>$judul_buku, 'kategori'=>$kategori));
            if (is_array($response)){
				echo "
				<div class='container' >
				<div class=' ' align='center' style='margin-top:50px'>
						<table class='table table-bordered table-hover table-striped' >
									<tr>
										<th>Nomor</th>
										<th>judul Buku</th>
										<th>Pengarang</th>
										<th>Penerbit</th>
										<th>Kategori</th>	
										<th>Lokasi</th>		
									</tr>
									";
                foreach($response as $data){
                     echo "
								
									<tr>
										<td>".$data['id_buku']."</td>
										<td>".$data['judul_buku']."</td>
										<td>".$data['pengarang']."</td>
										<td>".$data['penerbit']."</td>
										<td>".$data['kategori']."</td>		
										<td>".$data['lokasi']."</td>
									</tr>
									";
									}
									echo "
									</tbody>
								</table>
							</div>
					</div>";
           
            } 
			else echo "<br><center><p>Data tidak ditemukan</p></center>";
		}
	} catch(SoapFault $e){
        echo $e->getMessage();}