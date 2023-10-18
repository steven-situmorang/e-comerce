<?php include 'header.php'; ?>

<div class="container">
	<!-- HERO SECTION-->
	<section class="py-5 bg-light">
		<div class="container">
			<div class="row px-4 px-lg-5 py-lg-4 align-items-center">
				<div class="col-lg-6">
					<h1 class="h2 text-uppercase mb-0">Dashbord Customer</h1>
				</div>
				<div class="col-lg-6 text-lg-right">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb justify-content-lg-end mb-0 px-0">
							<li class="breadcrumb-item"><a href="index.php">Home</a></li>
							<li class="breadcrumb-item active" aria-current="page">Dashbord</li>
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
				<div class="col-lg-3 order-2 order-lg-2 mb-5 mb-lg-0">
					<div class="well">
						<?php include 'customer_sidebar.php' ?>
					</div>
				</div>
				<!-- SHOP LISTING-->
				<div class="col-lg-9 order-2 order-lg-2 mb-5 mb-lg-0">
					<div class="well">															
						<h5>Halo, Selamat Datang!</h5>
						<div class="table-responsive">						
							<table class="table table-striped">
								<tbody>
									<?php 
									$id = $_SESSION['customer_id'];
									$customer = mysqli_query($koneksi,"select * from customer where customer_id='$id'");
									while($i = mysqli_fetch_array($customer)){
										?>
										<tr>
											<th width="20%">Nama</th>	
											<td><?php echo $i['customer_nama'] ?></td>
										</tr>
										<tr>
											<th width="20%">Email</th>	
											<td><?php echo $i['customer_email'] ?></td>
										</tr>
										<tr>
											<th>HP</th>	
											<td><?php echo $i['customer_hp'] ?></td>
										</tr>
										<tr>
											<th>Alamat</th>	
											<td><?php echo $i['customer_alamat'] ?></td>
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