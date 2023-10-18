<?php include 'header.php'; ?>
<!--  Modal -->
<div class="container">
	<!-- HERO SECTION-->
	<section class="py-5 bg-light">
		<div class="container">
			<div class="row px-4 px-lg-5 py-lg-4 align-items-center">
				<div class="col-lg-6">
					<h1 class="h2 text-uppercase mb-0">KERANJANG BELANJA</h1>
				</div>
				<div class="col-lg-6 text-lg-right">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb justify-content-lg-end mb-0 px-0">
							<li class="breadcrumb-item"><a href="index.php">Home</a></li>
							<li class="breadcrumb-item active" aria-current="page">Cart</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<form method="post" action="keranjang_update.php">
		<?php 
		if(isset($_GET['alert'])){
			if($_GET['alert'] == "keranjang_kosong"){
				echo "<div class='alert alert-danger text-center'>Tidak bisa checkout, karena keranjang belanja masih kosong. <br/> Silahkan belanja terlebih dulu.</div>";
			}
		}
		?>

		<?php 
		if(isset($_SESSION['keranjang'])){
			$jumlah_isi_keranjang = count($_SESSION['keranjang']);
			if($jumlah_isi_keranjang != 0){
				?>
				<section class="py-5">
					<h2 class="h5 text-uppercase mb-4">Shopping cart</h2>
					<div class="row">
						<div class="col-lg-12 mb-4 mb-lg-0">
							<!-- CART TABLE-->
							<div class="table-responsive mb-4">
								<table class="table">
									<thead class="bg-light">
										<tr>
											<th class="border-0" scope="col"> <strong class="text-small text-uppercase">Produk</strong></th>
											<th class="border-0" scope="col"> <strong class="text-small text-uppercase">Harga</strong></th>
											<th class="border-0" scope="col"> <strong class="text-small text-uppercase">Jumlah</strong></th>
											<th class="border-0" scope="col"> <strong class="text-small text-uppercase">Total Harga</strong></th>
											<th class="border-0" scope="col"> </th>
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
													<th class="pl-0 border-0" scope="row">
														<div class="media align-items-center"><a class="reset-anchor d-block animsition-link" href="produk_detail.php?id=<?php echo $i['produk_id'] ?>"><img src="gambar/produk/<?php echo $i['produk_foto1'] ?>" alt="..." width="70"/></a>
															<div class="media-body ml-3"><strong class="h6"><a class="reset-anchor animsition-link" href="produk_detail.php?id=<?php echo $i['produk_id'] ?>"><?php echo $i['produk_nama']; ?></a></strong></div>
														</div>
													</th>
													<td class="align-middle border-0">
														<p class="mb-0 small"><?php echo "Rp.".number_format($i['produk_harga']); ?></p>
													</td>
													<td class="align-middle border-0">
														<div class="border d-flex align-items-center justify-content-between px-3"><span class="small text-uppercase text-gray headings-font-family">Jumlah</span>
															<div class="quantity">

																<input id="harga_<?php echo $i['produk_id'] ?>" type="hidden" value="<?php echo $i['produk_harga']; ?>">
																<input name="produk[]" value="<?php echo $i['produk_id'] ?>" type="hidden">

																<input class="form-control form-control-sm border-0 shadow-0 p-0" name="jumlah[]" id="jumlah_<?php echo $i['produk_id'] ?>" nomor="<?php echo $i['produk_id'] ?>" type="number" value="<?php echo $_SESSION['keranjang'][$a]['jumlah']; ?>" min="1">
																<!--<input class="input jumlah" name="jumlah[]" id="jumlah_<?php echo $i['produk_id'] ?>" nomor="<?php echo $i['produk_id'] ?>" type="number" value="<?php echo $_SESSION['keranjang'][$a]['jumlah']; ?>" min="1">  -->
															</div>
														</div>
													</td>
													<td class="align-middle border-0">
														<p class="mb-0 small"><strong class="primary-color total_harga" id="total_<?php echo $i['produk_id'] ?>"><?php echo "Rp. ".number_format($total) . " ,-"; ?></strong></p>
													</td>
													<td class="align-middle border-0">
														<a class="reset-anchor" href="keranjang_hapus.php?id=<?php echo $i['produk_id']; ?>&redirect=keranjang"><i class="fas fa-trash-alt small text-muted"></i></a>
													</td>
												</tr>										
												<?php
											}else{
												$total += $i['produk_harga_diskon']*$jml;
												$jumlah_total += $total;

												?>
												<tr>
													<th class="pl-0 border-0" scope="row">
														<div class="media align-items-center"><a class="reset-anchor d-block animsition-link" href="produk_detail.php?id=<?php echo $i['produk_id'] ?>"><img src="gambar/produk/<?php echo $i['produk_foto1'] ?>" alt="..." width="70"/></a>
															<div class="media-body ml-3"><strong class="h6"><a class="reset-anchor animsition-link" href="produk_detail.php?id=<?php echo $i['produk_id'] ?>"><?php echo $i['produk_nama']; ?></a></strong></div>
														</div>
													</th>
													<td class="align-middle border-0">
														<p class="mb-0 small"><?php echo "Rp.".number_format($i['produk_harga_diskon']); ?></p>
													</td>
													<td class="align-middle border-0">
														<div class="border d-flex align-items-center justify-content-between px-3"><span class="small text-uppercase text-gray headings-font-family">Jumlah</span>
															<div class="quantity">

																<input id="harga_<?php echo $i['produk_id'] ?>" type="hidden" value="<?php echo $i['produk_harga_diskon']; ?>">
																<input name="produk[]" value="<?php echo $i['produk_id'] ?>" type="hidden">




																<input class="form-control form-control-sm border-0 shadow-0 p-0" name="jumlah[]" id="jumlah_<?php echo $i['produk_id'] ?>" nomor="<?php echo $i['produk_id'] ?>" type="number" value="<?php echo $_SESSION['keranjang'][$a]['jumlah']; ?>" min="1">																
															</div>
														</div>
													</td>
													<td class="align-middle border-0">
														<p class="mb-0 small"><?php echo "Rp. ".number_format($total) ; ?></p>
													</td>
													<td class="align-middle border-0">
														<a class="reset-anchor" href="keranjang_hapus.php?id=<?php echo $i['produk_id']; ?>&redirect=keranjang"><i class="fas fa-trash-alt small text-muted"></i></a>
													</td>
												</tr>										
												<?php
											}

											$total = 0;

											
										}

										?>

									</tbody>
								</table>
							</div>
							<!-- CART NAV-->
							<div class="bg-light px-4 py-3">
								<div class="row align-items-center text-center">
									<div class="col-md-6 mb-3 mb-md-0 text-md-left">
										<input type="submit" class="btn btn-link p-0 text-dark btn-sm" value="Update Keranjang">									
									</div>
									<div class="col-md-6 text-md-right">									
										<a class="btn btn-outline-dark btn-sm" href="checkout.php">checkout<i class="fas fa-long-arrow-alt-right ml-2"></i></a>
									</div>
								</div>
							</div>
						</div>
						<!-- ORDER TOTAL-->
					<!-- <div class="col-lg-4">
						<div class="card border-0 rounded-0 p-lg-4 bg-light">
							<div class="card-body">
								<h5 class="text-uppercase mb-4">Cart total</h5>
								<ul class="list-unstyled mb-0">
									<li class="d-flex align-items-center justify-content-between"><strong class="text-uppercase small font-weight-bold">Subtotal</strong><span class="text-muted small">$250</span></li>
									<li class="border-bottom my-2"></li>
									<li class="d-flex align-items-center justify-content-between mb-4"><strong class="text-uppercase small font-weight-bold">Total</strong><span>$250</span></li>
									<li>
										<form action="#">
											<div class="form-group mb-0">
												<input class="form-control" type="text" placeholder="Enter your coupon">
												<button class="btn btn-dark btn-sm btn-block" type="submit"> <i class="fas fa-gift mr-2"></i>Apply coupon</button>
											</div>
										</form>
									</li>
								</ul>
							</div>
						</div>
					</div> -->
				</div>
			</section>
			<?php
		}else{
			echo "<br><br><br><h3><center>Keranjang Masih Kosong. Yuk <a href='index.php'>belanja</a> !</center></h3><br><br><br>";
		}
	}else{
		echo "<br><br><br><h3><center>Keranjang Masih Kosong. Yuk <b><a href='index.php'>belanja</a> </b>!</center></h3><br><br><br>";
	}

	?>  
	<form method="post" action="keranjang_update.php">      
	</div>
	<?php include 'footer.php'; ?>