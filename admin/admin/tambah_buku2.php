 <?php
    require_once('lib/nusoap.php');
    $wsdl = "http://localhost/kampus/web_svr/A/server.php";
    $client = new nusoap_client($wsdl) or die("Error");
    $kode_barang = $_POST['kode_barang'];
    $nama_barang = $_POST['nama_barang'];
    $jumlah = $_POST['jumlah'];
    $kode_suplier = $_POST['kode_suplier'];
    if (isset($kode_barang)) {
        $response = $client->call('insertBarang', array('kode_barang' => $kode_barang, 'nama_barang' => $nama_barang,
            'jumlah' => $jumlah, 'kode_suplier' => $kode_suplier)) or die("Gagal Menyimpan");if($response){echo "Tambah data barang berhasil <br /><br />";}
        //header("location:list_barang.php");
    }
    ?>
    <div align='left'>
        <form id="form1" name="form1" method="post" action="">
            <table style='border:none;'>
                <h3 align='left'> TAMBAH DATA BARANG </h3>
                <br />
                <tr><td style='border:none;'><label><strong>Kode Barang</strong></label></td>
                    <td style='border:none;'>:&nbsp;<input name="kode_barang" type="text" id="kode_barang" /></td>
                </tr>
                <tr><td
                        style='border:none;'><label><strong>Nama Barang</strong></label></td>
                    <td style='border:none;'>:&nbsp;<input name="nama_barang" type="text" id="nama_barang" /></td></tr>
                <tr><td
                        style='border:none;'><label><strong>Jumlah</strong></label></td>
                    <td style='border:none;'>:&nbsp;<input name="jumlah" type="text"  id="jumlah" /></td>
                </tr>
                <tr><td
                        style='border:none;'><label><strong>kode_suplier</strong></label></td>
                    <td style='border:none;'>:&nbsp;<select name="kode_suplier" type="text"  id="kode_suplier" />
                        <option>-- Pilih Suplier --</option>
                    <?php 
                    $client=new nusoap_client($wsdl) or die("Error");
$response = $client->call('ambilData_suplier') or die("Error function");
foreach ($response as $data){
echo "<option value=$data[kode_suplier]>$data[nama_suplier]</option>";
}                
                    
                    ?>    
    
                        </select>
                    </td>
                </tr>
            </table>
            <input type='reset' name='reset' value='Reset' />&nbsp;&nbsp;<input
                type='submit' name='submit' value='Save' />
            <br><br>
        </form>

<div id="dtbrg">
<input type="button" value="Lihat Daftar Barang" 
       onclick="ambilData('list_barang.php', 'id_info')" />
<p id="id_info"></p>
