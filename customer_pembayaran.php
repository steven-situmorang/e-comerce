<?php include 'header.php'; ?>

<div class="container">
	<!-- HERO SECTION-->
	<section class="py-5 bg-light">
		<div class="container">
			<div class="row px-4 px-lg-5 py-lg-4 align-items-center">
				<div class="col-lg-6">
					<h1 class="h2 text-uppercase mb-0">Pembayaran Customer</h1>
				</div>
				<div class="col-lg-6 text-lg-right">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb justify-content-lg-end mb-0 px-0">
							<li class="breadcrumb-item"><a href="index.php">Home</a></li>
							<li class="breadcrumb-item active" aria-current="page">Pembayaran</li>
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
						
						<div class="table-responsive">
							<table class="table table-bordered">
								<tbody>
									<?php 
									$id_invoice = $_GET['id'];
									$id = $_SESSION['customer_id'];
									$invoice = mysqli_query($koneksi,"select * from invoice where invoice_customer='$id' and invoice_id='$id' order by invoice_id desc");
									while($i = mysqli_fetch_array($invoice)){
										?>
										<tr>
											<th width="20%">No.Invoice</th>	
											<td>INVOICE-00<?php echo $i['invoice_id'] ?></td>
										</tr>
										<tr>
											<th>Tanggal</th>	
											<td><?php echo date('d-m-Y', strtotime($i['invoice_tanggal'])) ?></td>
										</tr>
										<tr>
											<th>Total Bayar</th>	
											<td><?php echo "Rp. ".number_format($i['invoice_total_bayar'])." ,-" ?></td>
										</tr>
										<tr>
											<th>Status</th>	
											<td>

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
											</td>
										</tr>
										<?php 
									}
									?>
								</tbody>
							</table>
							<p>Silahkan Lakukan Pembayaran Ke Nomor Rekening Berikut :</p>						
							<table class="table table-bordered">
								<tr>
									<th width="30%">Nomor Rekening</th>
									<td>123-122-3345</td>
								</tr>
								<tr>
									<th>Atas Nama</th>
									<td>Toko Cyber Sport</td>
								</tr>
								<tr>
									<th>Bank</th>
									<td>BRI</td>
								</tr>
							</table>
							<br/>

							<form action="customer_pembayaran_act.php" method="post" enctype="multipart/form-data">
								<div class="form-group">
									<input type="hidden" name="id" value="<?php echo $id_invoice; ?>">
									<label>Upload Bukti Pembayaran</label><br>
									<input type="file" name="bukti" required="required"><br>
									<small class="text-muted">File yang diperbolehkan hanya file gambar.</small>
								</div>
								<input type="submit" value="Upload Bukti Pembayaran" class=" btn btn-danger btn-sm">
							</form>

						</div>

					</div>
				</div>
			</div>
		</div>
	</section>

</div>
<?php include 'footer.php'; ?>