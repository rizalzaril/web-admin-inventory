<div class="pc-container">
	<div class="pc-content">



		<div class="card">
			<div class="card-header">
				<h3 class="">Data Laporan jadwal band</h3>
			</div>
			<div class="card-body">

				<div class="row mt-5">






					<div class="col-3">
						<div class="row g-3 align-items-center">
							<div class="col-auto">
								<label for="monthFilter" class="col-form-label">Month:</label>
							</div>
							<div class="col-md-7">
								<select class="form-control" id="monthFilter">
									<option value="">Select Month</option>
									<option value="01">January</option>
									<option value="02">February</option>
									<option value="03">March</option>
									<option value="04">April</option>
									<option value="05">May</option>
									<option value="06">June</option>
									<option value="07">July</option>
									<option value="08">August</option>
									<option value="09">September</option>
									<option value="10">October</option>
									<option value="11">November</option>
									<option value="12">December</option>
								</select>

							</div>
						</div>

					</div>

					<div class="col-3">
						<div class="row g-3 align-items-center">
							<div class="col-auto">
								<label for="yearFilter" class="col-form-label">Year:</label>
							</div>
							<div class="col-md-7">
								<select class="form-control" id="yearFilter">
									<option value="">Select Year</option>
									<option value="2023">2023</option>
									<option value="2024">2024</option>
									<option value="2025">2025</option>
								</select>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row g-3 align-items-center">
							<div class="col-auto">
								<label for="dateFilter" class="col-form-label">Date:</label>
							</div>
							<div class="col-md-7">
								<input type="date" class="form-control" id="dateFilter">
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row g-3 align-items-center">
							<div class="col-auto">
								<label for="statusFilter" class="col-form-label">Status:</label>
							</div>
							<div class="col-md-7">
								<select class="form-control" id="statusFilter">
									<option value="">Select Status</option>
									<option value="Pending">Pending</option>
									<option value="Terkonfirmasi">Terkonfirmasi</option>
									<option value="Selesai">Selesai</option>
									<option value="Batal">Batal</option>
								</select>
							</div>
						</div>
					</div>









				</div>


				<!-- Add Buttons for Print, PDF, Excel -->
				<div class="row mb-3">
					<div class="col-md-12">
						<div class="btn-group" role="group">
							<!-- These buttons will be added by the DataTables Buttons plugin -->
						</div>
					</div>
				</div>
				<div class=" table-responsive mt-5">
					<table id="list_jadwal" class="table table-striped mb-5 display" style="width:100%">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Band</th>
								<th>Genre</th>
								<th>Tempat Manggung</th>
								<th>Jenis Konser</th>
								<th>Alamat</th>
								<th>Tanggal</th>
								<th>Waktu</th>
								<th>Status</th>


							</tr>
						</thead>
						<tbody>
							<?php if (!empty($report_data)) : ?>
								<?php $no = 1; ?>
								<?php foreach ($report_data as $data) : ?>

									<tr>
										<td><?= $no++; ?></td>
										<td><?= htmlspecialchars($data['nama_band']); ?></td>
										<td><?= htmlspecialchars($data['genre']); ?></td>
										<td><?= htmlspecialchars($data['nama_tempat_manggung']); ?></td>
										<td><?= htmlspecialchars($data['nama_konser']); ?></td>
										<td><?= htmlspecialchars($data['alamat']); ?>, <?= '', htmlspecialchars($data['kota_name']); ?>, <?= '', htmlspecialchars($data['provinsi_name']); ?> </td>
										<td><?= htmlspecialchars($data['date']); ?></td>
										<td><?= htmlspecialchars($data['time']); ?></td>
										<td>
											<?php if ($data['status'] == 'Pending') { ?>

												<span class="badge text-bg-warning"><?= htmlspecialchars($data['status']); ?></span>

											<?php } elseif ($data['status'] == 'Terkonfirmasi') { ?>

												<span class="badge text-bg-success"><?= htmlspecialchars($data['status']); ?></span>

											<?php } elseif ($data['status'] == 'Selesai') { ?>

												<span class="badge text-bg-info"><?= htmlspecialchars($data['status']); ?></span>

											<?php } else { ?>
												<span class="badge text-bg-danger"><?= htmlspecialchars($data['status']); ?></span>
											<?php } ?>

										</td>


									</tr>

								<?php endforeach; ?>
							<?php else : ?>
								<tr>
									<td colspan="5" class="text-center">Tidak ada data tempat manggung yang tersedia.</td>
								</tr>
							<?php endif; ?>
						</tbody>


					</table>

				</div>
			</div>

		</div>

	</div>
</div>