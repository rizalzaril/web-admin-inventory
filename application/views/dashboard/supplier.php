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
										<form method="post" action="<?= base_url('admin/dashboard/simpan_data_supplier') ?>" class="save-form">
											<div id="form-container" style="max-height: 800px; overflow-y: auto;">
												<div class="card mb-3 mt-3">
													<div class="card-body">
														<div class="modal-body" style="max-height: 400px; overflow-y: auto;">
															<div class="form-group mb-3">
																<label for="namaSupplier" class="form-label">Nama Supplier</label>
																<input type="text" required name="nama_supplier" class="form-control" id="namaSupplier">
															</div>

															<div class="form-group mb-3">
																<label for="province1" class="form-label">Provinsi</label>
																<select class="form-control province" required name="provinsi" id="province1" onchange="loadCities()">
																	<option value="">Provinsi</option>
																	<!-- Province options will be loaded dynamically -->
																</select>
															</div>

															<div class="form-group mb-3">
																<label for="city1" class="form-label">Kota</label>
																<select id="city1" name="kota" required class="city form-control">
																	<option value="">Kota</option>
																	<!-- City options will be loaded dynamically -->
																</select>
															</div>

															<div class="form-group mb-3">
																<label for="alamat1" class="form-label">Alamat</label>
																<input type="text" name="alamat" required class="form-control" id="alamat">
															</div>

															<div class="form-group mb-3">
																<label for="contact1" class="form-label">Kontak</label>
																<input type="number" name="contact" required class="form-control" id="contact">
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
									<th>Nama Supplier</th>
									<th>Kontak</th>
									<th>Provinsi</th>
									<th>Kota</th>
									<th>Alamat</th>
									<th>Date</th>
									<th>#</th>
								</tr>
							</thead>
							<tbody>
								<?php if (!empty($supplier)) : ?>
									<?php $no = 1; ?>
									<?php foreach ($supplier as $p) : ?>
										<tr>
											<td><?= $no++; ?></td>
											<td><?= htmlspecialchars($p['supplier_name']); ?></td>
											<td><?= htmlspecialchars($p['contact_info']); ?></td>
											<td><?= htmlspecialchars($p['province_name']); ?></td>
											<td><?= htmlspecialchars($p['city_name']); ?></td>
											<td><?= htmlspecialchars($p['address']); ?></td>
											<td><?= htmlspecialchars($p['created_at']); ?></td>
											<td>

												<div class="d-flex gap-3">
													<!-- Tombol untuk memicu modal konfirmasi -->
													<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $p['id_supplier']; ?>"><i class="ph ph-trash"></i></button>
													<!-- Modal Konfirmasi Hapus -->
													<div class="modal fade" id="deleteModal<?= $p['id_supplier']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
														<div class="modal-dialog modal-dialog-centered ">
															<div class="modal-content">
																<div class="modal-header">
																	<h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus Supplier</h5>
																	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
																</div>
																<div class="modal-body">
																	Apakah Anda yakin ingin menghapus supplier <strong><?= $p['supplier_name']; ?></strong>?
																</div>
																<div class="modal-footer">
																	<!-- Tombol Batal -->
																	<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
																	<!-- Tombol Hapus -->
																	<a href="<?= base_url('admin/dashboard/delete_supplier/' . $p['id_supplier']); ?>" class="btn btn-danger">Hapus</a>
																</div>
															</div>
														</div>
													</div>





													<!-- Edit Button -->

													<button class="btn btn-primary text-white"
														data-bs-toggle="modal"
														data-bs-target="#modalEdit"
														data-id="<?= $p['id_supplier'] ?>"
														data-supplier-name="<?= htmlspecialchars($p['supplier_name']); ?>"
														data-province="<?= htmlspecialchars($p['province_name']); ?>"
														data-city="<?= htmlspecialchars($p['city_name']); ?>"
														data-address="<?= htmlspecialchars($p['address']); ?>"
														data-contact-supplier="<?= htmlspecialchars($p['contact_info']); ?>">
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
																		<form method="post" action="<?= base_url('admin/dashboard/update_data_supplier') ?>" class="update-form">
																			<div id="form-container" style="max-height: 700px; overflow-y: auto;">
																				<input type="text" id="modalSupplierIdField" name="id_supplier" style="display:none">
																				<div class="card mb-3 mt-3">
																					<div class="card-body">
																						<div class="modal-body" style="max-height: 400px; overflow-y: auto;">
																							<div class="form-group mb-3">
																								<label for="namaSupplier" class="form-label">Nama Supplier</label>
																								<input type="text" required name="nama_supplier_edit" class="form-control" id="supplierName">
																							</div>

																							<div class="input-group mb-3">
																								<label class="input-group-text" for="provinsi">Provinsi</label>
																								<select class="form-select province" required name="provinsi_edit" id="province2">
																									<option selected>Pilih</option>
																									<!-- <option value="<?= htmlspecialchars($p['province_name']) ?>"><?= htmlspecialchars($p['province_name']) ?></option> -->
																								</select>
																							</div>

																							<div class="input-group mb-3">
																								<label class="input-group-text" for="kota">Kota</label>
																								<select class="form-select city" required name="kota_edit" id="city2">

																									<!-- <option value="<?= htmlspecialchars($p['city_name']) ?>"><?= htmlspecialchars($p['city_name']) ?></option> -->
																								</select>
																							</div>

																							<div class="form-group mb-3">
																								<label for="alamat" class="form-label">Alamat</label>
																								<input type="text" required name="alamat_edit" class="form-control" id="address">
																							</div>

																							<div class="form-group mb-3">
																								<label for="contact" class="form-label">No Telepon</label>
																								<input type="number" required name="contact_edit" class="form-control" id="contactSupplier">
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
																	const name = button.getAttribute('data-supplier-name');
																	const province = button.getAttribute('data-province');
																	const city = button.getAttribute('data-city');
																	const address = button.getAttribute('data-address');
																	const contact = button.getAttribute('data-contact-supplier');

																	// Set values for text input fields
																	document.getElementById('modalSupplierIdField').value = id;
																	document.getElementById('supplierName').value = name;
																	// document.getElementById('province2').value = province;
																	// document.getElementById('city2').value = city;
																	document.getElementById('address').value = address;
																	document.getElementById('contactSupplier').value = contact;

																	// Set selected option for province select element
																	// const provinceSelect = document.getElementById('province2');
																	// const citySelect = document.getElementById('city2');

																	// Find and set the selected option for province

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
				text: 'Kamu akan menyimpan data supplier',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Ya, simpan data supplier!',
				cancelButtonText: 'Tidak, batal simpan data supplier!',
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
				text: 'Kamu akan update data supplier',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Ya, update data supplier!',
				cancelButtonText: 'Tidak, batal update data supplier!',
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
					Swal.fire('Dibatalkan', 'Data supplier batal di update :)',
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

<script>
	// Mendapatkan base URL dari PHP menggunakan base_url()
	const API_BASE_URL = '<?= base_url('admin/dashboard'); ?>';
	// Replace with your CI3 domain

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