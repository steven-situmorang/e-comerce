<?php include 'header.php'; ?>
<!--  Modal -->

<?php 
$id = $_GET['id'];
$data = mysqli_query($koneksi,"SELECT * FROM produk,kategori where produk_id='$id' and produk_kategori=kategori_id");
$d = mysqli_fetch_assoc($data);
?>
<section class="py-5">
  <div class="container">
    <div class="row mb-5">
      <div class="col-lg-6">
        <!-- PRODUCT SLIDER-->
        <div class="row m-sm-0">
          <div class="col-sm-2 p-sm-0 order-2 order-sm-1 mt-2 mt-sm-0">
            <div class="owl-thumbs d-flex flex-row flex-sm-column" data-slider-id="1">

              <?php 
              if($d['produk_foto1']==""){
                ?>
                <div class="owl-thumb-item flex-fill mb-2 mr-2 mr-sm-0"><img class="w-100" src="/gambar/sistem/produk.png" alt="..."></div>                      
                <?php
              }else{
                ?>
                <div class="owl-thumb-item flex-fill mb-2 mr-2 mr-sm-0"><img class="w-100" src="gambar/produk/<?php echo $d['produk_foto1'] ?>" alt="..."></div>                      
                <?php
              }
              ?>

              <?php 
              if($d['produk_foto2']==""){
                ?>
                <div class="owl-thumb-item flex-fill mb-2 mr-2 mr-sm-0"><img class="w-100" src="gambar/sistem/produk.png" alt="..."></div>                      
                <?php
              }else{
                ?>
                <div class="owl-thumb-item flex-fill mb-2 mr-2 mr-sm-0"><img class="w-100" src="gambar/produk/<?php echo $d['produk_foto2'] ?>" alt="..."></div>                      
                <?php
              }
              ?>
              <?php 
              if($d['produk_foto3']==""){
                ?>
                <div class="owl-thumb-item flex-fill mb-2 mr-2 mr-sm-0"><img class="w-100" src="gambar/sistem/produk.png" alt="..."></div>
                <?php
              }else{
                ?>
                <a class="d-none" href="gambar/produk/<?php echo $d['produk_foto3'] ?>" title="Red digital smartwatch" data-lightbox="productview"></a>
                <?php
              }
              ?>

            </div>
          </div>
          <div class="col-sm-10 order-1 order-sm-2">
            <div class="owl-carousel product-slider" data-slider-id="1">
              <?php 
              if($d['produk_foto1']==""){
                ?>
                <a class="d-block" href="gambar/sistem/produk.png" data-lightbox="product" title="Product item 1"><img class="img-fluid" src="gambar/sistem/produk.png" alt="..."></a>
                <?php

              }else{
                ?>
                <a class="d-block" href="gambar/produk/<?php echo $d['produk_foto1'] ?>" data-lightbox="product" title="Product item 1"><img class="img-fluid" src="gambar/produk/<?php echo $d['produk_foto1'] ?>" alt="..."></a>
                <?php
              }
              ?>

              <?php 
              if($d['produk_foto2']==""){
                ?>
                <a class="d-block" href="gambar/sistem/produk.png" data-lightbox="product" title="Product item 2"><img class="img-fluid" src="gambar/sistem/produk.png" alt="..."></a>
                <?php
              }else{
                ?>
                <a class="d-block" href="gambar/produk/<?php echo $d['produk_foto2'] ?>" data-lightbox="product" title="Product item 2"><img class="img-fluid" src="gambar/produk/<?php echo $d['produk_foto2'] ?>" alt="..."></a>
                <?php
              }
              ?>

              <?php 
              if($d['produk_foto3']==""){
                ?>
                <a class="d-block" href="gambar/sistem/produk.png" data-lightbox="product" title="Product item 3"><img class="img-fluid" src="gambar/sistem/produk.png" alt="..."></a>
                <?php
              }else{
                ?>
                <a class="d-block" href="gambar/produk/<?php echo $d['produk_foto3'] ?>" data-lightbox="product" title="Product item 3"><img class="img-fluid" src="gambar/produk/<?php echo $d['produk_foto3'] ?>" alt="..."></a>  
                <?php
              }
              ?>

            </div>
          </div>
        </div>
      </div>
      <!-- PRODUCT DETAILS-->
      <div class="col-lg-6">
        <ul class="list-inline mb-2">
          <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
          <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
          <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
          <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
          <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
        </ul>
        <h1><?php echo $d['produk_nama']; ?></h1>
        <p class="text-muted lead"><?php echo "Rp.".number_format($d['produk_harga']); ?></p>              
        <div class="row align-items-stretch mb-4">
          <div class="col-sm-5 pr-sm-0">
            <div class="border d-flex align-items-center justify-content-between py-1 px-3 bg-white border-white"><span class="small text-uppercase text-gray mr-4 no-select">Jumlah</span>
              <div class="quantity">
                <button class="dec-btn p-0"><i class="fas fa-caret-left"></i></button>
                <input class="form-control border-0 shadow-0 p-0" type="text" value="1">
                <button class="inc-btn p-0"><i class="fas fa-caret-right"></i></button>
              </div>
            </div>
          </div>
          <div class="col-sm-3 pl-sm-0"><a class="btn btn-dark btn-sm btn-block h-100 d-flex align-items-center justify-content-center px-0" href="keranjang_masukkan.php?id=<?php echo $d['produk_id']; ?>&redirect=index">Add to cart</a></div>
        </div>

        <ul class="list-unstyled small d-inline-block">
          <li class="px-3 py-2 mb-1 bg-white">
            <strong class="text-uppercase">JUMLAH:</strong>
            <span class="ml-2 text-muted"><?php echo $d['produk_jumlah']; ?></span>
          </li>
          <li class="px-3 py-2 mb-1 bg-white">
            <strong class="text-uppercase">BERAT:</strong>
            <span class="ml-2 text-muted"><?php echo $d['produk_berat']." Gram"; ?></span>
          </li>
          <li class="px-3 py-2 mb-1 bg-white text-muted">
            <strong class="text-uppercase text-dark">Category:</strong>
            <a class="reset-anchor ml-2" href="produk_kategori.php?id=<?php echo $d['produk_kategori'] ?>"><?php echo $d['kategori_nama']; ?></a>
          </li>                
        </ul>
      </div>
    </div>
    <!-- DETAILS TABS-->   
    <div class="tab-content">
      <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
        <div class="p-4 p-lg-5 bg-white">
          <h6 class="text-uppercase">Keterangan Produk </h6>
          <p class="text-muted text-small mb-0"><?php echo $d['produk_keterangan']; ?></p>
        </div>
      </div>           
    </div>
    <!-- RELATED PRODUCTS-->
    <h2 class="h5 text-uppercase mb-4">Produk Lainnya</h2>
    <div class="row">
      <?php 
      $kategori = $d['produk_kategori'];
      $lainnya  = mysqli_query($koneksi,"SELECT * FROM produk where produk_kategori='$kategori' order by rand() limit 5");
      while($ll = mysqli_fetch_array($lainnya)){
        ?>
        <div class="col-lg-2 col-sm-6">
          <div class="product text-center skel-loader">
            <div class="d-block mb-3 position-relative"><a class="d-block" href="produk_detil.php?id=<?php echo $ll['produk_id'] ?>"><img class="img-fluid w-100" src="gambar/produk/<?php echo $ll['produk_foto1'] ?>" alt="..."></a>
              <div class="product-overlay">
                <ul class="mb-0 list-inline">                        
                  <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-dark" href="#">Add to cart</a></li>                        
                </ul>
              </div>
            </div>
            <h6> <a class="reset-anchor" href="produk_detail.php?id=<?php echo $ll['produk_id'] ?>"><?php echo $ll['produk_nama']; ?></a></h6>
            <p class="small text-muted"><?php echo "Rp.".number_format($ll['produk_harga']); ?></p>
          </div>
        </div>
        <?php
      }
      ?>

    </div>
  </div>
</section>
<?php include 'footer.php' ?>