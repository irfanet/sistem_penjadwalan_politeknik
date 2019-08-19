<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<title><?= $title; ?></title>

	<!--=== CSS ===-->

	<!-- Bootstrap -->
	<link href="<?= base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

	<!-- jQuery UI -->
	<!--<link href="plugins/jquery-ui/jquery-ui-1.10.2.custom.css" rel="stylesheet" type="text/css" />-->
	<!--[if lt IE 9]>
		<link rel="stylesheet" type="text/css" href="plugins/jquery-ui/jquery.ui.1.10.2.ie.css"/>
	<![endif]-->

	<!-- Theme -->
	<link href="<?= base_url(); ?>assets/assets/css/main.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url(); ?>assets/assets/css/plugins.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url(); ?>assets/assets/css/responsive.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url(); ?>assets/assets/css/icons.css" rel="stylesheet" type="text/css" />

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
	<script type="text/javascript" src="<?= base_url(); ?>assets/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>

	<script type="text/javascript" src="<?= base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/assets/js/libs/lodash.compat.min.js"></script>

	<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
		<script src="assets/js/libs/html5shiv.js"></script>
	<![endif]-->

	<!-- Smartphone Touch Events -->
	<script type="text/javascript" src="<?= base_url(); ?>assets/plugins/touchpunch/jquery.ui.touch-punch.min.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/plugins/event.swipe/jquery.event.move.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/plugins/event.swipe/jquery.event.swipe.js"></script>

	<!-- General -->
	<script type="text/javascript" src="<?= base_url(); ?>assets/assets/js/libs/breakpoints.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/plugins/respond/respond.min.js"></script> <!-- Polyfill for min/max-width CSS3 Media Queries (only for IE8) -->
	<script type="text/javascript" src="<?= base_url(); ?>assets/plugins/cookie/jquery.cookie.min.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/plugins/slimscroll/jquery.slimscroll.horizontal.min.js"></script>

	<!-- Page specific plugins -->
	<!-- Charts -->
	<script type="text/javascript" src="<?= base_url(); ?>assets/plugins/sparkline/jquery.sparkline.min.js"></script>

	<script type="text/javascript" src="<?= base_url(); ?>assets/plugins/daterangepicker/moment.min.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/plugins/blockui/jquery.blockUI.min.js"></script>

	<!-- Forms -->
	<!-- <script type="text/javascript" src="<?= base_url(); ?>assets/plugins/uniform/jquery.uniform.min.js"></script> 
	<script type="text/javascript" src="<?= base_url(); ?>assets/plugins/select2/select2.min.js"></script> 
	<script type="text/javascript" src="<?= base_url(); ?>assets/plugins/fileinput/fileinput.js"></script> 
	<script type="text/javascript" src="<?= base_url(); ?>assets/plugins/bootstrap-multiselect/bootstrap-multiselect.min.js"></script>  -->

	<script type="text/javascript" src="<?= base_url(); ?>assets/plugins/typeahead/typeahead.min.js"></script> <!-- AutoComplete -->
	<script type="text/javascript" src="<?= base_url(); ?>assets/plugins/autosize/jquery.autosize.min.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/plugins/inputlimiter/jquery.inputlimiter.min.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/plugins/uniform/jquery.uniform.min.js"></script> <!-- Styled radio and checkboxes -->
	<script type="text/javascript" src="<?= base_url(); ?>assets/plugins/tagsinput/jquery.tagsinput.min.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/plugins/select2/select2.min.js"></script> <!-- Styled select boxes -->
	<script type="text/javascript" src="<?= base_url(); ?>assets/plugins/fileinput/fileinput.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/plugins/duallistbox/jquery.duallistbox.min.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/plugins/bootstrap-inputmask/jquery.inputmask.min.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/plugins/bootstrap-wysihtml5/wysihtml5.min.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.min.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/plugins/bootstrap-multiselect/bootstrap-multiselect.min.js"></script>

	
	<!-- DataTables -->
	<script type="text/javascript" src="<?= base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/plugins/datatables/tabletools/TableTools.min.js"></script> <!-- optional -->
	<script type="text/javascript" src="<?= base_url(); ?>assets/plugins/datatables/colvis/ColVis.min.js"></script> <!-- optional -->
	<script type="text/javascript" src="<?= base_url(); ?>assets/plugins/datatables/DT_bootstrap.js"></script>

	<!-- App -->
	<script type="text/javascript" src="<?= base_url(); ?>assets/assets/js/app.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/assets/js/plugins.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/assets/js/plugins.form-components.js"></script>

		<!-- Pickers -->
	<script type="text/javascript" src="<?= base_url(); ?>assets/plugins/pickadate/picker.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/plugins/pickadate/picker.date.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/plugins/pickadate/picker.time.js"></script>

	<script>
	$(document).ready(function(){
		"use strict";

		App.init(); // Init layout and core plugins
		Plugins.init(); // Init all plugins
		FormComponents.init(); // Init all form-specific plugins
	});
	</script>

	<script type="text/javascript" src="<?= base_url(); ?>assets/plugins/fullcalendar/fullcalendar.min.js"></script>
	<!-- Demo JS -->
	<script type="text/javascript" src="<?= base_url(); ?>assets/assets/js/custom.js"></script>

	<script type="text/javascript" src="<?= base_url(); ?>assets/assets/js/demo/pages_calendar.js"></script>
	 <!-- Sweetalert -->
	 <script src="<?= base_url(); ?>assets/js_custome/sweetalert2.min.js"></script>
	 <link rel="stylesheet" href="<?= base_url(); ?>assets/js_custome/sweetalert2.min.css">

</head>

<body>