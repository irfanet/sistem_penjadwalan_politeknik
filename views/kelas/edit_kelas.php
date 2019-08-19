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
						<h3>EDIT KELAS</h3>
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
								<h4><i class="icon-reorder"></i> Form Edit Kelas</h4>
							</div>
							<div class="widget-content">
								<form class="form-horizontal row-border" method="post">
								<input type="text" hidden="" name="id" value="<?= $kelas['id'];?>">
									<div class="form-group">
											<label class="col-md-2 control-label">Nama Kelas :</label>
											<div class="col-md-8"><input type="text" name="nama" title="Tooltip on focus" class="form-control bs-focus-tooltip" value="<?= $kelas['nama_kelas']; ?>">
											<small class="form-text text-danger"><?= form_error('nama');?></small>
											</div>
									</div>

									<div class="form-group">
											<label class="col-md-2 control-label">Prodi :</label>
											<div class="col-md-8">
													<select class="form-control" name="prodi" required="">
													<?php foreach($prodi as $j): ?>
														<?php if($j['id'] == $kelas['id_prodi']): ?>
															<option value="<?= $j['kode']; ?>" selected><?= $j['nama']; ?></option>
														<?php else : ?>
															<option value="<?= $j['kode']; ?>"><?= $j['nama']; ?></option>
														<?php endif; ?>
													<?php endforeach; ?>
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