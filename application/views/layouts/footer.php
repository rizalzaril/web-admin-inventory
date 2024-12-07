<footer class="pc-footer">
	<div class="footer-wrapper container-fluid">
		<!-- Footer content can be added here -->
	</div>
</footer>

<!-- [Page Specific JS] start -->
<script src="<?= base_url('./assets/js/plugins/apexcharts.min.js'); ?>"></script>
<script src="<?= base_url('./assets/js/plugins/jsvectormap.min.js'); ?>"></script>
<script src="<?= base_url('./assets/js/plugins/world.js'); ?>"></script>
<script src="<?= base_url('./assets/js/plugins/world-merc.js'); ?>"></script>
<script src="<?= base_url('./assets/js/pages/dashboard-sales.js'); ?>"></script>
<!-- [Page Specific JS] end -->

<!-- Required Js -->
<script src="<?= base_url('./assets/js/plugins/popper.min.js'); ?>"></script>
<script src="<?= base_url('./assets/js/plugins/simplebar.min.js'); ?>"></script>
<script src="<?= base_url('./assets/js/plugins/bootstrap.min.js'); ?>"></script>
<script src="<?= base_url('./assets/js/fonts/custom-font.js'); ?>"></script>
<script src="<?= base_url('./assets/js/pcoded.js'); ?>"></script>
<script src="<?= base_url('./assets/js/plugins/feather.min.js'); ?>"></script>
<script src="<?= base_url('./assets/js/plugins/jquery.js'); ?>"></script>
<script src="<?= base_url('./assets/js/plugins/bootstrap.bundle.min.js'); ?>"></script>
<script src="<?= base_url('./assets/js/plugins/dataTables.js'); ?>"></script>
<script src="<?= base_url('./assets/js/plugins/dataTables.bootstrap5.js'); ?>"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/3.2.0/css/buttons.dataTables.css"></script>

<!-- DataTables Buttons plugin -->

<!-- JSZip for Excel export -->
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<!-- pdfMake for PDF export -->
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.min.js"></script>



<!-- Include SweetAlert2 CSS and JS -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.js"></script>

<!-- Bootstrap and Popper.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

<script>
	// Select all table elements
	document.querySelectorAll('table').forEach((table) => {
		// Initialize DataTable for each table
		new DataTable(table);
	});



	// jQuery to toggle the visibility of the table
	$(document).ready(function() {
		$('#toggleButton').click(function() {
			var tableContainer = $('#cardTable');
			var button = $('#toggleButton');
			var icon = button.find('i'); // Get the icon element inside the button

			// Toggle the visibility of the table
			tableContainer.toggle();

			// Change button text and icon based on visibility
			if (tableContainer.is(':visible')) {
				button.html('<i class="feather icon-eye-off float-center"></i>'); // Change icon to 'close' (eye-off)
				button.text('Tutup'); // Change text to 'Tutup' when table is visible
			} else {
				button.html('<i class="feather icon-eye float-center"></i>'); // Change icon back to 'eye'
				button.text('Lihat Riwayat'); // Change text back to 'Lihat Riwayat' when table is hidden
			}
		});
	});
</script>



<script>
	layout_change('light');
	layout_sidebar_change('light');
	change_box_container('false');
	layout_caption_change('true');
	layout_rtl_change('false');
	preset_change("preset-1");
	header_change("header-1");
</script>

<script>
	<?php if ($this->session->flashdata('success')): ?>
		Swal.fire({
			icon: 'success',
			title: 'Berhasil!',
			text: '<?= $this->session->flashdata('success'); ?>',
			confirmButtonText: 'OK'
		});
	<?php endif; ?>

	<?php if ($this->session->flashdata('error')): ?>
		Swal.fire({
			icon: 'error',
			title: 'Gagal!',
			text: '<?= $this->session->flashdata('error'); ?>',
			confirmButtonText: 'Coba Lagi'
		});
	<?php endif; ?>
</script>






</body>

</html>