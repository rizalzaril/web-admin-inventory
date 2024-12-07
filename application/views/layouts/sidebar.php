<!-- [ Sidebar Menu ] start -->

<style>
	.pc-mtext {
		color: white;
	}

	.pc-micon {
		color: white;
	}
</style>

<nav class="pc-sidebar bg-dark">
	<div class="navbar-wrapper">
		<div class="m-header">
			<a href="../dashboard/index.html" class="b-brand text-primary">
				<!-- ========   Change your logo from here   ============ -->
				<img src="../assets/images/logo-white.svg" alt="logo image" class="logo-lg">
			</a>
		</div>


		<div class="navbar-content">
			<ul class="pc-navbar">
				<li class="pc-item pc-caption text-white">
					<label>Navigation</label>
				</li>
				<li class="pc-item">
					<a href="<?= base_url('admin/dashboard') ?>" class="pc-link"><span class="pc-micon">
							<i class="ph ph-gauge"></i></span><span class="pc-mtext">Dashboard</span></a>
				</li>


				<li class="pc-item pc-caption">
					<label>
						<p class="text-white" style="font-size:16px">Manajemen product </p>
					</label>
					<i class="ph ph-compass-tool"></i>
				</li>
				<li class="pc-item">
					<a href="<?= base_url('admin/Dashboard/product_stock') ?>" class="pc-link">
						<span class="pc-micon"><i class="ph ph-clipboard"></i></span>
						<span class="pc-mtext">Product</span>
					</a>
				</li>


				<li class="pc-item">
					<a href="<?= base_url('admin/Dashboard/supplier') ?>" class="pc-link">
						<span class="pc-micon"><i class="ph ph-file"></i></span>
						<span class="pc-mtext">Supplier</span>
					</a>
				</li>

				<li class="pc-item">
					<a href="<?= base_url('admin/Dashboard/satuan') ?>" class="pc-link">
						<span class="pc-micon"><i class="ph ph-file"></i></span>
						<span class="pc-mtext">Satuan</span>
					</a>
				</li>


			</ul>
			<ul class="pc-navbar">

				<li class="pc-item">

				</li>


				<li class="pc-item pc-caption">
					<label>
						<p class="text-white" style="font-size:16px">Manajemen Transaksi </p>
					</label>
					<i class="ph ph-compass-tool"></i>
				</li>


				<li class="pc-item">
					<a href="<?= base_url('admin/Dashboard/stock_progress') ?>" class="pc-link">
						<span class="pc-micon"><i class="ph ph-check"></i></span>
						<span class="pc-mtext">Stock In/Out Progress</span>
					</a>
				</li>

				<li class="pc-item">
					<a href="<?= base_url('admin/Dashboard/barang_masuk') ?>" class="pc-link">
						<span class="pc-micon"><i class="ph ph-file"></i></span>
						<span class="pc-mtext">Data Stock In</span>
					</a>
				</li>

				<li class="pc-item">
					<a href="<?= base_url('admin/Dashboard/barang_keluar') ?>" class="pc-link">
						<span class="pc-micon"><i class="ph ph-file"></i></span>
						<span class="pc-mtext">Data Stock Out</span>
					</a>
				</li>

				<!-- <li class="pc-item">
					<a href="<?= base_url('admin/Dashboard/product_in_out') ?>" class="pc-link">
						<span class="pc-micon"><i class="ph ph-clipboard"></i></span>
						<span class="pc-mtext">Product In/Out/Reject</span>
					</a>
				</li> -->




				<li class="pc-item">
					<a href="<?= base_url('auth/logout') ?>" class="pc-link">
						<span class="pc-micon"><i class="ph ph-power"></i></span>
						<span class="pc-mtext">Logout</span>
					</a>
				</li>
			</ul>

		</div>
	</div>
</nav>
<!-- [ Sidebar Menu ] end -->