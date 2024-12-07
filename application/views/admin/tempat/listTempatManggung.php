<div class="pc-container">
	<div class="pc-content">


		<!-- Recent Orders start -->
		<div class="col-sm-12">
			<div class="card table-card">
				<div class="card-header">
					<h3>List Tempat Manggung</h3>
				</div>
				<div class="card-body p-1">


					<!-- Button trigger modal -->
					<div class="ml-3">
						<button type="button" class="btn btn-dark mb-3 mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
							Tambah data <i class="ph ph-plus"></i>
						</button>
					</div>

					<!-- Modal -->
					<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog  modal-dialog-scrollable">
							<div class="modal-content">
								<div class="modal-header text-white" style="background:#800000">
									<h1 class="modal-title fs-5" id="exampleModalLabel">Isi Data List Tempat Manggung</h1>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>

								<div class="modal-body">
									<div class="container">
										<form method="post" action="<?= base_url('admin/dashboard/simpan_data_panggung') ?>" class="save-form">
											<div id="form-container" style="max-height: 800px; overflow-y: auto;">
												<div class="card mb-3 mt-3">
													<div class="card-body">
														<div class="modal-body" style="max-height: 400px; overflow-y: auto;">
															<div class="form-group mb-3">
																<label for="namaBand1" class="form-label">Nama Tempat Manggung</label>
																<input type="text" required name="nama_tempat[]" class="form-control" id="namaBand1">
															</div>

															<div class="form-group mb-3">
																<label for="province1" class="form-label">Provinsi</label>
																<select class="form-control province" required name="provinsi[]" id="province1" onchange="loadCities()">
																	<option value="">Provinsi</option>
																	<!-- Province options will be loaded dynamically -->
																</select>
															</div>

															<div class="form-group mb-3">
																<label for="city1" class="form-label">Kota</label>
																<select id="city1" name="kota[]" required class="city form-control">
																	<option value="">Kota</option>
																	<!-- City options will be loaded dynamically -->
																</select>
															</div>

															<div class="form-group mb-3">
																<label for="alamat1" class="form-label">Alamat</label>
																<input type="text" name="alamat[]" required class="form-control" id="alamat1">
															</div>

															<div class="form-group mb-3">
																<label for="contact1" class="form-label">No Telepon</label>
																<input type="number" name="contact[]" required class="form-control" id="contact1">
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

										<script>
											document.getElementById('add-button').addEventListener('click', function() {
												var formContainer = document.getElementById('form-container');
												var newFormGroup = formContainer.querySelector('.card').cloneNode(true);
												formContainer.appendChild(newFormGroup);
											});
										</script>

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
									<th>Nama Tempat</th>
									<th>Provinsi</th>
									<th>Kota</th>
									<th>Alamat</th>
									<th>Kontak</th>
									<th>#</th>
								</tr>
							</thead>
							<tbody>
								<?php if (!empty($list_tempat_manggung)) : ?>
									<?php $no = 1; ?>
									<?php foreach ($list_tempat_manggung as $data) : ?>
										<tr>
											<td><?= $no++; ?></td>
											<td><?= htmlspecialchars($data['nama_tempat_manggung']); ?></td>
											<td><?= htmlspecialchars($data['provinsi_name']); ?></td>
											<td><?= htmlspecialchars($data['kota_name']); ?></td>
											<td><?= htmlspecialchars($data['alamat']); ?></td>
											<td><?= htmlspecialchars($data['contact']); ?></td>
											<td>

												<div class="d-flex gap-3">
													<form method="post" action="<?= base_url('admin/dashboard/hapus_data_tempat_manggung') ?>" class="delete-form">
														<input type="hidden" name="tempat_id[]" value="<?= $data['id_tempat_manggung'] ?>" />
														<button type="button" id="delete_button" class="btn btn-danger text-white"><i class="ph ph-trash"></i></button>
													</form>

													<!-- Edit Button -->
													<button class="btn btn-primary text-white"
														data-bs-toggle="modal"
														data-bs-target="#modalEditBand"
														data-id="<?= $data['id_tempat_manggung'] ?>"
														data-name="<?= htmlspecialchars($data['nama_tempat_manggung']); ?>"
														data-province="<?= htmlspecialchars($data['provinsi_name']); ?>"
														data-city="<?= htmlspecialchars($data['kota_name']); ?>"
														data-alamat="<?= htmlspecialchars($data['alamat']); ?>"
														data-contact="<?= htmlspecialchars($data['contact']); ?>">
														<i class="ph ph-pencil"></i>
													</button>

													<!-- Modal Edit Band -->
													<div class="modal fade" id="modalEditBand" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
														<div class="modal-dialog modal-dialog-scrollable">
															<div class="modal-content">
																<div class="modal-header text-white" style="background:#800000">
																	<h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Tempat Manggung</h1>
																	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
																</div>

																<div class="modal-body">
																	<div class="container">
																		<form method="post" action="<?= base_url('admin/dashboard/update_data_manggung') ?>" class="update-form">
																			<div id="form-container" style="max-height: 700px; overflow-y: auto;">
																				<input type="hidden" id="modalTempatIdField" name="id_tempat">
																				<div class="card mb-3 mt-3">
																					<div class="card-body">
																						<div class="modal-body" style="max-height: 400px; overflow-y: auto;">
																							<div class="form-group mb-3">
																								<label for="namaTempat" class="form-label">Nama Tempat</label>
																								<input type="text" required name="nama_tempat_edit" class="form-control" id="namaTempat">
																							</div>

																							<div class="input-group mb-3">
																								<label class="input-group-text" for="provinsi">Provinsi</label>
																								<select class="form-select province" required name="provinsi_edit" id="province2">
																									<option value="<?= htmlspecialchars($data['provinsi_name']) ?>"><?= htmlspecialchars($data['provinsi_name']) ?></option>
																								</select>
																							</div>

																							<div class="input-group mb-3">
																								<label class="input-group-text" for="kota">Kota</label>
																								<select class="form-select city" required name="kota_edit" id="city2">
																									<option value="<?= htmlspecialchars($data['kota_name']) ?>"><?= htmlspecialchars($data['kota_name']) ?></option>
																								</select>
																							</div>

																							<div class="form-group mb-3">
																								<label for="alamat" class="form-label">Alamat</label>
																								<input type="text" required name="alamat_edit" class="form-control" id="alamat">
																							</div>

																							<div class="form-group mb-3">
																								<label for="contact" class="form-label">No Telepon</label>
																								<input type="number" required name="contact_edit" class="form-control" id="contact">
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
																	var tempatId = button.getAttribute('data-id');
																	var tempatName = button.getAttribute('data-name');
																	var tempatProvince = button.getAttribute('data-province');
																	var tempatCity = button.getAttribute('data-city');
																	var tempatAlamat = button.getAttribute('data-alamat');
																	var tempatContact = button.getAttribute('data-contact');

																	// Populate the modal fields with the clicked band's data
																	document.getElementById('modalTempatIdField').value = tempatId;
																	document.getElementById('namaTempat').value = tempatName;
																	document.getElementById('province2').value = tempatProvince;
																	document.getElementById('city2').value = tempatCity;
																	document.getElementById('alamat').value = tempatAlamat;
																	document.getElementById('contact').value = tempatContact;
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
										<td colspan="5" class="text-center">Tidak ada data tempat manggung yang tersedia.</td>
									</tr>
								<?php endif; ?>
							</tbody>

							<tfoot>
								<tr>
									<th>No</th>
									<th>Nama Tempat</th>
									<th>Provinsi</th>
									<th>Kota</th>
									<th>Alamat</th>
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
				text: 'Kamu akan menyimpan data panggung',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Ya, simpan data panggung!',
				cancelButtonText: 'Tidak, batal simpan data panggung!',
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
					Swal.fire('Dibatalkan', 'Data panggung batal ditambahkan :)',
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
				confirmButtonText: 'Ya, update data tempat manggung!',
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
					Swal.fire('Dibatalkan', 'Data tempat manggung batal di update :)',
						'error'); // Cancel the deletion
				}
			});
		});
	});
	// END SAVE ALERT //
