<div class="pc-container">
	<div class="pc-content">


		<!-- Recent Orders start -->
		<div class="col-sm-12">
			<div class="card table-card">
				<div class="card-header">
					<h3>List Supplier</h3>
				</div>
				<div class="card-body p-1">


					<!-- Button trigger modal -->
					<div class="ml-3">
						<button type="button" class="btn btn-dark mb-3 mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
							Tambah Supplier <i class="ph ph-plus"></i>
						</button>
					</div>

					<!-- Modal -->
					<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
							<div class="modal-content">
								<div class="modal-header text-white" style="background:#800000">
									<h1 class="modal-title fs-5" id="exampleModalLabel">Isi Data Supplier</h1>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>

								<div class="modal-body">
									<div class="container">
										<form method="post" action="<?= base_url('admin/dashboard/simpan_data_satuan') ?>" class="save-form">
											<div id="form-container" style="max-height: 700px; overflow-y: auto;">

												<div class="card mb-3 mt-3">
													<div class="card-body">
														<div class="modal-body" style="max-height: 400px; overflow-y: auto;">
															<div class="form-group mb-3">
																<label for="namaSupplier" class="form-label">Nama Satuan</label>
																<input type="text" required name="nama_satuan_data" class="form-control" id="nama_satuan">
															</div>



															<div class="form-group mb-3">
																<label for="contact" class="form-label">Deskripsi</label>
																<input type="text" required name="deskripsi_satuan" class="form-control" id="deskripsi">
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
						<div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
					<?php elseif ($this->session->flashdata('error')): ?>
						<div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
					<?php endif; ?>


					<div class=" table-responsive">
						<table id="list_jadwal" class="table table-striped" style="width:100%">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama Satuan</th>
									<th>Deskripsi</th>
									<th>#</th>
								</tr>
							</thead>
							<tbody>
								<?php if (!empty($satuan)) : ?>
									<?php $no = 1; ?>
									<?php foreach ($satuan as $p) : ?>
										<tr>
											<td><?= $no++; ?></td>
											<td><?= htmlspecialchars($p['nama_satuan']); ?></td>
											<td><?= htmlspecialchars($p['deskripsi']); ?></td>

											<td>

												<div class="d-flex gap-3">
													<!-- Tombol untuk memicu modal konfirmasi -->
													<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $p['id_satuan']; ?>"><i class="ph ph-trash"></i></button>
													<!-- Modal Konfirmasi Hapus -->
													<div class="modal fade" id="deleteModal<?= $p['id_satuan']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
														<div class="modal-dialog modal-dialog-centered ">
															<div class="modal-content">
																<div class="modal-header">
																	<h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus Supplier</h5>
																	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
																</div>
																<div class="modal-body">
																	Apakah Anda yakin ingin menghapus satuan <strong><?= $p['nama_satuan']; ?></strong>?
																</div>
																<div class="modal-footer">
																	<!-- Tombol Batal -->
																	<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
																	<!-- Tombol Hapus -->
																	<a href="<?= base_url('admin/dashboard/delete_satuan/' . $p['id_satuan']); ?>" class="btn btn-danger">Hapus</a>
																</div>
															</div>
														</div>
													</div>

													<!-- Edit Button -->

													<button class="btn btn-primary text-white"
														data-bs-toggle="modal"
														data-bs-target="#modalEdit"
														data-id="<?= $p['id_satuan'] ?>"
														data-satuan-name="<?= htmlspecialchars($p['nama_satuan']); ?>"
														data-deskripsi="<?= htmlspecialchars($p['deskripsi']); ?>">
														<i class="ph ph-pencil"></i>
													</button>

													<!-- Modal Edit  -->
													<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
														<div class="modal-dialog modal-dialog-scrollable">
															<div class="modal-content">
																<div class="modal-header text-white" style="background:#800000">
																	<h1 class="modal-title fs-5" id="exampleModalLabel">Edit Supplier</h1>
																	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
																</div>

																<div class="modal-body">
																	<div class="container">
																		<form method="post" action="<?= base_url('admin/dashboard/update_data_satuan') ?>" class="update-form">
																			<div id="form-container" style="max-height: 700px; overflow-y: auto;">
																				<input type="text" id="modalSatuanIdField" name="id_satuan" style="display:none">
																				<div class="card mb-3 mt-3">
																					<div class="card-body">
																						<div class="modal-body" style="max-height: 400px; overflow-y: auto;">
																							<div class="form-group mb-3">
																								<label for="namaSupplier" class="form-label">Nama Satuan</label>
																								<input type="text" required name="nama_satuan" class="form-control" id="nama_satuan">
																							</div>



																							<div class="form-group mb-3">
																								<label for="contact" class="form-label">Deskripsi</label>
																								<input type="text" required name="deskripsi" class="form-control" id="deskripsi">
																							</div>
																						</div>
																					</div>
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
													<!-- End Modal Edit  -->

													<script>
														document.addEventListener('DOMContentLoaded', function() {
															const editButtons = document.querySelectorAll('.btn[data-bs-toggle="modal"]');

															editButtons.forEach(button => {
																button.addEventListener('click', function() {
																	const id = button.getAttribute('data-id');
																	const name = button.getAttribute('data-satuan-name');
																	const deskripsi = button.getAttribute('data-deskripsi');

																	// Set values for text input fields
																	document.getElementById('modalSatuanIdField').value = id;
																	document.getElementById('nama_satuan').value = name;
																	document.getElementById('deskripsi').value = deskripsi;

																	document.getElementById('address').value = address;
																	document.getElementById('contactSupplier').value = contact;


																});
															});
														});
													</script>





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
				text: 'Kamu akan menyimpan data satuan',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Ya, simpan data satuan!',
				cancelButtonText: 'Tidak, batal simpan data satuan!',
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
					Swal.fire('Dibatalkan', 'Data  batal ditambahkan :)',
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
				text: 'Kamu akan update data satuan',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Ya, update data satuan!',
				cancelButtonText: 'Tidak, batal update data satuan!',
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
					Swal.fire('Dibatalkan', 'Data satuan batal di update :)',
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
</script>


<!-- ONCANGE CITY -->