<div id="content">
			<div class="container">
				<!-- Breadcrumbs line -->
				<div class="crumbs">
					<ul id="breadcrumbs" class="breadcrumb">
						<li>
							<i class="icon-home"></i>
							<a href="<?= base_url(); ?>kelas">Dashboard</a>
						</li>
						<li class="current">
							<a href="#" title="">Daftar Kelas</a>
						</li>
					</ul>
				</div>
				<!-- /Breadcrumbs line -->

				<!--=== Page Header ===-->
				<div class="page-header">
					<div class="page-title">
						<h3>TAMBAH KELAS</h3>
					</div>
				</div>
				<!-- /Page Header -->

				<!--=== Page Content ===-->
				<!--=== Managed Tables ===-->

				<!--=== Normal ===-->
				<!--=== Full Size Inputs ===-->
				<div class="row">
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i> Form Tambah Kelas</h4>
							</div>
							<div class="widget-content">
								<form class="form-horizontal row-border" method="post">

									<div class="form-group">
											<label class="col-md-2 control-label">Nama Kelas :</label>
											<div class="col-md-8"><input type="text" name="nama" title="Tooltip on focus" class="form-control bs-focus-tooltip" value="<?= set_value('nama'); ?>">
											<small class="form-text text-danger"><?= form_error('nama');?></small>
											</div>
									</div>

									<div class="form-group">
											<label class="col-md-2 control-label">Prodi :</label>
											<div class="col-md-8">
													<select class="form-control" name="prodi" required="">
														<option value="">-- Silahkan Pilih --</option>
														<?php foreach($prodi as $p){ ?>
															<option value="<?= $p['kode']; ?>"><?= $p['nama']; ?></option>
														<?php } ?>
													</select>
											</div>
									</div>

									<div class="form-group">
											<label class="col-md-2 control-label"></label>
											<button type="submit" class="btn btn-primary">Simpan</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!--Forms -->
				<!-- /Page Content -->
			</div>
			<!-- /.container -->

		</div>