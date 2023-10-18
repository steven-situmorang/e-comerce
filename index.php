<?php include 'header.php'; ?>
      <!-- HERO SECTION-->
      <div class="container">
        <section class="hero pb-3 bg-cover bg-center d-flex align-items-center" style="background: url(baru/img/banner.jpg)">
          <div class="container py-5">
            <div class="row px-4 px-lg-5">
              <div class="col-lg-6">
                <p class="text-muted small text-uppercase mb-2">New Jersey Australia </p>
                <h1 class="h2 text-uppercase mb-3">20% off on new season</h1><a class="btn btn-dark" href="shop.php">Sport collections</a>
              </div>
            </div>
          </div>
        </section>
        <!-- CATEGORIES SECTION-->
        <section class="pt-5">
          <header class="text-center">            
            <h2 class="h5 text-uppercase mb-4">original collection</h2>
          </header>
          <div class="row">
            <div class="col-md-4 mb-4 mb-md-0"><a class="category-item" href="#"><img class="img-fluid" src="baru/img/cat-img-1.jpg" alt=""></a></div>

            <div class="col-md-4 mb-4 mb-md-0"><a class="category-item mb-4" href="#"><img class="img-fluid" src="baru/img/cat-img-2.jpg" alt=""></a><a class="category-item" href="#"><img class="img-fluid" src="baru/img/cat-img-3.jpg" alt=""></a></div>

            <div class="col-md-4"><a class="category-item" href="#"><img class="img-fluid" src="baru/img/cat-img-4.jpg" alt=""></a></div>
          </div>
        </section>
        <!-- TRENDING PRODUCTS-->
        <section class="py-5">
          <header>
            <p class="small text-muted small text-uppercase mb-1">The main quality</p>
            <h2 class="h5 text-uppercase mb-4">Top trending products</h2>
          </header>
          <div class="row">
            <!-- PRODUCT-->

            <?php 
              $top = mysqli_query($koneksi,"SELECT * FROM produk order by rand() limit 8");
              while($t = mysqli_fetch_array($top)){
                ?>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                  <div class="product text-center">
                    <div class="position-relative mb-3">
                      <div class="badge text-white badge-"></div><a class="d-block" href="produk_detail.php?id=<?php echo $t['produk_id'] ?>"><img class="img-fluid w-100" src="gambar/produk/<?php echo $t['produk_foto1'] ?>" alt="..."></a>
                      <div class="product-overlay">
                        <ul class="mb-0 list-inline">                        
                          <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-dark" href="keranjang_masukkan.php?id=<?php echo $t['produk_id']; ?>&redirect=index">Add to cart</a></li>
                        </ul>
                      </div>
                    </div>
                    <h6> <a class="reset-anchor" href="produk_detail.php?id=<?php echo $t['produk_id'] ?>"><?php echo $t['produk_nama']; ?></a></h6>
                    <p class="small text-muted"><?php echo "Rp.".number_format($t['produk_harga']); ?></p>
                  </div>
                </div>
                <?php
              }
             ?>
                      
        </section>
        <!-- SERVICES-->
        <section class="py-5 bg-light">
          <div class="container">
            <div class="row text-center">
              <div class="col-lg-4 mb-3 mb-lg-0">
                <div class="d-inline-block">
                  <div class="media align-items-end">
                    <svg class="svg-icon svg-icon-big svg-icon-light">
                      <use xlink:href="#delivery-time-1"> </use>
                    </svg>
                    <div class="media-body text-left ml-3">
                      <h6 class="text-uppercase mb-1">Free shipping</h6>
                      <p class="text-small mb-0 text-muted">Free shipping worlwide</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 mb-3 mb-lg-0">
                <div class="d-inline-block">
                  <div class="media align-items-end">
                    <svg class="svg-icon svg-icon-big svg-icon-light">
                      <use xlink:href="#helpline-24h-1"> </use>
                    </svg>
                    <div class="media-body text-left ml-3">
                      <h6 class="text-uppercase mb-1">24 x 7 service</h6>
                      <p class="text-small mb-0 text-muted">Free shipping worlwide</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="d-inline-block">
                  <div class="media align-items-end">
                    <svg class="svg-icon svg-icon-big svg-icon-light">
                      <use xlink:href="#label-tag-1"> </use>
                    </svg>
                    <div class="media-body text-left ml-3">
                      <h6 class="text-uppercase mb-1">Festival offer</h6>
                      <p class="text-small mb-0 text-muted">Free shipping worlwide</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- NEWSLETTER-->       
      </div>
     <?php include 'footer.php'; ?>