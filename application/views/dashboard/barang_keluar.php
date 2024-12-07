<div class="pc-container">
	<div class="pc-content">


		<!-- Recent Orders start -->
		<div class="col-sm-12">
			<div class="card table-card">
				<div class="card-header">
					<h3>List Stock Out</h3>
				</div>
				<div class="card-body p-1">
					<div class="text-right mb-3">
						<a href="<?php echo site_url('admin/dashboard/export_to_pdf_stock_out'); ?>" class="btn btn-primary">Cetak</a>
					</div>
					<div class=" table-responsive">
						<table id="list_jadwal" class="table table-striped" style="width:100%">
							<thead>
								<tr>
									<th>No</th>
									<th>Kode Transaksi</th>
									<th>Nama Produk</th>
									<th>Tipe Transaksi</th>
									<th>QTY </th>
									<th>Supplier</th>
									<th>Status</th>
									<th>Tanggal Transaksi</th>


								</tr>
							</thead>
							<tbody>
								<?php if (!empty($barang_keluar)) : ?>
									<?php $no = 1; ?>
									<?php foreach ($barang_keluar as $bm) : ?>
										<tr>
											<td><?= $no++; ?></td>
											<td><?= htmlspecialchars($bm['transaction_code']); ?></td>
											<td><?= htmlspecialchars($bm['product_name']); ?></td>
											<td><?= htmlspecialchars($bm['transaction_type']); ?></td>
											<td><?= htmlspecialchars($bm['quantity']); ?></td>
											<td><?= htmlspecialchars($bm['supplier_name']); ?></td>
											<td><?= htmlspecialchars($bm['status']); ?></td>
											<td><?= htmlspecialchars($bm['created_at']); ?></td>



										</tr>
									<?php endforeach; ?>
								<?php else : ?>
									<tr>
										<td colspan="5" class="text-center">Tidak ada data yang tersedia.</td>
									</tr>
								<?php endif; ?>
							</tbody>


						</table>

					</div>
				</div>
			</div>
		</div>

	</div>

</div>