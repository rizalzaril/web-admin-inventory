<head>
	<!-- Add SweetAlert CDN -->
	<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
</head>


<div class="pc-container">
	<div class="pc-content">


		<!-- Recent Orders start -->
		<div class="col-sm-12">
			<div class="card table-card">
				<div class="card-header">
					<h3>List Stock Progress</h3>
				</div>
				<div class="card-body p-1">



					<?php if ($this->session->flashdata('stockIn')): ?>
						<script>
							Swal.fire({
								icon: 'success',
								title: 'Success',
								text: '<?php echo $this->session->flashdata('success'); ?>',
								footer: '<b>Stok Bertambah</b> <b id="productName"></b>'
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
								footer: '<b>Stok Berkurang</b>'
							});
						</script>
					<?php endif; ?>




					<div class=" table-responsive text-md">
						<table id="tbProgress" class="table table-striped" style="width:100%">
							<thead>
								<tr>
									<th>No</th>
									<th>Kode Transaksi</th>
									<th>Tipe Transaksi</th>
									<th>Nama Produk</th>
									<th>Supplier</th>
									<th>QTY</th>
									<th>Status</th>
									<th>Tgl Transaksi</th>
									<th>#</th>
								</tr>
							</thead>
							<tbody>
								<?php if (!empty($progress)) : ?>
									<?php $no = 1; ?>
									<?php foreach ($progress as $p) : ?>
										<tr>
											<td><?= $no++; ?></td>
											<td><?= htmlspecialchars($p['transaction_code']); ?></td>
											<td>

												<?php if ($p['transaction_type'] == 'in') { ?>
													<span class="badge bg-success text-md"><?= htmlspecialchars($p['transaction_type']); ?></span>
												<?php } else { ?>
													<span class="badge bg-danger text-md"><?= htmlspecialchars($p['transaction_type']); ?></span>
												<?php } ?>

											</td>
											<td><?= htmlspecialchars($p['product_name']); ?></td>
											<td><?= htmlspecialchars($p['supplier_name']); ?></td>
											<td>Rp <?= $p['quantity']; ?></td>
											<td>

												<?php if ($p['status'] == 'pending') : ?>
													<span class="badge bg-danger text-md"><?= htmlspecialchars($p['status']); ?></span>
												<?php endif ?>
											</td>
											<td><?= htmlspecialchars($p['created_at']); ?></td>
											<td>

												<?php if ($p['status'] == 'pending') : ?>
													<button class="btn btn-success btn-sm" onclick="confirmAcceptance(<?= $p['id_transaction']; ?>)"><i class="ph ph-check"></i></button>
												<?php endif; ?>

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
	function confirmAcceptance(transactionId) {
		// SweetAlert2 confirmation dialog
		Swal.fire({
			title: 'Are you sure?',
			text: "You are about to accept this transaction.",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Yes, accept it!',
			cancelButtonText: 'No, cancel!',
			reverseButtons: true
		}).then((result) => {
			if (result.isConfirmed) {
				// Send AJAX request to update the status
				$.ajax({
					url: '<?= site_url("admin/Dashboard/update_status"); ?>',
					method: 'POST',
					data: {
						id: transactionId,
						status: 'accepted'
					},
					success: function(response) {
						console.log(response); // Debugging: log the response
						if (response.success) {
							Swal.fire(
								'Accepted!',
								'The transaction status has been updated to accepted.',
								'success'
							);
							// Use the correct response.redirect_url
							if (response.redirect_url) {
								window.location.href = response.redirect_url; // Redirect to the correct page
							}
						} else {
							Swal.fire(
								'Accepted!',
								'The transaction status has been updated to accepted.',
								'success'
							);
							// window.location.href = '<?= base_url('/admin/dashboard/product_stock') ?>';
							location.reload()
						}
					},
					error: function(xhr, status, error) {
						console.log(xhr.responseText); // Debugging: log error response
						Swal.fire(
							'Error!',
							'An error occurred while updating the status.',
							'error'
						);
					}
				});
			}
		});
	}
</script>





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

<script>
	new DataTable('#tbProgress', {
		columnDefs: [{
			targets: '_all', // Apply to all columns
			defaultContent: '-' // Default content for empty cells
		}]
	});
</script>