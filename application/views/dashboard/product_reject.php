<div class="pc-container">
	<div class="pc-content">


		<!-- Recent Orders start -->
		<div class="col-sm-12">
			<div class="card table-card" style="min-height:50vh">
				<div class="card-header">
					<h3>Stock In/Out Product</h3>
				</div>
				<div class="card-body p-1 ">

					<style>
						.btn-stock {
							width: 200px;
							height: 150px;
						}

						.btn-stock i {
							font-size: 3rem;
						}
					</style>
					<div class="ml-3 d-flex justify-content-center gap-3">

						<!-- Button trigger modal stock Reject-->
						<button type="button" class="btn-stock btn bg-danger mt-5 mb-5 " data-bs-toggle="modal" data-bs-target="#exampleModal3">
							<h6 class="text-white">Reject Process</h6>
							<h2 class="text-center text-white"><i class="feather icon-x float-center"></i></h2>
						</button>
					</div>



					<!-- Modal Stock REJECT -->
					<div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
							<div class="modal-content">
								<div class="modal-header text-white" style="background:#800000">
									<h1 class="modal-title fs-5" id="exampleModalLabel">Reject Product </h1>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
									</button>
								</div>

								<div class="modal-body">
									<div class="container">

										<form method="post" action="<?= base_url('admin/dashboard/simpan_barang_keluar') ?>" class="save-form">
											<div id="form-container" style="max-height: 700px; overflow-y: auto;">
												<div class="card mb-3 mt-3">
													<div class="card-body">
														<div class="modal-body" style="max-height: 400px; overflow-y: auto;">
															<div class="input-group mb-3">
																<label class="input-group-text" for="supplier">Produk</label>
																<select class="form-select" name="product_id" id="productId">
																	<option selected>Pilih produk</option>
																	<?php if (!empty($product_dropdown)) : ?>
																		<?php foreach ($product_dropdown as $product) : ?>
																			<option value="<?= htmlspecialchars($product['id_product'], ENT_QUOTES, 'UTF-8'); ?>">
																				<?= htmlspecialchars($product['product_name'], ENT_QUOTES, 'UTF-8'); ?>
																			</option>
																		<?php endforeach; ?>
																	<?php else : ?>
																		<option value="" disabled>Tidak ada produk tersedia</option>
																	<?php endif; ?>
																</select>
															</div>

															<div class="input-group mb-3">
																<label class="input-group-text" for="supplier">Supplier</label>
																<select class="form-select" name="supplier" id="supplier">
																	<option selected>Pilih Supplier</option>
																	<?php if (!empty($supplier_dropdown)) : ?>
																		<?php foreach ($supplier_dropdown as $supplier) : ?>
																			<option value="<?= htmlspecialchars($supplier['id_supplier'], ENT_QUOTES, 'UTF-8'); ?>">
																				<?= htmlspecialchars($supplier['supplier_name'], ENT_QUOTES, 'UTF-8'); ?>
																			</option>
																		<?php endforeach; ?>
																	<?php else : ?>
																		<option value="" disabled>Tidak ada produk tersedia</option>
																	<?php endif; ?>
																</select>
															</div>

															<div class="form-group mb-3">
																<label for="contact1" class="form-label">Quantity</label>
																<input type="number" name="qty" class="form-control" id="qty" min="1">
															</div>



															<div class="form-group mb-3">
																<label for="tglTrans" class="form-label">Reject Description</label>
																<textarea class="form-control" name="description" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
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


					<?php if ($this->session->flashdata('success')): ?>

						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<?php echo $this->session->flashdata('success'); ?>
							<b>Silahkan cek menu produk untuk memastikan perubahan stok</b>
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>

					<?php endif; ?>

					<?php if ($this->session->flashdata('error')): ?>
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<?php echo $this->session->flashdata('error'); ?>
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
					<?php endif; ?>

					<div class="d-flex justify-content-center">
						<button id="toggleButton" class="btn col-3 text-white" style="background:#800000">Lihat Riwayat </button>
					</div>


					<!-- TABLE RIWAYAT STOCK IN / OUT -->
					<div id="cardTable" style="display:none">
						<div class=" table-responsive">
							<table id="list_jadwal" class="table table-striped table-sm" style="width:100%">
								<thead>
									<tr>
										<th>No</th>
										<th>Kode Transaksi</th>
										<th>Nama Produk</th>
										<th>QTY </th>
										<th>Supplier</th>
										<th>Tipe Transaksi</th>
										<th>Tanggal Transaksi</th>

										<th>#</th>
									</tr>
								</thead>
								<tbody>
									<?php if (!empty($barang_masuk)) : ?>
										<?php $no = 1; ?>
										<?php foreach ($barang_masuk as $bm) : ?>
											<tr>
												<td><?= $no++; ?></td>
												<td><?= htmlspecialchars($bm['transaction_code']); ?></td>
												<td><?= htmlspecialchars($bm['product_name']); ?></td>
												<td><?= htmlspecialchars($bm['quantity']); ?></td>
												<td><?= htmlspecialchars($bm['supplier_name']); ?></td>
												<td>

													<?php if ($bm['transaction_type'] == 'in') { ?>
														<span class="badge text-md rounded-pill text-bg-success"><?= htmlspecialchars($bm['transaction_type']); ?></span>
													<?php } else { ?>
														<span class="badge text-md rounded-pill text-bg-danger"><?= htmlspecialchars($bm['transaction_type']); ?></span>
													<?php } ?>
												</td>
												<td><?= htmlspecialchars($bm['transaction_date']); ?></td>


												<td>

													<div class="d-flex gap-3">
														<form method="post" action="<?= base_url('admin/dashboard/hapus_data_band') ?>" class="delete-form">
															<input type="hidden" name="band_ids[]" value="<?= $bm['id_transaction'] ?>" />
															<button type="button" id="delete_button" class="btn btn-danger text-white"><i class="ph ph-trash"></i></button>
														</form>

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
				text: 'Kamu akan menyimpan data band',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Ya, simpan data band!',
				cancelButtonText: 'Tidak, batal simpan data band!',
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
					Swal.fire('Dibatalkan', 'Data band batal ditambahkan :)',
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
				text: 'Kamu akan update data band',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Ya, update data band!',
				cancelButtonText: 'Tidak, batal update data band!',
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
					Swal.fire('Dibatalkan', 'Data band batal di update :)',
						'error'); // Cancel the deletion
				}
			});
		});
	});
	// END SAVE ALERT //


	document.addEventListener('DOMContentLoaded', function() {
		// Attach event listener to all "Edit" buttons
		document.querySelectorAll('[data-bs-toggle="modal"]').forEach(button => {
			button.addEventListener('click', function() {
				const bandId = this.getAttribute('data-band-id'); // Get the band ID from the button
				console.log('Band ID:', bandId); // For debugging

				// Now you can use the bandId to fetch more details about the band or populate modal fields
				// Example: Set the value of a hidden field inside the modal
				document.getElementById('modalBandIdField').value = bandId;

				// Optionally, make an AJAX request to get more details about the band based on the ID
			});
		});
	});




	const qtyInput = document.getElementById("qty");

	qtyInput.addEventListener("input", function() {
		const qtyValue = qtyInput.value;

		// Check if the input is a number and not equal to 0
		if (qtyValue === "0" || qtyValue == "-" || qtyValue == "+") {
			alert("Quantity must be valid number.");
			qtyInput.value = ""; // Clear the input
		} else if (isNaN(qtyValue)) {
			alert("Please enter a valid number.");
			qtyInput.value = ""; // Clear the input
		}
	});
</script>




<script>
	// JavaScript to populate the modal dynamically
	document.addEventListener('DOMContentLoaded', function() {
		var editButtons = document.querySelectorAll('[data-bs-target="#modalEditBand"]');

		editButtons.forEach(function(button) {
			button.addEventListener('click', function() {
				var bandId = button.getAttribute('data-id');
				var bandName = button.getAttribute('data-name');
				var bandGenre = button.getAttribute('data-genre');
				var bandContact = button.getAttribute('data-contact');

				// Populate the modal fields with the clicked band's data
				document.getElementById('modalBandIdField').value = bandId;
				document.getElementById('namaBand').value = bandName;
				document.getElementById('genre-option').value = bandGenre;
				document.getElementById('contact').value = bandContact;
			});
		});
	});
</script>