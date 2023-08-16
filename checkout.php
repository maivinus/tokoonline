<?php include('header.php'); ?>

<main class="container">
    <h2 class="mt-3 mb-5">Check Out Keranjang Belanja</h2>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>No.</th>
                <th>Foto</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Sub Total</th>
            </tr>
        </thead>
        <tbody>
        <?php 
            $nomor = 1;
            $total = 0;
            $query = mysqli_query($conn, "SELECT * FROM keranjang JOIN produk ON keranjang.kode_produk = produk.kode_produk WHERE kode_sesi = '".session_id()."'");
            while($data = mysqli_fetch_array($query)){
        ?>
            <tr>
                <td><?php echo $nomor; ?></td>
                <td><img width="50px" src="images/<?php echo $data['foto']; ?>"></td>
                <td><?php echo $data['nama_produk']; ?></td>
                <td><?php echo $data['harga']; ?></td>
                <td><?php echo $data['jumlah']; ?></td>
                <td><?php echo $data['subtotal']; ?></td>
            </tr>
        <?php 
                $nomor++;
                $total += $data['subtotal'];
            }
        ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="5" class="text-center">Total Belanja</th>
                <th id="total-belanja"><?php echo $total; ?></th>
            </tr>
        </tfoot>
    </table>

    <form action="selesai.php" method="POST">
        <h3 class="mb-3">Informasi Pengiriman Produk</h3>
        <div class="form-floating mb-3">
            <input type="text" name="nama" class="form-control" id="nama" placeholder="Isikan Nama Lengkap Anda" required>
            <label for="nama">Nama Lengkap</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" name="hape" class="form-control" id="hape" placeholder="Isikan Nomor Handphone Anda" required>
            <label for="hape">Nomor Handphone</label>
        </div>
        <div class="form-floating mb-3">
            <textarea name="alamat" class="form-control" id="alamat" placeholder="Isikan Alamat Lengkap" required></textarea>
            <label for="alamat">Alamat Lengkap</label>
        </div>
        <div class="row">
            <div class="mb-3 col-6">
                <select name="provinsi" class="form-select form-select-lg" id="provinsi" required>
                    <option selected>Pilih Provinsi</option>
                </select>
            </div>
            <div class="mb-3 col-6">
                <select name="kota" class="form-select form-select-lg" id="kota" required>
                    <option selected>Pilih Kabupaten/Kota</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="mb-3 col-6">
                <select name="kurir" class="form-select form-select-lg" id="kurir" required>
                    <option selected>Pilih Kurir</option>
                    <option value="jne">JNE</option>
                    <option value="tiki">TIKI</option>
                    <option value="pos">POS Indonesia</option>
                </select>
            </div>
            <div class="mb-3 col-6">
                <select name="paket" class="form-select form-select-lg" id="paket" required>
                    <option selected>Pilih Paket</option>
                </select>
            </div>
        </div>
        <div class="form-floating mb-3">
            <input type="text" name="total" class="form-control" id="total" readonly value="0" placeholder="Total Belanja + Ongkir" required>
            <label for="nama">Total Belanja + Ongkir</label>
        </div>
        <a class="btn btn-warning" href="keranjang.php">Kembali ke Keranjang Belanja</a>
        <button type="submit" class="btn btn-warning">Selesai Belanja</button>
    </form>
    
</main>
<script>
    $(document).ready(function(){
        $.ajax({
            url: 'rajaongkir/provinsi.php',
            type: 'GET',
            start: $('#provinsi').html('<option>Loading Provinsi...</option>'),
            success: function(result){
                var hasil = JSON.parse(result);
                var provinsi = hasil.rajaongkir.results;
                var item = "<option selected>Pilih Provinsi</option>";
                $.each(provinsi, function(index,value){
                    item += "<option value='" + this.province_id + "'>" + this.province + "</option>";
                });
                $('#provinsi').html(item);
                $('#nama').focus();
            }
        });
    });

    $('#provinsi').change(function(){
        var kode = $(this).val();
        $.ajax({
            url: 'rajaongkir/kota.php',
            type: 'GET',
            data: 'provinsi=' + kode,
            start: $('#kota').html('<option>Loading Kota...</option>'),
            success: function(result){
                var hasil = JSON.parse(result);
                var kota = hasil.rajaongkir.results;
                var item = "<option selected>Pilih Kabupaten/Kota</option>";
                $.each(kota, function(index,value){
                    item += "<option value='" + this.city_id + "'>" + this.type + " " + this.city_name + "</option>";
                });
                $('#kota').html(item);
                $('#kota').focus();
            }
        });
    });

    $('#kota').change(function(){
        $('#kurir').focus();
    });

    $('#kurir').change(function(){
        var kota = $('#kota').val();
        var kurir = $('#kurir').val();
        $.ajax({
            url: 'rajaongkir/ongkir.php',
            type: 'GET',
            data: 'kota_tujuan=' + kota + '&kurir=' + kurir,
            start: $('#paket').html('<option>Loading Paket...</option>'),
            success: function(result){
                var hasil = JSON.parse(result);
                var paket = hasil.rajaongkir.results[0].costs;
                var item = "<option selected>Pilih Paket</option>";
                $.each(paket, function(index,value){
                    item += "<option value='" + this.cost[0].value + "'>" + 
                    this.service + " (" + this.description + "), Estimasi Sampai : " + 
                    this.cost[0].etd + " hari</option>";
                });
                $('#paket').html(item);
                $('#total').focus();
            }
        });
    });

    $('#paket').change(function(){
        var ongkir = parseInt($(this).val());
        var total = parseInt($('#total-belanja').html());
        var grandtotal = ongkir + total;

        $('#total').val(grandtotal);
    });
</script>
<?php include('footer.php'); ?>