<?php include 'header.php'; ?>

<div class="container">
	<!-- HERO SECTION-->
	<section class="py-5 bg-light">
		<div class="container">
			<div class="row px-4 px-lg-5 py-lg-4 align-items-center">
				<div class="col-lg-6">
					<h1 class="h2 text-uppercase mb-0">Invoice Customer</h1>
				</div>
				<div class="col-lg-6 text-lg-right">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb justify-content-lg-end mb-0 px-0">
							<li class="breadcrumb-item"><a href="index.php">Home</a></li>
							<li class="breadcrumb-item active" aria-current="page">Invoice</li>
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
					<div class="well">
						<?php include 'customer_sidebar.php' ?>
					</div>
				</div>
				<!-- SHOP LISTING-->
				<div class="col-lg-9 order-2 order-lg-2 mb-5 mb-lg-0">
					<div class="well">
						
						<?php 
						$id_invoice = $_GET['id'];
						$id = $_SESSION['customer_id'];
						$invoice = mysqli_query($koneksi,"select * from invoice where invoice_customer='$id' and invoice_id='$id_invoice' order by invoice_id desc");
						while($i = mysqli_fetch_array($invoice)){
							?>
							<div class="col-lg-12">
								<a href="customer_invoice_cetak.php?id=<?php echo $_GET['id'] ?>" target="_blank" class="btn btn-success btn-sm float-right"><i class="fa fa-print"></i> CETAK</a>
								<h4>INVOICE-00<?php echo $i['invoice_id'] ?></h4><hr>								
								<?php echo $i['invoice_nama']; ?>
								<?php echo $i['invoice_alamat']; ?><br/>
								<?php echo $i['invoice_provinsi']; ?><br/>
								<?php echo $i['invoice_kabupaten']; ?><br/>
								Hp. <?php echo $i['invoice_hp']; ?><br/>
								Status : 
								<?php 
								if($i['invoice_status'] == 0){
									echo "<span class='badge badge-warning'>Menunggu Pembayaran</span>";
								}elseif($i['invoice_status'] == 1){
									echo "<span class='badge badge-default'>Menunggu Konfirmasi</span>";
								}elseif($i['invoice_status'] == 2){
									echo "<span class='badge badge-danger'>Ditolak</span>";
								}elseif($i['invoice_status'] == 3){
									echo "<span class='badge badge-primary'>Dikonfirmasi & Sedang Diproses</span>";
								}elseif($i['invoice_status'] == 4){
									echo "<span class='badge badge-warning'>Dikirim</span>";
								}elseif($i['invoice_status'] == 5){
									echo "<span class='badge badge-success'>Selesai</span>";
								}
								?>
								<br/>								
								<br>

								<div class="table-responsive">
									<table class="table table-striped">
										<thead>
											<tr>
												<th>NO</th>
												<th>Produk</th>
												<th>Harga</th>
												<th>Jumlah</th>
												<th>Total Harga</th>
											</tr>
										</thead>
										<tbody>
											<?php 
											$no = 1;
											$total = 0;
											$transaksi = mysqli_query($koneksi,"select * from transaksi,produk where transaksi_produk=produk_id and transaksi_invoice='$id_invoice'");
											while($d=mysqli_fetch_array($transaksi)){
												$total += $d['transaksi_harga'];
												?>
												<tr>
													<td><?php echo $no++; ?></td>												
													<td><?php echo $d['produk_nama']; ?></td>
													<td><?php echo "Rp. ".number_format($d['transaksi_harga']).",-"; ?></td>
													<td><?php echo number_format($d['transaksi_jumlah']); ?></td>
													<td><?php echo "Rp. ".number_format($d['transaksi_jumlah'] * $d['transaksi_harga'])." ,-"; ?></td>
												</tr>
												<?php 
											}
											?>
										</tbody>
										<tfoot>
											<tr>
												<td colspan="3"></td>
												<th>Berat</th>
												<td><?php echo number_format($i['invoice_berat']); ?> gram</td>
											</tr>
											<tr>
												<td colspan="3"></td>
												<th>Total Belanja</th>
												<td><?php echo "Rp. ".number_format($total)." ,-"; ?></td>
											</tr>
											<tr>
												<td colspan="3"></td>
												<th>Ongkir (<?php echo $i['invoice_kurir'] ?>)</th>
												<td><?php echo "Rp. ".number_format($i['invoice_ongkir'])." ,-"; ?></td>
											</tr>
											<tr>
												<td colspan="3"></td>
												<th>Total Bayar</th>
												<td><?php echo "Rp. ".number_format($i['invoice_total_bayar'])." ,-"; ?></td>
											</tr>
										</tfoot>
									</table>
								</div>														
							</div>	

							<?php 
						}

						 ?>


					</div>
				</div>
			</div>
		</div>
	</section>

</div>
<?php include 'footer.php'; ?>