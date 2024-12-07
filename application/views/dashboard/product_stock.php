<head>
	<!-- Add SweetAlert CDN -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>


<div class="pc-container">
	<div class="pc-content">


		<!-- Recent Orders start -->
		<div class="col-sm-12">
			<div class="card table-card">
				<div class="card-header">
					<h3>List Product</h3>
				</div>
				<div class="card-body p-1">


					<!-- Button trigger modal -->
					<div class="ml-3">
						<button type="button" class="btn btn-dark mb-3 mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
							Tambah Produk <i class="ph ph-plus"></i>
						</button>
					</div>

					<!-- Modal -->
					<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
							<div class="modal-content">
								<div class="modal-header text-white" style="background:#800000">
									<h1 class="modal-title fs-5" id="exampleModalLabel">Isi Data List Product</h1>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>

								<div class="modal-body">
									<div class="container">
										<form method="post" action="<?= base_url('admin/dashboard/simpan_data_product') ?>" class="save-form">
											<div id="form-container" style="max-height: 700px; overflow-y: auto;">
												<div class="card mb-3 mt-3">
													<div class="card-body">
														<div class="modal-body" style="max-height: 400px; overflow-y: auto;">
															<div class="form-group mb-3">
																<label for="namaProduk" class="form-label">Nama produk</label>
																<input type="text" name="nama_produk" class="form-control" id="namaProduk">
															</div>

															<div class="input-group mb-3">
																<label class="input-group-text" for="supplier">Kategori</label>
																<select class="form-select" name="kategori" id="kategori">
																	<option selected>Kategori</option>
																	<?php foreach ($category_dropdown as $c) : ?>
																		<option value="<?= $c['id_category'] ?>"><?= $c['category_name'] ?></option>
																	<?php endforeach ?>
																</select>
															</div>


															<div class="form-group mb-3">
																<label for="stock" class="form-label">Stok</label>
																<input type="number" name="stock" min="1" class="form-control" id="stock">
															</div>
															<div class="input-group mb-3">
																<label class="input-group-text" for="supplier">Supplier</label>
																<select class="form-select" name="supplier" id="supplier">
																	<option selected>Pilih Supplier</option>
																	<?php foreach ($supplier_dropdown as $s) : ?>
																		<option value="<?= $s['id_supplier'] ?>"><?= $s['supplier_name'] ?></option>
																	<?php endforeach ?>
																</select>
															</div>


															<div class="input-group mb-3">
																<label class="input-group-text" for="satuan">Jenis Satuan</label>
																<select class="form-select" name="satuan" id="satuan">
																	<option selected>Jenis Satuan</option>
																	<?php foreach ($satuan_dropdown as $st) : ?>
																		<option value="<?= $st['id_satuan'] ?>"><?= $st['nama_satuan'] ?></option>
																	<?php endforeach ?>
																</select>
															</div>

															<div class="input-group mb-3">
																<label for="harga" class="input-group-text">Harga Satuan</label>
																<input type="text" name="harga" class="form-control" id="harga" oninput="formatRupiah(this)">
															</div>



														</div>
													</div>
												</div>
											</div>

											<div class="modal-footer">
												<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
												<button type="submit" class="btn btn-dark">Simpan</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- end Modal -->

					<?php if ($this->session->flashdata('stockIn')): ?>
						<script>
							Swal.fire({
								icon: 'success',
								title: 'Success',
								text: '<?php echo $this->session->flashdata('success'); ?>',
								footer: '<b>Silahkan kunjungi menu <span style="color:red">stock progress</span> untuk konfirmasi aksi</b>'
							});
						</script>
					<?php endif; ?>

					<?php if ($this->session->flashdata('error')): ?>
						<script>
							Swal.fire({
								icon: 'error',
								title: 'Error',
								text: '<?php echo $this->session->flashdata('error'); ?>'
							});
						</script>
					<?php endif; ?>

					<?php if ($this->session->flashdata('stockOut')): ?>
						<script>
							Swal.fire({
								icon: 'warning',
								title: 'Stock Out',
								text: '<?php echo $this->session->flashdata('stockOut'); ?>',
								footer: '<b>Silahkan kunjungi menu <span style="color:red">Stock In/Out Progress</span> untuk konfirmasi aksi</b>'
							});
						</script>
					<?php endif; ?>




					<div class=" table-responsive">
						<table id="list_jadwal" class="table table-striped" style="width:100%">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama Produk</th>
									<th>Kategori </th>
									<th>Stok</th>
									<th>Jenis Satuan</th>
									<th>Harga Satuan</th>
									<th>Supplier</th>
									<th>Date</th>
									<th>#</th>
								</tr>
							</thead>
							<tbody>
								<?php if (!empty($product_all)) : ?>
									<?php $no = 1; ?>
									<?php foreach ($product_all as $p) : ?>
										<tr>
											<td><?= $no++; ?></td>
											<td><?= htmlspecialchars($p['product_name']); ?></td>
											<td><?= htmlspecialchars($p['category_name']); ?></td>
											<td><?= htmlspecialchars($p['stock']); ?></td>
											<td><?= htmlspecialchars($p['nama_satuan']); ?></td>
											<td>Rp <?= number_format($p['unit_price'], 0, ',', '.'); ?></td>
											<td><?= htmlspecialchars($p['supplier_name']); ?></td>
											<td><?= htmlspecialchars($p['created_at']); ?></td>
											<td>

												<div class="d-flex gap-1">
													<!-- Tombol untuk memicu modal konfirmasi -->
													<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $p['id_product']; ?>"><i class="ph ph-trash"></i></button>
													<!-- Modal Konfirmasi Hapus -->
													<div class="modal fade" id="deleteModal<?= $p['id_product']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
														<div class="modal-dialog modal-dialog-centered ">
															<div class="modal-content">
																<div class="modal-header">
																	<h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus Product</h5>
																	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
																</div>
																<div class="modal-body">
																	Apakah Anda yakin ingin menghapus supplier <strong><?= $p['product_name']; ?></strong>?
																</div>
																<div class="modal-footer">
																	<!-- Tombol Batal -->
																	<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
																	<!-- Tombol Hapus -->
																	<a href="<?= base_url('admin/dashboard/delete_product/' . $p['id_product']); ?>" class="btn btn-danger">Hapus</a>
																</div>
															</div>
														</div>
													</div>

													<!-- EDIT BUTTON -->

													<!-- Edit Button -->

													<button class="btn btn-primary text-white"
														data-bs-toggle="modal"
														data-bs-target="#modalEdit"
														data-id2="<?= $p['id_product'] ?>"
														data-product2="<?= $p['product_name'] ?>"
														data-supplier2="<?= $p['supplier_name'] ?>"
														data-category2="<?= $p['category_name'] ?>"
														data-satuan2="<?= $p['nama_satuan'] ?>"
														data-price2="<?= $p['unit_price'] ?>">
														<i class="ph ph-pencil"></i>
													</button>

													<!-- Modal Edit -->
													<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
														<div class="modal-dialog modal-dialog-scrollable">
															<div class="modal-content">
																<div class="modal-header text-white" style="background:#800000">
																	<h1 class="modal-title fs-5" id="exampleModalLabel">Edit Supplier</h1>
																	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
																</div>

																<div class="modal-body">
																	<div class="container">
																		<form method="post" action="<?= base_url('admin/dashboard/update_data_product	') ?>" class="update-form">
																			<div id="form-container" style="max-height: 700px; overflow-y: auto;">
																				<input type="hidden" id="modalproductIdField2" name="id_product">

																				<!-- Product Name -->
																				<div class="form-group mb-3">
																					<label for="productNameEdit" class="form-label">Nama Produk</label>
																					<input type="text" required name="product_name_edit" class="form-control" id="productNameEdit">
																				</div>

																				<!-- Category -->
																				<div class="input-group mb-3">
																					<label class="input-group-text" for="kategori">Kategori</label>
																					<select class="form-select" name="kategori_edit" id="kategoriEdit" required>
																						<option selected disabled>Pilih Kategori</option>
																						<?php foreach ($category_dropdown as $c) : ?>
																							<option value="<?= $c['id_category'] ?>"><?= $c['category_name'] ?></option>
																						<?php endforeach ?>
																					</select>
																				</div>

																				<!-- Supplier -->
																				<div class="input-group mb-3">
																					<label class="input-group-text" for="supplier">Supplier</label>
																					<select class="form-select" name="supplier_edit" id="supplierEdit" required>
																						<option selected disabled>Pilih Supplier</option>
																						<?php foreach ($supplier_dropdown as $s) : ?>
																							<option value="<?= $s['id_supplier'] ?>"><?= $s['supplier_name'] ?></option>
																						<?php endforeach ?>
																					</select>
																				</div>

																				<!-- Satuan -->
																				<div class="input-group mb-3">
																					<label class="input-group-text" for="satuan">Jenis Satuan</label>
																					<select class="form-select" name="satuan_edit" id="satuanEdit" required>
																						<option selected disabled>Jenis Satuan</option>
																						<?php foreach ($satuan_dropdown as $st) : ?>
																							<option value="<?= $st['id_satuan'] ?>"><?= $st['nama_satuan'] ?></option>
																						<?php endforeach ?>
																					</select>
																				</div>

																				<!-- Price -->
																				<div class="input-group mb-3">
																					<label for="hargaEdit" class="input-group-text">Harga Satuan</label>
																					<input type="text" name="harga_edit" class="form-control" id="hargaEdit" oninput="formatRupiah(this)">
																				</div>
																			</div>

																			<div class="modal-footer">
																				<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
																				<button type="submit" class="btn btn-dark">Update</button>
																			</div>
																		</form>
																	</div>
																</div>
															</div>
														</div>
													</div>


													<script>
														document.addEventListener('DOMContentLoaded', function() {
															const editButtons = document.querySelectorAll('[data-bs-target="#modalEdit"]');

															editButtons.forEach(button => {
																button.addEventListener('click', function() {
																	// Retrieve data attributes from the clicked button
																	const id = button.getAttribute('data-id2');
																	const productName = button.getAttribute('data-product2');
																	const supplier = button.getAttribute('data-supplier2');
																	const category = button.getAttribute('data-category2');
																	const satuan = button.getAttribute('data-satuan2');
																	const price = button.getAttribute('data-price2');

																	// Populate the modal form fields with retrieved values
																	document.getElementById('modalproductIdField2').value = id;
																	document.getElementById('productNameEdit').value = productName;
																	document.getElementById('supplierEdit').value = supplier;
																	document.getElementById('kategoriEdit').value = category;
																	document.getElementById('satuanEdit').value = satuan;
																	document.getElementById('hargaEdit').value = price;
																});
															});
														});

														// Optional: Format Rupiah function
														function formatRupiah(input) {
															let value = input.value.replace(/[^,\d]/g, '').toString();
															let split = value.split(',');
															let formatted = split[0].replace(/\B(?=(\d{3})+(?!\d))/g, '.');
															input.value = split[1] ? formatted + ',' + split[1] : formatted;
														}
													</script>
													<!-- End Modal Edit  -->



													<!-- STOCK IN PROCESS  -->
													<button class="btn  btn-success" data-bs-toggle="modal"
														data-bs-target="#modalInStock"
														data-id-product="<?= $p['id_product'] ?>"
														data-product-name="<?= $p['product_name'] ?>"
														data-id-supplier="<?= htmlspecialchars($p['supplier_id']); ?>">

														In

													</button>

													<!-- Modal In Stock -->
													<div class="modal fade" id="modalInStock" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
														<div class="modal-dialog modal-dialog-centered">
															<div class="modal-content">
																<div class="modal-header text-white" style="background:#800000">
																	<h1 class="modal-title fs-5" id="exampleModalLabel">Proses Produk Masuk</h1>
																	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
																</div>

																<div class="modal-body">
																	<div class="container">
																		<form method="post" action="<?= base_url('admin/dashboard/simpan_barang_masuk') ?>" class="save-form">
																			<div id="form-container" style="max-height: 700px; overflow-y: auto;">

																				<input type="hidden" readonly id="idProduct" name="id_product">
																				<input type="hidden" readonly id="idSupplier" name="id_supplier">

																				<div class="card mb-3 mt-3">
																					<div class="card-body">
																						<div class="modal-body" style="max-height: 400px; overflow-y: auto;">


																							<div class="form-group mb-3">
																								<label for="id" class="form-label">Stok akan bertambah pada produk ini</label>
																								<input type="text" readonly id="productName" min="1" name="" class="form-control" id="qty">
																							</div>

																							<div class="form-group mb-3">
																								<label for="id" class="form-label">Quantity</label>
																								<input type="number" min="1" name="qty" class="form-control" id="qty">
																							</div>


																						</div>
																					</div>
																				</div>
																			</div>

																			<div class="modal-footer">
																				<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
																				<button type="submit" class="btn btn-dark">Proses</button>
																			</div>
																		</form>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<!-- end modal stock in -->

													<script>
														// JavaScript to populate the modal dynamically
														document.addEventListener('DOMContentLoaded', function() {
															var stockInButtons = document.querySelectorAll('[data-bs-target="#modalInStock"]');

															stockInButtons.forEach(function(button) {
																button.addEventListener('click', function() {
																	var idProduk = button.getAttribute('data-id-product');
																	var idSupplier = button.getAttribute('data-id-supplier');
																	var productName = button.getAttribute('data-product-name');


																	// Populate the modal fields with the clicked band's data
																	document.getElementById('idProduct').value = idProduk;
																	document.getElementById('idSupplier').value = idSupplier;
																	document.getElementById('productName').value = productName;
																});
															});
														});
													</script>
													<!-- END STOCK IN PROCESS  -->




													<!-- STOCK OUT PROSES -->
													<button class="btn btn-danger" data-bs-toggle="modal"
														data-bs-target="#modalOutStock"
														data-id-product2="<?= $p['id_product'] ?>"
														data-product-name2="<?= $p['product_name'] ?>"
														data-id-supplier2="<?= htmlspecialchars($p['supplier_id']); ?>"
														data-stock="<?= $p['stock'] ?>">
														Out
													</button>

													<!-- Modal Out Stock -->
													<div class="modal fade" id="modalOutStock" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
														<div class="modal-dialog modal-dialog-centered">
															<div class="modal-content">
																<div class="modal-header text-white" style="background:#800000">
																	<h1 class="modal-title fs-5" id="exampleModalLabel">Proses Produk Keluar</h1>
																	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
																</div>
																<div class="modal-body">
																	<form method="post" action="<?= base_url('admin/dashboard/simpan_barang_keluar') ?>" class="save-form">
																		<input type="hidden" readonly id="idProduct2" name="id_product2">
																		<input type="hidden" readonly id="idSupplier2" name="id_supplier2">

																		<!-- Product Name -->
																		<div class="form-group mb-3">
																			<label for="productName2" class="form-label">Stok akan berkurang pada produk ini</label>
																			<input type="text" readonly id="productName2" name="product_name2" class="form-control">
																		</div>

																		<!-- Quantity Input -->
																		<div class="form-group mb-3">
																			<label for="qty" class="form-label">Quantity</label>
																			<input type="number" id="qty2" name="qty2" class="form-control" min="1">
																		</div>

																		<!-- Stock Info -->
																		<p id="stock-info">Stock tersisa: </p>

																		<!-- Modal Footer -->
																		<div class="modal-footer">
																			<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
																			<button type="submit" class="btn btn-dark">Proses</button>
																		</div>
																	</form>
																</div>
															</div>
														</div>
													</div>

													<!-- JavaScript -->
													<script>
														document.addEventListener('DOMContentLoaded', function() {
															const stockOutButtons = document.querySelectorAll('[data-bs-target="#modalOutStock"]');
															const modalQty = document.getElementById('qty2');
															const modalStockInfo = document.getElementById('stock-info');

															// Set modal values when a button is clicked
															stockOutButtons.forEach(function(button) {
																button.addEventListener('click', function() {
																	const idProduct = button.getAttribute('data-id-product2');
																	const idSupplier = button.getAttribute('data-id-supplier2');
																	const productName = button.getAttribute('data-product-name2');
																	const stock = button.getAttribute('data-stock');

																	// Populate modal fields
																	document.getElementById('idProduct2').value = idProduct;
																	document.getElementById('idSupplier2').value = idSupplier;
																	document.getElementById('productName2').value = productName;

																	// Display stock info
																	modalStockInfo.textContent = `Stock tersisa: ${stock}`;
																	modalQty.setAttribute('data-stock', stock); // Attach stock value to input
																	modalQty.value = 1; // Reset quantity input to 1
																});


															});

															modalQty.addEventListener("input", function() {
																const maxStock = parseInt(modalQty.getAttribute("data-stock"), 10);
																const qtyValue = parseInt(modalQty.value, 10);

																// Debugging logs
																console.log("Max Stock:", maxStock, "Quantity Value:", qtyValue);

																if (qtyValue > maxStock) {
																	alert("Tidak boleh melebihi jumlah stock product!");
																	modalQty.value = ''; // Reset to max stock
																} else if (qtyValue == 0) {
																	alert("Minimal 1!");
																	modalQty.value = ''; // Reset to minimum
																}
															});

														});
													</script>

													<!-- END STOCK OUT PROSES -->
												</div>

											</td>
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

