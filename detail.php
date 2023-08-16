<?php include('header.php'); ?>

<main class="container">
    <div class="row">
        <?php 
            $sql = "SELECT * FROM produk WHERE kode_produk = ".$_GET['id'];
            $query2 = mysqli_query($conn, $sql);
            $data2 = mysqli_fetch_array($query2);
        ?>
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="images/<?php echo $data2['foto']; ?>" class="img-fluid">
                </div>
                <div class="col-md-8">
                <div class="card-body">
                    <h2 class="card-title mb-5"><?php echo $data2['nama_produk']; ?></h2>
                    <p class="card-text mb-5"><?php echo $data2['deskripsi']; ?></p>
                    <p class="card-text">
                        <h4 class="card-title text-danger mb-5">
                            <?php echo "Rp ".number_format($data2['harga'],2,',','.'); ?>
                        </h4>
                        <button type="button" class="btn btn-warning text-black btn-block" 
                            onclick="addToCart(<?php echo $data2['kode_produk']; ?>)">
                            +Keranjang
                        </button>
                    </p>
                </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include('footer.php'); ?>