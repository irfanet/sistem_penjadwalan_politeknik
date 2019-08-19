<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<title>Login | SIPET</title>

	<!--=== CSS ===-->

	<!-- Bootstrap -->
	<link href="<?= base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

	<!-- Theme -->
	<link href="<?= base_url(); ?>assets/assets/css/main.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url(); ?>assets/assets/css/plugins.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url(); ?>assets/assets/css/responsive.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url(); ?>assets/assets/css/icons.css" rel="stylesheet" type="text/css" />

	<!-- Login -->
	<link href="<?= base_url(); ?>assets/assets/css/login.css" rel="stylesheet" type="text/css" />

	<link rel="stylesheet" href="<?= base_url(); ?>assets/assets/css/fontawesome/font-awesome.min.css">
	<!--[if IE 7]>
		<link rel="stylesheet" href="assets/css/fontawesome/font-awesome-ie7.min.css">
	<![endif]-->

	<!--[if IE 8]>
		<link href="assets/css/ie8.css" rel="stylesheet" type="text/css" />
	<![endif]-->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>

	<!--=== JavaScript ===-->

	<script type="text/javascript" src="<?= base_url(); ?>assets/assets/js/libs/jquery-1.10.2.min.js"></script>

	<script type="text/javascript" src="<?= base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/assets/js/libs/lodash.compat.min.js"></script>

	<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
		<script src="assets/js/libs/html5shiv.js"></script>
	<![endif]-->

	<!-- Beautiful Checkboxes -->
	<script type="text/javascript" src="<?= base_url(); ?>assets/plugins/uniform/jquery.uniform.min.js"></script>

	<!-- Form Validation -->
	<script type="text/javascript" src="<?= base_url(); ?>assets/plugins/validation/jquery.validate.min.js"></script>

	<!-- Slim Progress Bars -->
	<script type="text/javascript" src="<?= base_url(); ?>assets/plugins/nprogress/nprogress.js"></script>



</head>

<body class="login">
    <!-- Logo -->
	<div class="logo">
		<img src="<?= base_url(); ?>assets/assets/img/logo.png" alt="logo" />
        <strong>ME</strong>LON
	</div>
	<!-- /Logo -->

	<!-- Login Box -->
	<div class="box">
		<div class="content">
            <!-- Login Formular -->
            <?= $this->session->flashdata('message');?>
			<form method="post">
				<!-- Title -->
				<h3 class="form-title">Forgot Password</h3>

				<!-- Error Message -->
				<div class="alert fade in alert-danger" style="display: none;">
					<i class="icon-remove close" data-dismiss="alert"></i>
					
				</div>

				<!-- Input Fields -->
				<div class="form-group">
					<!--<label for="username">Username:</label>-->
					<div class="input-icon">
						<i class="icon-user"></i>
						<input type="email" name="email" class="form-control" placeholder="Email" autofocus="autofocus" data-rule-required="true" data-msg-required="Please enter your username." />
					</div>
				</div>
				<!-- /Input Fields -->

				<center>
				<!-- Form Actions -->
				<div class="form-actions">
					<button type="submit" class="submit btn btn-primary">
						Send password reset email 
					</button>
				</div>
				</center>
			</form>
			<!-- /Login Formular -->
		</div> <!-- /.content -->

		<!-- Forgot Password Form -->
		<div class="inner-box">
			<div class="content">
				<!-- Close Button -->
				<i class="icon-remove close hide-default"></i>

				<!-- Link as Toggle Button -->
				<a href="<?= base_url(); ?>auth" class="forgot-password-link">Back to login</a>
			</div> <!-- /.content -->
		</div>
		<!-- /Forgot Password Form -->
	</div>
	<!-- /Login Box -->
</body>
</html>