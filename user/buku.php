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
						<li><a href="home.php">Perpustakaan</a></li>
						<li class="active"><a href="buku.php">Daftar Buku</a></li>
						<li><a href="kategori.php">Kategori Buku</a></li>

					</ul>
			</div>
		</div>
	</div>
	
	  	<div class="container">
			<div class="row" style="margin-top:80px;">
				<div>
					<form class="form-search" style="background:white;" action="" method="post">
						<h4 class="text-center"> Koleksi Buku Perpustakaan</h4> <br>		
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

        require_once("nusoap/lib/nusoap.php");	
        $client = new nusoap_client("http://localhost/yu/user/daftarbuku_server.php?wsdl");
			$response = $client->call('cekPer');
            if (is_array($response)){
				echo "
				<div class='container' >
				<div class=' ' align='center'>
						<table class='table table-bordered table-hover table-striped' >
									<tr>
										<th>Nomor</th>
										<th>Judul Buku</th>
										<th>Pengarang</th>
										<th>Penerbit</th>	
										<th>Lokasi</th>	
										<th>Kategori</th>	
									</tr>
									";
                foreach($response as $data){
                     echo "
								
									<tr>
										<td>".$data['id_buku']."</td>
										<td>".$data['judul_buku']."</td>
										<td>".$data['pengarang']."</td>
										<td>".$data['penerbit']."</td>	
										<td>".$data['lokasi']."</td>
										<td>".$data['id_kategori']."</td>	
									</tr>
									";
									}
									echo "
									</tbody>
								</table>
							</div>
					</div>";
                
            } 
			else echo "<p>Data tidak ditemukan</p>";
		
	
?>