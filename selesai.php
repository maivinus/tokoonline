<?php 
include('header.php');

$status = 0;

if(isset($_POST['nama'])){

    $nama = $_POST['nama'];
    $hape = $_POST['hape'];
    $alamat = $_POST['alamat'];
    $provinsi = $_POST['provinsi'];
    $kota = $_POST['kota'];
    $kurir = $_POST['kurir'];
    $ongkir = $_POST['paket'];
    $total = $_POST['total'];
    $tanggal = date('d-m-Y');

    $query = mysqli_query($conn, "SELECT RIGHT(MAX(nomor),3) as nomor FROM penjualan WHERE DATE(tanggal) = CURDATE()");
    $data = mysqli_fetch_array($query);
    if(isset($data['nomor'])){
        $nomor = date('Ymd-').str_repeat("0", 3 - strlen($data['nomor'] + 1)).($data['nomor'] + 1);
    }else{
        $nomor = date('Ymd-').'001';
    }

    $query2 = mysqli_query($conn, "INSERT INTO penjualan_detail(nomor,kode_produk,jumlah,harga,subtotal) ".
                        "SELECT '$nomor' as nomor,kode_produk,jumlah,harga,subtotal FROM keranjang WHERE kode_sesi = '".
                        session_id()."'");
    
    if($query2){
        $query3 = mysqli_query($conn, "INSERT INTO penjualan(nomor,nama,nohp,alamat,provinsi,kota,kurir,ongkir,total) ".
                        "VALUES('$nomor','$nama','$hape','$alamat','$provinsi','$kota','$kurir','$ongkir','$total')");
        if($query3){ 
            $status = 1;
            mysqli_query($conn, "DELETE FROM keranjang WHERE kode_sesi = '".session_id()."'");
        }else{
            mysqli_query($conn, "DELETE FROM penjualan_detail WHERE nomor = '$nomor'");
        }
    }
}
?>

<?php if($status == 1) { ?>
<main class="container">
    <h2 class="mt-3 mb-5">Terima kasih telah Berbelanja di website kami.</h2>
    <table class="table table-bordered mb-5">
        <tbody>
            <tr>
                <th>Nomor Transaksi</th>
                <td><?php echo $nomor; ?></td>
            </tr>
            <tr>
                <th>Tanggal Transaksi</th>
                <td><?php echo $tanggal; ?></td>
            </tr>
            <tr>
                <th>Nama Konsumen</th>
                <td><?php echo $nama; ?></td>
            </tr>
            <tr>
                <th>Nomor Telepon</th>
                <td><?php echo $hape; ?></td>
            </tr>
            <tr>
                <th>Alamat Konsumen</th>
                <td><?php echo $alamat; ?></td>
            </tr>
            <tr>
                <th>Total Belanja</th>
                <td><?php echo "Rp ".number_format($total, 2, ',', '.'); ?></td>
            </tr>
        </tbody>
    </table>
    <center><a class="btn btn-success" href="index.php">Kembali ke Halaman Utama</a></center>
</main>
<?php } 

include('footer.php');
?>
