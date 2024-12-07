<div class="pc-container">
	<div class="pc-content">



		<div class="card">
			<div class="card-header">
				<h3 class="">Daftar jadwal band yang hadir sesuai jadwal</h3>
			</div>
			<div class="card-body">

				<div class=" table-responsive mt-5">
					<table id="list_jadwal_terkonfirmasi" class="table table-striped mb-5" style="width:100%">
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
							<?php if (!empty($band_hadir)) : ?>
								<?php $no = 1; ?>
								<?php foreach ($band_hadir as $data) : ?>
									<?php if ($data['status'] == 'Terkonfirmasi') { ?>
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
									<?php } ?>
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