<?php include 'header.php'; ?>

<div class="container">
  <!-- HERO SECTION-->
  <section class="py-5 bg-light">
    <div class="container">
      <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
        <div class="col-lg-6">
          <h1 class="h2 text-uppercase mb-0">Sport Station Shop</h1>
        </div>
        <div class="col-lg-6 text-lg-right">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-lg-end mb-0 px-0">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Shop</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </section>
  <section class="py-5">
    <div class="container p-0">
      <div class="row">
        <!-- SHOP SIDEBAR-->
        <div class="col-lg-3 order-2 order-lg-1">
          <!-- <h5 class="text-uppercase mb-4">KATEGORI</h5> -->
          <div class="py-2 px-4 bg-dark text-white mb-3"><strong class="small text-uppercase font-weight-bold">KATEGORI</strong></div>
          <ul class="list-unstyled small text-muted pl-lg-4 font-weight-normal">
            <?php 
            $kategori = mysqli_query($koneksi,"SELECT * FROM kategori");
            while($k = mysqli_fetch_array($kategori)){
              ?>
              <li class="mb-2"><a class="reset-anchor" href="produk_kategori.php?id=<?php echo $k['kategori_id'] ?>"><?php echo $k['kategori_nama'] ?></a></li>
              <?php
            }
            ?>                              
          </ul>                
        </div>
        <!-- SHOP LISTING-->
        <div class="col-lg-9 order-1 order-lg-2 mb-5 mb-lg-0">

          <div class="row">
            <?php 
            $data = mysqli_query($koneksi,"SELECT * FROM produk ORDER BY produk_id DESC");
            while($d = mysqli_fetch_array($data)){
              ?>
              <div class="col-lg-4 col-sm-6">
                <div class="product text-center">
                  <div class="mb-3 position-relative">
                    <a class="d-block" href="produk_detail.php?id=<?php echo $d['produk_id'] ?>"><img class="img-fluid w-100" src="gambar/produk/<?php echo $d['produk_foto1'] ?>" alt="..."></a>
                    <div class="product-overlay">
                      <ul class="mb-0 list-inline">
                        <li class="list-inline-item m-0 p-0">
                          <a class="btn btn-sm btn-dark" href="keranjang_masukkan.php?id=<?php echo $d['produk_id']; ?>&redirect=index">Add to cart</a>                        
                        </li>
                      </ul>
                    </div>
                  </div>
                  <h6> <a class="reset-anchor" href="produk_detail.php?id=<?php echo $d['produk_id'] ?>"><?php echo  $d['produk_nama']; ?></a></h6>
                  <p class="small text-muted"><?php echo "Rp.".number_format($d['produk_harga']); ?></p>
                </div>
              </div>
              <?php
            }
            ?>
            <!-- PRODUCT-->

           
          </div>
        </div>
      </div>
    </section>
  </div>     
  <?php include 'footer.php'; ?>