<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>TOKO SPORT | Ecommerce cyber sport</title>
  <meta name="keywords" content="Toto sport" />
  <script>
    addEventListener("load", function () {
      setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
      window.scrollTo(0, 1);
    }
  </script>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="all,follow">
  <!-- Bootstrap CSS-->
  <link rel="stylesheet" href="baru/vendor/bootstrap/css/bootstrap.min.css">
  <!-- Lightbox-->
  <link rel="stylesheet" href="baru/vendor/lightbox2/css/lightbox.min.css">
  <!-- Range slider-->
  <link rel="stylesheet" href="baru/vendor/nouislider/nouislider.min.css">
  <!-- Bootstrap select-->
  <link rel="stylesheet" href="baru/vendor/bootstrap-select/css/bootstrap-select.min.css">
  <!-- Owl Carousel-->
  <link rel="stylesheet" href="baru/vendor/owl.carousel2/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="baru/vendor/owl.carousel2/assets/owl.theme.default.css">
  <!-- Google fonts-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Libre+Franklin:wght@300;400;700&amp;display=swap">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Martel+Sans:wght@300;400;800&amp;display=swap">
  <!-- theme stylesheet-->
  <link rel="stylesheet" href="baru/css/style.default.css" id="theme-stylesheet">
  <!-- Custom stylesheet - for your changes-->
  <link rel="stylesheet" href="baru/css/custom.css">
  <!-- Favicon-->
  <link rel="shortcut icon" href="baru/img/favicon.png">
</head>




<?php
include 'koneksi.php';

session_start();

$file = basename($_SERVER['PHP_SELF']);

if(!isset($_SESSION['customer_status'])){

  // halaman yg dilindungi jika customer belum login
  $lindungi = array('customer.php','customer_logout.php');

  // periksa halaman, jika belum login ke halaman di atas, maka alihkan halaman
  if(in_array($file, $lindungi)){
    header("location:index.php");
  }

  if($file == "checkout.php"){
    header("location:masuk.php?alert=login-dulu");
  }

}else{

  // halaman yg tidak boleh diakses jika customer sudah login
  $lindungi = array('masuk.php','daftar.php');

  // periksa halaman, jika sudah dan mengakses halaman di atas, maka alihkan halaman
  if(in_array($file, $lindungi)){
    header("location:customer.php");
  }

}



if($file == "checkout.php"){


  if(!isset($_SESSION['keranjang']) || count($_SESSION['keranjang']) == 0){

    header("location:keranjang.php?alert=keranjang_kosong");

  }
}



?>






<body>
  <div class="page-holder">
    <!-- navbar-->
    <header class="header bg-white">
      <div class="container px-0 px-lg-3">
        <nav class="navbar navbar-expand-lg navbar-light py-3 px-lg-0"><a class="navbar-brand" href="index.php"><span class="font-weight-bold text-uppercase text-dark">CYBER SPORT</span></a>
          <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                <!-- Link-->
                <a class="nav-link active" href="index.php">Home</a>
              </li>
              <li class="nav-item">
                <!-- Link-->
                <a class="nav-link" href="shop.php">Shop</a>
              </li>  
              <li class="nav-item">
                <!-- Link-->
                <a class="nav-link" href="diskon.php">Diskon</a>
              </li>              
              <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" id="pagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Kategori</a>
                <div class="dropdown-menu mt-3" aria-labelledby="pagesDropdown">
                  <?php 
                  $kategori = mysqli_query($koneksi,"SELECT * FROM kategori");
                  while($k = mysqli_fetch_array($kategori)){
                    ?>
                    <a class="dropdown-item border-0 transition-link" href="produk_kategori.php?id=<?php echo $k['kategori_id'] ?>"><?php echo $k['kategori_nama']; ?></a>
                    <?php
                  }
                  ?>
                </div>
              </li>
              <li class="nav-item">
                <!-- Link-->
                <a class="nav-link" href="login.php">Admin</a>
              </li>
            </ul>
            <ul class="navbar-nav ml-auto">               
              <li class="nav-item">
                <?php 
                if(isset($_SESSION['keranjang'])){
                  $jumlah_isi_keranjang = count($_SESSION['keranjang']);
                }else{
                  $jumlah_isi_keranjang = 0;
                }
                ?>
                <a class="nav-link" href="keranjang.php"> <i class="fas fa-dolly-flatbed mr-1 text-gray"></i>Cart<small class="text-gray"> (<?php echo $jumlah_isi_keranjang; ?>)</small></a>
              </li>


              <?php 
              if(isset($_SESSION['customer_status'])){
                $id_customer = $_SESSION['customer_id'];
                $customer = mysqli_query($koneksi,"select * from customer where customer_id='$id_customer'");
                $c = mysqli_fetch_assoc($customer);
                ?>
                <!-- Account -->
                <li class="nav-item">
                  <a class="nav-link" href="customer.php"> <i class="fas fa-user-alt mr-1 text-gray"></i><?php echo $c['customer_nama']; ?></a>
                </li>
                <?php
              }else{
                ?>
                <li class="nav-item">
                  <a class="nav-link" href="masuk.php"> <i class="fas fa-user-alt mr-1 text-gray"></i>Login</a>
                </li>
               <?php
             }
             ?>

              <?php 
              $total_berat = 0;
              if(isset($_SESSION['keranjang'])){

                $jumlah_isi_keranjang = count($_SESSION['keranjang']);

                if($jumlah_isi_keranjang != 0){
                        // cek apakah produk sudah ada dalam keranjang
                  for($a = 0; $a < $jumlah_isi_keranjang; $a++){
                    $id_produk = $_SESSION['keranjang'][$a]['produk'];
                    $isi = mysqli_query($koneksi,"select * from produk where produk_id='$id_produk'");
                    $i = mysqli_fetch_assoc($isi);

                    $total_berat += $i['produk_berat'];                             
                  }
                }
              }else{
                // echo "<center>Keranjang Masih Kosong.</center>";
              }
              ?>
            </ul>
          </div>
        </nav>
      </div>
    </header>