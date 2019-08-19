<div id="content">
	<!-- Flashdata -->
	<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
	<?php if ($this->session->flashdata('flash')) : ?>

	<?php endif; ?>
	<!-- Akhir Flasdata  -->
	<div class="container">
		<!-- Breadcrumbs line -->
		<div class="crumbs">
			<ul id="breadcrumbs" class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="#">Dashboard</a>
				</li>
				<li class="current">
					<a href="#" title="">Setting Semester dan Tahun Ajaran</a>
				</li>
			</ul>
		</div>
		<!-- /Breadcrumbs line -->

		<!--=== Page Header ===-->
		<?php
		$i = 0;
		foreach ($set as $hasil) {
			$i++;
		}
		// echo $i;
		if ($i == 0) {
			$url = 'setting/in_tambah';
			?>
			<div class="page-header">
				<hr>
				<?= $this->session->flashdata('message'); ?><br>
				<div class="text-center">
					<form method="post" action="<?= base_url() . $url ?>">
						<div class="form-group">
							<label class="col-md-2 control-label">Semester :</label>
							<div class="col-md-4">
								<select class="form-control" name="semester" required="">
									<option value="">-- Silahkan Pilih --</option>
									<option value="Ganjil">Ganjil</option>
									<option value="Genap">Genap</option>
								</select>
							</div>
						</div>


						<br><br><br>
						<div class="form-group">
							<label class="col-md-2 control-label">Tahun Ajaran :</label>
							<?php
								$format = date("Y").'/'. date('Y', strtotime('+1 year')); 
							?>
							<div class="col-md-4"><input type="text" placeholder="<?= $format?>" name="tahun_ajaran" title="Tooltip on focus" class="form-control" data-mask="9999/9999 required="">
							</div>
						</div>

						<br><br>
						<div class="form-group">
							<label class="col-md-2 control-label"></label>
							<div class="col-md-1"><button type="submit" class="btn btn-primary">Simpan</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<!-- /Page Header -->

			<!--=== Page Content ===-->
			<!--=== Managed Tables ===-->

			<!--=== Normal ===-->
			<!-- /Page Content -->
		</div>
		<!-- /.container -->

	</div>

<?php } else {
	$url = 'setting/update';
	?>
	<div class="page-header">
		<hr>
		<?= $this->session->flashdata('message'); ?><br>
		<div class="text-center">
			<form method="post" action="<?= base_url() . $url ?>">
				<?php
				foreach ($set as $hasil) { ?>
					<div class="form-group">
						<label class="col-md-2 control-label">Semester :</label>
						<div class="col-md-4">
							<select class="form-control" name="semester" required="">
								<option value="" disabled>-- Silahkan Pilih --</option>
								<?php if ($hasil->semester == 'Genap') { ?>
									<option value="Ganjil">Ganjil</option>
									<option value="Genap" selected>Genap</option>
								<?php } else { ?>
									<option value="Ganjil" selected>Ganjil</option>
									<option value="Genap">Genap</option>
								<?php }  ?>
							</select>
						</div>
					</div>


					<br><br><br>
					<div class="form-group">
						<label class="col-md-2 control-label">Tahun Ajaran :</label>
						<div class="col-md-4"><input type="text" name="tahun_ajaran" title="Tooltip on focus" class="form-control" data-mask="9999/9999" value="<?= $hasil->tahun_ajaran ?>" required="">
						</div>
					</div>
				<?php } ?>

				<br><br>
				<div class="form-group">
					<label class="col-md-2 control-label"></label>
					<div class="col-md-1"><button type="submit" class="btn btn-primary">Perbaharui</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<!-- /Page Header -->

	<!--=== Page Content ===-->
	<!--=== Managed Tables ===-->

	<!--=== Normal ===-->
	<!-- /Page Content -->
	</div>
	<!-- /.container -->

	</div>

<?php }
?>