</div>


<script>
	// DELETE ALERT
	document.querySelectorAll('.delete-form').forEach(form => {
		form.querySelector('#delete_button').addEventListener('click', function() {
			Swal.fire({
				title: 'Apakah anda yakin?',
				text: 'Kamu akan menghapus data',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Ya, hapus data!',
				cancelButtonText: 'Tidak, batal hapus!',
				reverseButtons: true
			}).then((result) => {
				if (result.isConfirmed) {
					// Submit the form if confirmed
					form.submit();

					// Success alert can be added after form submission using session flash messages
					Swal.fire(
						'Dihapus!',
						'Data Anda telah berhasil dihapus.',
						'success'
					);
				} else {
					Swal.fire('Dibatalkan', 'Data anda tetap aman :)', 'error'); // Cancel the deletion
				}
			});
		});
	});


	// SAVE ALERT //
	document.querySelectorAll('.save-form').forEach(form => {
		form.addEventListener('submit', function(e) {
			e.preventDefault();
			Swal.fire({
				title: 'Apakah anda yakin?',
				text: 'Kamu akan menyimpan data',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Ya, simpan data !',
				cancelButtonText: 'Tidak, batal simpan data !',
				reverseButtons: true
			}).then((result) => {
				if (result.isConfirmed) {
					// Submit the form if confirmed
					form.submit();
					Swal.fire(
						'Disimpan!',
						'Data Anda telah berhasil disimpan.',
						'success'
					);
				} else {
					Swal.fire('Dibatalkan', 'Data batal ditambahkan :)',
						'error'); // Cancel the deletion
				}
			});
		});
	});
	// END SAVE ALERT //


	// UPDATE ALERT //
	document.querySelectorAll('.update-form').forEach(form => {
		form.addEventListener('submit', function(e) {
			e.preventDefault();
			Swal.fire({
				title: 'Apakah anda yakin?',
				text: 'Kamu akan update data',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Ya, update data!',
				cancelButtonText: 'Tidak, batal update data!',
				reverseButtons: true
			}).then((result) => {
				if (result.isConfirmed) {
					// Submit the form if confirmed
					form.submit();
					Swal.fire(
						'Updated!',
						'Data Anda telah berhasil di update.',
						'success'
					);
				} else {
					Swal.fire('Dibatalkan', 'Data batal di update :)',
						'error'); // Cancel the deletion
				}
			});
		});
	});
	// END SAVE ALERT //
</script>


<script>
	function formatRupiah(input) {
		// Remove non-numeric characters
		let value = input.value.replace(/[^,\d]/g, '').toString();

		// Split the value into integer and decimal parts
		let [integer, decimal] = value.split(',');

		// Format the integer part with commas
		integer = integer.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

		// Reassemble the value
		input.value = decimal ? `${integer},${decimal}` : integer;
	}
</script>