</script>




<!-- API PROVINSI DAN KOTA RAJAONGKIR -->


<script>
	const API_BASE_URL = 'http://localhost/web_manajemen_band/admin/dashboard'; // Replace with your CI3 domain

	// Get all province and city dropdowns
	const provinceSelects = document.querySelectorAll('.province');
	const citySelects = document.querySelectorAll('.city');

	// Load provinces when the page loads
	window.onload = async () => {
		const provinces = await fetchProvinces();
		loadProvinceOptions(provinces);
	};

	// Fetch province data from the API
	async function fetchProvinces() {
		try {
			const response = await fetch(`${API_BASE_URL}/province`);
			const data = await response.json();
			return data.rajaongkir.results;
		} catch (error) {
			console.error('Error fetching provinces:', error);
		}
	}

	// Load province options into each dropdown
	function loadProvinceOptions(provinces) {
		provinceSelects.forEach(provinceSelect => {
			provinces.forEach(province => {
				const option = document.createElement('option');
				option.value = `${province.province_id}`; // Set province_id as the value
				option.textContent = province.province;
				provinceSelect.appendChild(option);
			});
		});
	}

	// Event listener for each province select change
	provinceSelects.forEach((provinceSelect, index) => {
		provinceSelect.addEventListener('change', () => {
			loadCities(provinceSelect, index);
		});
	});

	// Fetch cities based on selected province ID
	async function loadCities(provinceSelect, index) {
		const provinceValue = provinceSelect.value; // Directly use province_id as value
		const citySelect = citySelects[index]; // Find corresponding city dropdown

		if (provinceValue) {
			const cities = await fetchCities(provinceValue);
			loadCityOptions(citySelect, cities);
		} else {
			// Reset city dropdown if no province is selected
			citySelect.innerHTML = '<option value="">Pilih Kota</option>';
		}
	}

	// Fetch cities from the API based on province ID
	async function fetchCities(provinceId) {
		try {
			const response = await fetch(`${API_BASE_URL}/city/${provinceId}`);
			const data = await response.json();
			return data.rajaongkir.results;
		} catch (error) {
			console.error('Error fetching cities:', error);
		}
	}

	// Load city options into the appropriate city dropdown
	function loadCityOptions(citySelect, cities) {
		citySelect.innerHTML = '<option value="">Pilih Kota</option>'; // Reset city dropdown
		cities.forEach(city => {
			const option = document.createElement('option');
			option.value = `${city.city_id}`; // Set city_id as value
			option.textContent = `${city.city_name}`; // Display city name and province
			citySelect.appendChild(option);
		});
	}

	// Handle city selection change
	citySelects.forEach(citySelect => {
		citySelect.addEventListener('change', () => {
			const selectedCity = citySelect.options[citySelect.selectedIndex].textContent;
			console.log('Selected City:', selectedCity); // Show selected city and province
		});
	});
</script>