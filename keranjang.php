<?php include('header.php'); ?>

<main class="container">
    <h2 class="mt-3 mb-5">Keranjang Belanja</h2>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>No.</th>
                <th>Foto</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Sub Total</th>
                <th>Hapus</th>
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
                <td>
                    <div class="input-group">
                        <button type="button" class="btn btn-outline-secondary" onclick="updateCart(<?php echo $data['kode_keranjang']; ?>,'kurang')">-</button>
                        <input type="text" class="form-control text-center" readonly size=1 id="jumlah" value="<?php echo $data['jumlah']; ?>">
                        <button type="button" class="btn btn-outline-secondary" onclick="updateCart(<?php echo $data['kode_keranjang']; ?>,'tambah')">+</button>
                    </div>
                </td>
                <td><?php echo $data['subtotal']; ?></td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm" onclick="hapusCart(<?php echo $data['kode_keranjang']; ?>)">Hapus</button>
                </td>
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
                <th><?php echo $total; ?></th>
                <th class="bg-secondary"></th>
            </tr>
        </tfoot>
    </table>
    
   <?php
    if ($total > 0) {
        echo "<a class='btn btn-info' href='checkout.php'>Check Out</a>";
    }
   ?>
</main>

<?php include('footer.php'); ?>