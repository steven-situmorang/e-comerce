<?php include 'header.php'; ?>

<div class="container">
	<!-- HERO SECTION-->
	<section class="py-5 bg-light">
		<div class="container">
			<div class="row px-4 px-lg-5 py-lg-4 align-items-center">
				<div class="col-lg-6">
					<h1 class="h2 text-uppercase mb-0">Pesanan Customer</h1>
				</div>
				<div class="col-lg-6 text-lg-right">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb justify-content-lg-end mb-0 px-0">
							<li class="breadcrumb-item"><a href="index.php">Home</a></li>
							<li class="breadcrumb-item active" aria-current="page">Pesanan</li>
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
							<table class="table table-striped">
								<thead>
									<tr>
										<th width="1%">NO</th>
										<th>No.Invoice</th>
										<th>Penerima</th>
										<th>Total Bayar</th>
										<th class="text-center">Status</th>
										<th width="25%" class="text-center">OPSI</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									$no=1;
									$id = $_SESSION['customer_id'];
									$invoice = mysqli_query($koneksi,"select * from invoice where invoice_customer='$id' order by invoice_id desc");
									while($i = mysqli_fetch_array($invoice)){
										?>
										<tr>
											<td><?php echo $no++ ?></td>
											<td>INVOICE-00<?php echo $i['invoice_id'] ?></td>
											<td><?php echo $i['invoice_nama'] ?></td>
											<td><?php echo "Rp. ".number_format($i['invoice_total_bayar'])." ,-" ?></td>
											<td class="text-center">
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
											<td class="text-center">
												<?php 
												if($i['invoice_status'] == 0){
													?>
													<a class='btn btn-sm btn-primary' href="customer_pembayaran.php?id=<?php echo $i['invoice_id']; ?>"><i class="far fa-money-bill-alt"></i> Bayar</a>
													<?php
												}elseif($i['invoice_status'] == 1){
													?>
													<a class='btn btn-sm btn-primary' href="customer_pembayaran.php?id=<?php echo $i['invoice_id']; ?>"><i class="far fa-money-bill-alt"></i> Bayar</a>
													<?php
												}
												?>
												<a class='btn btn-sm btn-success' href="customer_invoice.php?id=<?php echo $i['invoice_id']; ?>"><i class="fa fa-print"></i> Invoice</a>
											</td>
										</tr>
										<?php 
									}
									?>
								</tbody>
							</table>
						</div>				
					</div>
				</div>
			</div>
		</div>
	</section>

</div>
<?php include 'footer.php'; ?>