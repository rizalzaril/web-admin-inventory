<div class="pc-container">
	<div class="pc-content">


		<!-- Recent Orders start -->
		<div class="col-sm-12">
			<div class="card table-card">
				<div class="card-header">
					<h3>List Band</h3>
				</div>
				<div class="card-body p-1">


					<!-- Button trigger modal -->
					<div class="ml-3">
						<button type="button" class="btn btn-dark mb-3 mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
							Tambah Band <i class="ph ph-plus"></i>
						</button>
					</div>

					<!-- Modal -->
					<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
							<div class="modal-content">
								<div class="modal-header text-white" style="background:#800000">
									<h1 class="modal-title fs-5" id="exampleModalLabel">Isi Data List Band</h1>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>

								<div class="modal-body">
									<div class="container">
										<form method="post" action="<?= base_url('admin/dashboard/simpan_data_band') ?>" class="save-form">
											<div id="form-container" style="max-height: 700px; overflow-y: auto;">
												<div class="card mb-3 mt-3">
													<div class="card-body">
														<div class="modal-body" style="max-height: 400px; overflow-y: auto;">
															<div class="form-group mb-3">
																<label for="namaBand1" class="form-label">Nama Band</label>
																<input type="text" name="nama_band[]" class="form-control" id="namaBand1">
															</div>

															<div class="input-group mb-3">
																<label class="input-group-text" for="genre1">Genre</label>
																<select class="form-select" name="genre[]" id="genre1">
																	<option selected>Choose...</option>
																</select>
															</div>

															<div class="form-group mb-3">
																<label for="contact1" class="form-label">No Telepon</label>
																<input type="number" name="contact[]" class="form-control" id="contact1">
															</div>
														</div>
													</div>
												</div>
											</div>
											<button type="button" class="btn btn-success mb-3" id="add-button">+</button>
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



					<div class=" table-responsive">
						<table id="list_jadwal" class="table table-striped" style="width:100%">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama Band</th>
									<th>Genre </th>
									<th>Kontak</th>
									<th>#</th>
								</tr>
							</thead>
							<tbody>
								<?php if (!empty($list_band)) : ?>
									<?php $no = 1; ?>
									<?php foreach ($list_band as $band) : ?>
										<tr>
											<td><?= $no++; ?></td>
											<td><?= htmlspecialchars($band['nama_band']); ?></td>
											<td><?= htmlspecialchars($band['genre']); ?></td>
											<td><?= htmlspecialchars($band['contact_band']); ?></td>
											<td>

												<div class="d-flex gap-3">
													<form method="post" action="<?= base_url('admin/dashboard/hapus_data_band') ?>" class="delete-form">
														<input type="hidden" name="band_ids[]" value="<?= $band['id_band'] ?>" />
														<button type="button" id="delete_button" class="btn btn-danger text-white"><i class="ph ph-trash"></i></button>
													</form>

													<!-- Edit Button -->
													<!-- <input type="text" name="band_ids[]" value="<?= $band['id_band'] ?>" /> -->
													<button class="btn btn-primary text-white"
														data-bs-toggle="modal"
														data-bs-target="#modalEditBand"
														data-id="<?= $band['id_band'] ?>"
														data-name="<?= htmlspecialchars($band['nama_band']); ?>"
														data-genre="<?= htmlspecialchars($band['genre']); ?>"
														data-contact="<?= htmlspecialchars($band['contact_band']); ?>">
														<i class=" ph ph-pencil"></i>
													</button>

													<!-- Modal Edit Band -->
													<div class="modal fade" id="modalEditBand" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
														<div class="modal-dialog modal-dialog-scrollable">
															<div class="modal-content">
																<div class="modal-header text-white" style="background:#800000">
																	<h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data List Band</h1>
																	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
																</div>

																<div class="modal-body">
																	<div class="container">
																		<form method="post" action="<?= base_url('admin/dashboard/update_data_band') ?>" class="update-form">
																			<div id="form-container" style="max-height: 700px; overflow-y: auto;">
																				<input type="hidden" id="modalBandIdField" name="id_band">
																				<div class="card mb-3 mt-3">
																					<div class="card-body">
																						<div class="modal-body" style="max-height: 400px; overflow-y: auto;">
																							<div class="form-group mb-3">
																								<label for="namaBand" class="form-label">Nama Band</label>
																								<input type="text" name="nama_band" class="form-control" id="namaBand">
																							</div>

																							<div class="input-group mb-3">
																								<label class="input-group-text" for="genre">Genre</label>
																								<select class="form-select" name="genre" id="genre-option">
																									<!-- Genre options will be populated dynamically -->
																								</select>
																							</div>

																							<div class="form-group mb-3">
																								<label for="contact" class="form-label">No Telepon</label>
																								<input type="number" name="contact" class="form-control" id="contact">
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
													<!-- End Modal Edit Band -->

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




												</div>
											</td>
										</tr>
									<?php endforeach; ?>
								<?php else : ?>
									<tr>
										<td colspan="5" class="text-center">Tidak ada data band tersedia.</td>
									</tr>
								<?php endif; ?>
							</tbody>

							<tfoot>
								<tr>
									<th>No</th>
									<th>Nama Band</th>
									<th>Genre</th>
									<th>Kontak</th>
									<th>#</th>
								</tr>
							</tfoot>
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





	// Array of popular music genres
	// Array of popular music genres
	const musicGenresEdit = [
		"Pop",
		"Rock",
		"Hip Hop",
		"Jazz",
		"Classical",
		"Country",
		"Electronic",
		"Reggae",
		"Blues",
		"R&B",
		"Soul",
		"Funk",
		"Metal",
		"Folk",
		"Disco",
		"Grunge",
		"Punk",
		"Techno",
		"House",
		"Gospel",
		"Indie",
		"Opera",
		"Latin",
		"K-Pop",
		"J-Pop",
		"Dance",
		"Trap",
		"Dubstep",
		"Ambient",
	];

	// Get the select element
	const musicGenreSelect = document.getElementById("genre-option");

	// Populate the select dropdown
	musicGenresEdit.forEach((genre) => {
		const option = document.createElement("option");
		option.value = genre.toLowerCase(); // Set the value in lowercase
		option.textContent = genre; // Set the visible text
		musicGenreSelect.appendChild(option);
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