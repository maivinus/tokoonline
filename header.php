<?php session_start(); ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Toko Online</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 75rem;
            padding-top: 4.5rem;
        }
    </style>

    <script src="js/bootstrap.bundle.min.js"></script>   
    <script src="js/jquery-3.6.0.js"></script>
  </head>
  <body>
    
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-danger">
  <div class="container-fluid">
    <a class="navbar-brand" href="./">Toko Online</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav me-auto mb-2 mb-md-0">
        <li class="nav-item">
          <a class="nav-link" href="./">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Kategori Produk
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <?php 
            include('config/koneksi.php');

            $query1 = mysqli_query($conn, "SELECT * FROM kategori ORDER BY nama_kategori ASC");
            while($data1 = mysqli_fetch_array($query1)){
                echo "<li><a class='dropdown-item' href='index.php?kategori=".$data1['kode_kategori']."'>".$data1['nama_kategori']."</a></li>";
            }
          ?>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="./">Semua Kategori</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="keranjang.php">Keranjang Belanja 
            <span class="badge rounded-pill bg-dark" id="item-cart">0</span>
        </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.php">About Us
        </a>
        </li>
      </ul>
      <form class="d-flex" action="#" method="GET">
        <input class ="form-control me-3" type="search" placeholder="Search" aria-label="Search" name="cari">
        <button class="btn btn-warning" type="submit" name="pencarian">Search</button>
      </form>
    </div>
  </div>
</nav>