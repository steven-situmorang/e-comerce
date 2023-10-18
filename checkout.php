<?php include 'header.php'; ?>
<!--  Modal -->      
<div class="container">
  <!-- HERO SECTION-->
  <section class="py-5 bg-light">
    <div class="container">
      <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
        <div class="col-lg-6">
          <h1 class="h2 text-uppercase mb-0">Checkout</h1>
        </div>
        <div class="col-lg-6 text-lg-right">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-lg-end mb-0 px-0">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item"><a href="keranjang.php">Cart</a></li>
              <li class="breadcrumb-item active" aria-current="page">Checkout</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </section>
  <section class="py-5">
    <!-- BILLING ADDRESS-->
    <h2 class="h5 text-uppercase mb-4">INFORMASI PEMBELI / PENERIMA BARANG</h2>
    <div class="row">
      <div class="col-lg-6">
        <form method="post" action="checkout_act.php">
          <div class="row">

            <div class="col-lg-6 form-group">
              <label class="text-small text-uppercase" for="firstName">Nama Penerima</label>
              <input class="form-control form-control-lg" id="firstName" type="text" name="nama" placeholder="Masukkan nama pemesan .." required="required">
            </div>
            <div class="col-lg-6 form-group">
              <label class="text-small text-uppercase" for="phone">Telpon/Handphone</label>
              <input class="form-control form-control-lg" id="phone" name="hp" placeholder="Masukkan no.hp aktif .." required="required">
            </div>          
            <div class="col-lg-12 form-group">
              <label class="text-small text-uppercase" for="address">Alamat Lengkap</label>
              <textarea class="form-control form-control-lg" name="alamat" required="required" placeholder="Alamat Lengkap"></textarea>
            </div>

            <?php 
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => "http://api.rajaongkir.com/starter/province",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "GET",
              CURLOPT_HTTPHEADER => array(
                "key: 8f22875183c8c65879ef1ed0615d3371"
              ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);
            $data_provinsi = json_decode($response, true);
            ?>


            <div class="col-lg-12 form-group">
              <label class="text-small text-uppercase" for="phone">Provinsi Tujuan</label>
              <select class="form-control form-control-lg" name='provinsi' id='provinsi'>
                <option>Pilih Provinsi Tujuan</option>
                <?php 
                for ($i=0; $i < count($data_provinsi['rajaongkir']['results']); $i++) {
                  echo "<option value='".$data_provinsi['rajaongkir']['results'][$i]['province_id']."'>".$data_provinsi['rajaongkir']['results'][$i]['province']."</option>";
                }
                ?>
              </select>
            </div>

            <div class="col-lg-12 form-group">
              <label class="text-small text-uppercase" for="phone">Kabupaten/Kota Tujuan</label>
              <select class="form-control form-control-lg" id="kabupaten" name="kabupaten">                
              </select>
            </div>
            <input name="kurir" id="kurir" value="" required="required" type="hidden">
            <input name="ongkir2" id="ongkir2" value="" required="required" type="hidden">
            <input name="service" id="service" value="" required="required" type="hidden">
            <input name="provinsi2" id="provinsi2" value="" required="required" type="hidden"> 
            <input name="kabupaten2" id="kabupaten2" value="" required="required" type="hidden"> 
            <div id="ongkir"></div>


         <!--    <div class="col-lg-12 form-group">
              <button class="btn btn-dark" type="submit">Place order</button>
            </div> -->

            <div class="col-lg-12 form-group">               
              <div class="buttons form-group required">
                <a href="keranjang.php" class="btn btn-primary">KEMBALI KE KERANJANG</a>  
                <input type="submit" value="BUAT PESANAN" class="btn btn-danger float-right" /> 
              </div>                
            </div>

          </div>

        </div>
        <!-- ORDER SUMMARY-->
        <div class="col-lg-6">
          <div class="card border-0 rounded-0 p-lg-4 bg-light">
            <div class="card-body">
              <?php 
              if(isset($_SESSION['keranjang'])){
                $jumlah_isi_keranjang = count($_SESSION['keranjang']);
                if($jumlah_isi_keranjang != 0){
                  ?>
                  
                  <table class="shopping-cart-table table">
                    <thead>
                      <tr>
                        <th>Produk</th>
                        <th class="text-center">Harga</th>
                        <th class="text-center">Jumlah</th>
                        <th class="text-center">Total Harga</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php
                      // cek apakah produk sudah ada dalam keranjang
                      $jumlah_total = 0;
                      $total = 0;
                      for($a = 0; $a < $jumlah_isi_keranjang; $a++){
                        $id_produk = $_SESSION['keranjang'][$a]['produk'];
                        $jml = $_SESSION['keranjang'][$a]['jumlah'];

                        $isi = mysqli_query($koneksi,"select * from produk where produk_id='$id_produk'");
                        $i = mysqli_fetch_assoc($isi);

                        if($i['produk_harga_diskon']=="0"){
                          $total += $i['produk_harga']*$jml;
                          $jumlah_total += $total;
                          ?>

                          <tr>
                            <td>                        
                              <?php echo $i['produk_nama'] ?>
                            </td>
                            <td class="text-center">
                              <?php echo "Rp. ".number_format($i['produk_harga']) ; ?>
                            </td>
                            <td class="qty text-center">
                              <?php echo $_SESSION['keranjang'][$a]['jumlah']; ?>
                            </td>
                            <td class="text-center"><strong class="primary-color total_harga" id="total_<?php echo $i['produk_id'] ?>"><?php echo "Rp. ".number_format($total) ; ?></strong></td>
                          </tr>

                          <?php
                        }else{
                          $total += $i['produk_harga_diskon']*$jml;
                          $jumlah_total += $total;
                          ?>

                          <tr>
                            <td>                        
                              <?php echo $i['produk_nama'] ?>
                            </td>
                            <td class="text-center">
                              <?php echo "Rp. ".number_format($i['produk_harga_diskon']) ; ?>
                            </td>
                            <td class="qty text-center">
                              <?php echo $_SESSION['keranjang'][$a]['jumlah']; ?>
                            </td>
                            <td class="text-center"><strong class="primary-color total_harga" id="total_<?php echo $i['produk_id'] ?>"><?php echo "Rp. ".number_format($total) ; ?></strong></td>
                          </tr>

                          <?php
                        }
                        $total = 0;

                      }

                      ?>

                    </tbody>
                    <tfoot>
                      <tr>
                        <th class="empty" colspan="2"></th>
                        <th>TOTAL BERAT</th>
                        <th class="text-center"><?php echo $total_berat; ?> Gram</th>
                      </tr>
                      <tr>
                        <th class="empty" colspan="2"></th>
                        <th>ONGKIR</th>
                        <th class="text-center"><span id="tampil_ongkir"><?php echo "Rp. 0 ,-"; ?></span></th>
                      </tr>
                      <tr>
                        <th class="empty" colspan="2"></th>
                        <th>TOTAL BAYAR</th>
                        <th class="text-center"><span id="tampil_total"><?php echo "Rp. ".number_format($jumlah_total) ; ?></span></th>
                      </tr>
                    </tfoot>
                  </table>

                  <input name="berat" id="berat2" value="<?php echo $total_berat ?>" type="hidden">
                  <input type="hidden" name="total_bayar" id="total_bayar" value="<?php echo $jumlah_total; ?>">

                  <?php
                }else{
                  echo "<br><br><br><h3><center>Keranjang Masih Kosong. Yuk <a href='index.php'>belanja</a> !</center></h3><br><br><br>";              
                }
              }else{
                echo "<br><br><br><h3><center>Keranjang Masih Kosong. Yuk <a href='index.php'>belanja</a> !</center></h3><br><br><br>";
              }

              ?>


           <!--  <ul class="list-unstyled mb-0">
              <li class="d-flex align-items-center justify-content-between"><strong class="small font-weight-bold">Red digital smartwatch</strong><span class="text-muted small">$250</span></li>
              <li class="border-bottom my-2"></li>
              <li class="d-flex align-items-center justify-content-between"><strong class="small font-weight-bold">Gray Nike running shoes</strong><span class="text-muted small">$351</span></li>
              <li class="border-bottom my-2"></li>
              <li class="d-flex align-items-center justify-content-between"><strong class="text-uppercase small font-weight-bold">Total</strong><span>$601</span></li>
            </ul> -->
          </div>
        </div>
      </div>
    </form>
  </div>
</section>
</div>
<?php include 'footer.php'; ?>