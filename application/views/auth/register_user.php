<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
	<title>Register | Gradient Able Dashboard Template</title>
	<!-- [Meta] -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="Gradient Able is trending dashboard template made using Bootstrap 5 design framework. Gradient Able is available in Bootstrap, React, CodeIgniter, Angular,  and .net Technologies.">
	<meta name="keywords" content="Bootstrap admin template, Dashboard UI Kit, Dashboard Template, Backend Panel, react dashboard, angular dashboard">
	<meta name="author" content="codedthemes">

	<!-- [Favicon] icon -->
	<link rel="icon" href="<?= base_url('assets/images/favicon.svg'); ?>" type="image/x-icon"> <!-- [Google Font : Poppins] icon -->
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

	<!-- [Tabler Icons] https://tablericons.com -->
	<link rel="stylesheet" href="<?= base_url('./assets/fonts/tabler-icons.min.css'); ?>">
	<!-- [Feather Icons] https://feathericons.com -->
	<link rel="stylesheet" href="<?= base_url('./assets/fonts/feather.css'); ?>">
	<!-- [Font Awesome Icons] https://fontawesome.com/icons -->
	<link rel="stylesheet" href="<?= base_url('./assets/fonts/fontawesome.css'); ?>">
	<!-- [Material Icons] https://fonts.google.com/icons -->
	<link rel="stylesheet" href="<?= base_url('./assets/fonts/material.css'); ?>">
	<!-- [Template CSS Files] -->
	<link rel="stylesheet" href="<?= base_url('./assets/css/style.css'); ?>" id="main-style-link">
	<link rel="stylesheet" href="<?= base_url('./assets/css/style-preset.css'); ?>">


</head>
<!-- [Head] end -->
<!-- [Body] Start -->

<body data-pc-header="header-1" data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme="light">
	<!-- [ Pre-loader ] start -->
	<div class="loader-bg">
		<div class="loader-track">
			<div class="loader-fill"></div>
		</div>
	</div>
	<!-- [ Pre-loader ] End -->

	<div class="auth-main v1" style="background-image: url('https://png.pngtree.com/background/20230618/original/pngtree-3d-illustration-of-a-warehouse-for-distribution-picture-image_3758152.jpg'); background-color: rgba(0, 0, 0, 0.5); background-blend-mode: overlay; background-size:cover">
		<div class="auth-wrapper">
			<div class="auth-form">
				<div class="card my-5">
					<div class="card-body">
						<div class="text-center">

							<h4 class="f-w-500 mb-1">Register</h4>
							<p class="mb-4">Already have an Account? <a href="<?= base_url('auth') ?>" class="link-primary">Log in</a></p>
						</div>
						<form action="<?= base_url('auth/registerUserFunction') ?>" method="post">
							<?php if ($this->session->flashdata('error')): ?>
								<div class="alert alert-danger">
									<?= $this->session->flashdata('error') ?>
								</div>
							<?php endif; ?>
							<?php if ($this->session->flashdata('success')): ?>
								<div class="alert alert-success">
									<?= $this->session->flashdata('success') ?>
								</div>
							<?php endif; ?>


							<div class="form-group mb-3">
								<input type="text" class="form-control" name="username" placeholder="Username" required>
							</div>

							<div class="form-group mb-3">
								<input type="password" class="form-control" name="password" placeholder="Password" required>
							</div>
							<div class="form-group mb-3">
								<input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" required>
							</div>

							<div class="d-grid mt-4">
								<button type="submit" class="btn btn-primary">Create Account</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>



	<!-- [ Main Content ] end -->
	<!-- Required Js -->
	<script src="../assets/js/plugins/popper.min.js"></script>
	<script src="../assets/js/plugins/simplebar.min.js"></script>
	<script src="../assets/js/plugins/bootstrap.min.js"></script>
	<script src="../assets/js/fonts/custom-font.js"></script>
	<script src="../assets/js/pcoded.js"></script>
	<script src="../assets/js/plugins/feather.min.js"></script>





	<script>
		layout_change('light');
	</script>




	<script>
		layout_sidebar_change('light');
	</script>



	<script>
		change_box_container('false');
	</script>


	<script>
		layout_caption_change('true');
	</script>




	<script>
		layout_rtl_change('false');
	</script>


	<script>
		preset_change("preset-1");
	</script>


	<script>
		header_change("header-1");
	</script>

</body>
<!-- [Body] end -->

</html>